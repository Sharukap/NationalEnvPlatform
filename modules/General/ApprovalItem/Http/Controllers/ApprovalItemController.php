<?php

namespace ApprovalItem\Http\Controllers;
use App\Models\User;
use App\Models\Organization;
use App\Models\Crime_report;
use App\Models\Tree_Removal_Request;
use App\Models\Development_Project;
use App\Models\Environment_Restoration;
use App\Models\Environment_Restoration_Species;
use App\Models\Process_Item;
use App\Models\Form_Type;
use App\Models\Process_item_progress;
use App\Models\Process_item_status;
use App\Models\Land_Parcel;
use App\Models\Land_Has_Gazette;
use App\Models\Land_Has_Organization;
use App\Models\Environment_Restoration_Activity;
use App\Mail\RequestApproved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\AssignOrganization;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Notifications\StaffAssigned;
use App\Notifications\AssignOrg;
use App\Notifications\prereqmemo;
use App\Models\Activity;
use App\Models\Province;
use App\Models\Org_Activity;
use Illuminate\Support\Facades\Storage;
use PDF;
use Redirect;
use OwenIt\Auditing\Facades\Auditor;


class ApprovalItemController extends Controller
{

    public function confirm_assign_staff($uid, $id)
    {
        $array = DB::transaction(function () use ($uid, $id) {
            $Process_item = Process_Item::find($id);
            $new_assign = 1;
            if ($Process_item->activity_user_id != null) {
                $new_assign = '0';
            }
            $Process_item->activity_user_id = $uid;
            $Process_item->status_id = 3;
            $Process_item->save();
            $user = User::find($uid);
            Notification::send($user, new StaffAssigned($Process_item));
            return $new_assign;
        });
        if ($array == 0) {
            return back()->with('message', 'Authority changed Successfully');
        }
        return back()->with('message', 'Authority assigned Successfully');
    }

    public function change_assign_organization($oid, $id)
    {
        DB::transaction(function () use ($oid, $id) {
            $Process_item = Process_Item::find($id);
            $Users = User::where([
                ['role_id', '=', 3],
                ['organization_id', '=', $oid],
            ])->orWhere([
                ['role_id', '=', 4],
                ['organization_id', '=', $oid],
            ])->get();
            $Process_item->activity_organization = $oid;
            $Process_item->status_id = 2;
            $Process_item->save();

            $Land_process = Process_Item::where('prerequisite_id', $Process_item->id)->where('prerequisite', 0)->first();
            $Land_process->activity_organization = $oid;
            $Land_process->status_id = 2;
            $Land_process->save();

            Notification::send($Users, new AssignOrg($Process_item));
        });

        return back()->with('message', 'Assigned Organization Successfully');
    }

    public function assign_unregistered_organization(request $request)
    {
        $request->validate([
            'organization' => 'required',
            'email' => 'required',
        ]);
        $array = DB::transaction(function () use ($request) {
            $Process_item = Process_Item::find($request['process_id']);
            $Process_item->ext_requestor = $request['organization'];
            $Process_item->status_id = 2;
            $Process_item->save();
            $Land_process = Process_Item::where('prerequisite_id', $Process_item->id)->where('prerequisite', 0)->first();
            $Land_process->ext_requestor = $request['organization'];
            $Land_process->status_id = 2;
            $Land_process->save();
            return ($Process_item);
        });
        $user = User::find($request['create_by']);
        if ($array->form_type_id == '1') {
            $item = Tree_Removal_Request::find($array->form_id);
            $Photos = Json_decode($item->images);
            $tree_data = $item->tree_details;
        } else if ($array->form_type_id == '2') {
            $item = Development_Project::find($array->form_id);
            $Photos = Json_decode($item->images);
            $tree_data = null;
        } else if ($array->form_type_id == '3') {
            $item = Environment_Restoration::find($array->form_id);
            $Photos = null;
            $tree_data = Environment_Restoration_Species::all()->where('environment_restoration_id', $item->id);
            $Land_Organizations = Land_Has_Organization::where('land_parcel_id', $item->land_parcel_id)->get();
        } else if ($array->form_type_id == '4') {
            $item = Crime_report::find($array->form_id);
            $Photos = Json_decode($item->photos);
            $tree_data = null;
        }
        $land_parcel = Land_Parcel::find($item->land_parcel_id);
        //dd($array);
        if ($Photos != null) {
            $y = 0;
            foreach ($Photos as $photo) {
                //return Storage::disk('public')->download($photo);
                $contents[$y] =  Storage::disk('public')->get($photo);
                $y++;
            }
        }
        $pdf = PDF::loadView('approvalItem::index', [
            'process_item' => $array,
            'user' => $user,
            'item' => $item,
            'polygon' => $land_parcel->polygon,
            'tree_data' => $tree_data,
        ]);
        $array->requestor_email = $request['email'];

        $process_item = $array->toarray();

        if (isset($contents)) {
            Mail::send('emails.assignorg', $process_item, function ($message) use ($pdf, $contents, $Photos, $process_item) {

                $message->to($process_item['requestor_email']);
                $message->subject('Assigning application');
                $message->attachData($pdf->output(), 'document.pdf');
                for ($y = 0; $y < count($contents); $y++) {
                    $message->attachData($contents[$y], $Photos[$y]);
                }
            });
        } else {
            Mail::send('emails.assignorg', $process_item, function ($message) use ($pdf, $process_item) {

                $message->to($process_item['requestor_email']);
                $message->subject('Assigning application');
                $message->attachData($pdf->output(), 'document.pdf');
            });
        }
        return back()->with('message', 'Successfully forwarded the application through email');
    }

    public function showRequests()
    {
        $items = Process_Item::where([
            ['created_by_user_id', '=', Auth::user()->id],
            ['form_type_id', '<', 5],
           // ['created_at', '>', '2021-05-18'],
        ])->orderby('id','desc')->paginate(10);
        $organizations = Organization::all();
        return view('approvalItem::requests', [
            'items' => $items,
            'organizations' => $organizations,
        ]);
    }

    public function filterRequests(Request $request)
    {
        $organizations = Organization::all();
        if ($request->date && $request->organization) {
            $items = Process_Item::where([
                ['created_by_user_id', '=', Auth::user()->id],
                ['activity_organization', '=', $request->organization],
                ['form_type_id', '<', 5],
            ])->whereDate('created_at', '=', $request->date)->orderby('id','desc')->paginate(10);
            return view('approvalItem::requests', [
                'items' => $items,
                'organizations' => $organizations,
            ]);
        } else if ($request->date) {
            $items = Process_Item::where([
                ['created_by_user_id', '=', Auth::user()->id],
                ['form_type_id', '<', 5],
            ])->whereDate('created_at', '=', $request->date)->orderby('id','desc')->paginate(10);
            return view('approvalItem::requests', [
                'items' => $items,
                'organizations' => $organizations,
            ]);
        } else if ($request->organization) {
            $items = Process_Item::where([
                ['created_by_user_id', '=', Auth::user()->id],
                ['activity_organization', '=', $request->organization],
                ['form_type_id', '<', 5],
            ])->orderby('id','desc')->paginate(10);
            return view('approvalItem::requests', [
                'items' => $items,
                'organizations' => $organizations,
            ]);
        } else {
            $items = Process_Item::where([
                ['created_by_user_id', '=', Auth::user()->id],
                ['form_type_id', '<', 5],
            ])->orderby('id','desc')->paginate(10);
            return view('approvalItem::requests', [
                'items' => $items,
                'organizations' => $organizations,
            ]);
        }
    }

    public function choose_assign_staff($id)
    {
        $process_item = Process_Item::find($id);
        $Organizations = Organization::where('type_id', '<', '3')->get();
        if ($process_item->status_id > 2) {
            return redirect()->action(
                [ApprovalItemController::class, 'investigate'],
                ['id' => $id]
            );
        }
        $organization = Auth::user()->organization_id;
        if (Auth::user()->role_id == '3') {
            $Users = User::where([
                ['role_id', '>', 3],
                ['organization_id', '=', $organization],
            ])->get();
        } else {
            $Users = User::where([
                ['role_id', '=', 5],
                ['organization_id', '=', $organization],
            ])->get();
        }
        if ($process_item->form_type_id == '1') {
            $item = Tree_Removal_Request::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = $item->tree_details;
        } else if ($process_item->form_type_id == '2') {
            $item = Development_Project::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = null;
        } else if ($process_item->form_type_id == '3') {
            $item = Environment_Restoration::find($process_item->form_id);
            //dd($process_item,$item);
            $Photos = null;
            $data =  Environment_Restoration_Species::all()->where('environment_restoration_id', $item->id);
        } else if ($process_item->form_type_id == '4') {
            $item = Crime_report::find($process_item->form_id);
            $Photos = Json_decode($item->photos);
            $data = null;
        }

        if ($process_item->form_type_id != '5') {
            $land_parcel = Land_Parcel::find($item->land_parcel_id);

            $landProcess = Process_Item::where([
                ['prerequisite_id', '=', $process_item->id],
                ['prerequisite', '=', 0],
            ])->first();
            $landProcess2 = Process_Item::where('prerequisite_id', '=', $process_item->id)->first();
            //dd($landProcess,$landProcess2);
            //dd($data);
            return view('approvalItem::staffAssign', [
                'item' => $item,
                'process_item' => $process_item,
                'Organizations' => $Organizations,
                'polygon' => $land_parcel->polygon,
                'Photos' => $Photos,
                'land_process' => $landProcess,
                'data' => $data,
                'Users' => $Users,
            ]);
        } else {
            $item = Land_Parcel::find($process_item->form_id);
            $Land_Organizations = Land_Has_Organization::where('land_parcel_id', $item->id)->get();
            return view('approvalItem::staffAssign', [
                'item' => $item,
                'process_item' => $process_item,
                'Organizations' => $Organizations,
                'polygon' => $item->polygon,
                'LandOrganizations' => $Land_Organizations,
                'Users' => $Users,
            ]);
        }
    }

    public function citizen_view_progress($id)
    {
        $Process_item = Process_Item::find($id);
        $progress = Process_item_progress::all()->where('process_item_id', $id);
        if ($Process_item->form_type_id == '1') {
            $treecut = Tree_Removal_Request::find($Process_item->form_id);
            return view('approvalItem::treeview', [
                'treecut' => $treecut,
                'progress' => $progress,
            ]);
        } else if ($Process_item->form_type_id == '2') {
            $devp = Development_Project::find($Process_item->form_id);
            return view('approvalItem::developview', [
                'devp' => $devp,
                'progress' => $progress,
            ]);
        } else if ($Process_item->form_type_id == '3') {
            $envrest = Environment_Restoration::find($Process_item->form_id);
            return view('approvalItem::envrestoreAssign', [
                'envrest' => $envrest,
                'progress' => $progress,
            ]);
        } else if ($Process_item->form_type_id == '4') {
            $crime = Crime_report::find($Process_item->form_id);
            return view('approvalItem::crimeview', [
                'crime' => $crime,
                'progress' => $progress,
            ]);
        }
    }

    public function choose_assign_organization($id)
    {
        $Activities=Activity::all();
        $Provinces =Province::all();
        $process_item = Process_Item::find($id);
        $Organizations = Organization::where('type_id', '<', '3')->get();
        if ($process_item->form_type_id == '1') {
            $item = Tree_Removal_Request::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = $item->tree_details;
        } else if ($process_item->form_type_id == '2') {
            $item = Development_Project::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = null;
        } else if ($process_item->form_type_id == '3') {
            $item = Environment_Restoration::find($process_item->form_id);
            //dd($process_item,$item);
            $Photos = null;
            $data =  Environment_Restoration_Species::all()->where('environment_restoration_id', $item->id);
        } else if ($process_item->form_type_id == '4') {
            $item = Crime_report::find($process_item->form_id);
            $Photos = Json_decode($item->photos);
            $data = null;
        }

        if ($process_item->form_type_id != '5') {
            $land_parcel = Land_Parcel::find($item->land_parcel_id);

            $landProcess = Process_Item::where([
                ['prerequisite_id', '=', $process_item->id],
                ['prerequisite', '=', 0],
            ])->first();
            if($landProcess == null ){
                $landProcess = Process_Item::where([
                    ['form_type_id', '=',5],
                    ['form_id','=',$land_parcel],
                    ['prerequisite', '=', 0],
                ])->first();
            }
            //dd($landProcess,$landProcess2);
            //dd($data);
            return view('approvalItem::assignOrg', [
                'item' => $item,
                'process_item' => $process_item,
                'Organizations' => $Organizations,
                'polygon' => $land_parcel->polygon,
                'Photos' => $Photos,
                'land_process' => $landProcess,
                'data' => $data,
                'Activities' => $Activities,
                'Provinces' => $Provinces,
            ]);
        } else {
            $item = Land_Parcel::find($process_item->form_id);
            $Land_Organizations = Land_Has_Organization::where('land_parcel_id', $item->id)->get();
            return view('approvalItem::assignOrg', [
                'item' => $item,
                'process_item' => $process_item,
                'Organizations' => $Organizations,
                'polygon' => $item->polygon,
                'LandOrganizations' => $Land_Organizations,
                'Activities' => $Activities,
                'Provinces' => $Provinces,
            ]);
        }
    }

    public function filter_assign_organization(request $request)
    {
        $id=$request->id;
        $aid=$request->filter;
        if($request->type==1){  
            $org_acts=Org_Activity::select('organization_id')->where('activity_id',$aid)->get()->toArray();
        }
        else{
            $org_acts=Org_Activity::select('organization_id')->where('province_id',$aid)->get()->toArray();
        }
        $Organizations=Organization::whereIn('id',$org_acts)->get();
        $Activities=Activity::all();
        $Provinces =Province::all();
        //$acts=Org_Activity::find($id)
        $process_item = Process_Item::find($id);
        //$Organizations = Organization::all();
        if ($process_item->form_type_id == '1') {
            $item = Tree_Removal_Request::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = $item->tree_details;
        } else if ($process_item->form_type_id == '2') {
            $item = Development_Project::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = null;
        } else if ($process_item->form_type_id == '3') {
            $item = Environment_Restoration::find($process_item->form_id);
            //dd($process_item,$item);
            $Photos = null;
            $data =  Environment_Restoration_Species::all()->where('environment_restoration_id', $item->id);
        } else if ($process_item->form_type_id == '4') {
            $item = Crime_report::find($process_item->form_id);
            $Photos = Json_decode($item->photos);
            $data = null;
        }

        if ($process_item->form_type_id != '5') {
            $land_parcel = Land_Parcel::find($item->land_parcel_id);

            $landProcess = Process_Item::where([
                ['prerequisite_id', '=', $process_item->id],
                ['prerequisite', '=', 0],
            ])->first();
            $landProcess2 = Process_Item::where('prerequisite_id', '=', $process_item->id)->first();
            //dd($landProcess,$landProcess2);
            //dd($data);
            return view('approvalItem::assignOrg', [
                'item' => $item,
                'process_item' => $process_item,
                'Organizations' => $Organizations,
                'polygon' => $land_parcel->polygon,
                'Photos' => $Photos,
                'land_process' => $landProcess,
                'Activities' => $Activities,
                'data' => $data,
                'Provinces' => $Provinces,
            ]);
        } else {
            $item = Land_Parcel::find($process_item->form_id);
            $Land_Organizations = Land_Has_Organization::where('land_parcel_id', $item->id)->get();
            return view('approvalItem::assignOrg', [
                'item' => $item,
                'process_item' => $process_item,
                'Organizations' => $Organizations,
                'polygon' => $item->polygon,
                'LandOrganizations' => $Land_Organizations,
                'Activities' => $Activities,
                'Provinces' => $Provinces,
            ]);
        }
    }

    public function investigate($id)
    {
        $process_item = Process_Item::find($id);
        $Organizations = Organization::where('type_id', '<', '3')->get();
        $Prerequisites = Process_Item::all()->where('prerequisite_id', $process_item->id);
        $Process_item_statuses = Process_item_status::all();
        $Process_item_progresses = Process_item_progress::all()->where('process_item_id', $id);
        $organization = Auth::user()->organization_id;
        if (Auth::user()->role_id == '3') {
            $Users = User::where([
                ['role_id', '>', 3],
                ['organization_id', '=', $organization],
            ])->get();
        } else {
            $Users = User::where([
                ['role_id', '=', 5],
                ['organization_id', '=', $organization],
            ])->get();
        }
        if ($process_item->form_type_id == '1') {
            $item = Tree_Removal_Request::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = $item->tree_details;
        } else if ($process_item->form_type_id == '2') {
            $item = Development_Project::find($process_item->form_id);
            $Photos = null;
            $data = null;
        } else if ($process_item->form_type_id == '3') {
            $item = Environment_Restoration::find($process_item->form_id);
            $Photos = null;
            $data = Environment_Restoration_Species::all()->where('environment_restoration_id', $item->id);
        } else if ($process_item->form_type_id == '4') {
            $item = Crime_report::find($process_item->form_id);
            $Photos = Json_decode($item->photos);
            $data = null;
        }
        if ($process_item->form_type_id != '5') {
            $land_parcel = Land_Parcel::find($item->land_parcel_id);

            $landProcess = Process_Item::where([
                ['prerequisite_id', '=', $process_item->id],
                ['prerequisite', '=', 0],
            ])->first();

            if($landProcess == null ){
                $landProcess = Process_Item::where([
                    ['form_type_id', '=', 5],
                    ['form_id','=',$land_parcel->id],
                    ['prerequisite', '=', 0],
                ])->first();
                
            }
            //dd($landProcess, $process_item->status_id,$process_item->status);

            return view('approvalItem::investigate', [
                'item' => $item,
                'Organizations' => $Organizations,
                'Prerequisites' => $Prerequisites,
                'process_item' => $process_item,
                'polygon' => $land_parcel->polygon,
                'land_process' => $landProcess,
                'Process_item_statuses' => $Process_item_statuses,
                'Process_item_progresses' => $Process_item_progresses,
                'Photos' => $Photos,
                'Users' => $Users,
                'data' => $data,
            ]);
        } else {
            $item = Land_Parcel::find($process_item->form_id);
            $Land_Organizations = Land_Has_Organization::where('land_parcel_id', $item->id)->get();
            //dd($process_item,$item);
            return view('approvalItem::investigate', [
                'item' => $item,
                'process_item' => $process_item,
                'Organizations' => $Organizations,
                'polygon' => $item->polygon,
                'LandOrganizations' => $Land_Organizations,
                'Users' => $Users,
                'Process_item_statuses' => $Process_item_statuses,
                'Process_item_progresses' => $Process_item_progresses,
                'Prerequisites' => $Prerequisites,
            ]);
        }
    }

    public function view_prerequisite($id)
    {
        $process_item = Process_Item::find($id);
        $Organizations = Organization::all();
        $Prerequisites = Process_Item::all()->where('prerequisite_id', $process_item->id);
        $Process_item_statuses = Process_item_status::all();
        $Process_item_progresses = Process_item_progress::all()->where('process_item_id', $id);
        $organization = Auth::user()->organization_id;
        if (Auth::user()->role_id == '3') {
            $Users = User::where([
                ['role_id', '>', 3],
                ['organization_id', '=', $organization],
            ])->get();
        } else {
            $Users = User::where([
                ['role_id', '=', 5],
                ['organization_id', '=', $organization],
            ])->get();
        }
        if ($process_item->form_type_id == '1') {
            $item = Tree_Removal_Request::find($process_item->form_id);
            $Photos = Json_decode($item->images);
            $data = $item->tree_details;
        } else if ($process_item->form_type_id == '2') {
            $item = Development_Project::find($process_item->form_id);
            $Photos = null;
            $data = null;
        } else if ($process_item->form_type_id == '3') {
            $item = Environment_Restoration::find($process_item->form_id);
            $Photos = null;
            $data = Environment_Restoration_Species::all()->where('environment_restoration_id', $item->id);
        } else if ($process_item->form_type_id == '4') {
            $item = Crime_report::find($process_item->form_id);
            $Photos = Json_decode($item->photos);
            $data = null;
        }
        if ($process_item->form_type_id != '5') {
            $land_parcel = Land_Parcel::find($item->land_parcel_id);

            $landProcess = Process_Item::where([
                ['prerequisite_id', '=', $process_item->id],
                ['prerequisite', '=', 0],
            ])->first();
            //dd($landProcess, $process_item->status_id,$process_item->status);

            return view('approvalItem::viewPrerequisite', [
                'item' => $item,
                'Prerequisites' => $Prerequisites,
                'process_item' => $process_item,
                'polygon' => $land_parcel->polygon,
                'land_process' => $landProcess,
                'Process_item_progresses' => $Process_item_progresses,
                'Photos' => $Photos,
                'data' => $data,
            ]);
        } else {
            $item = Land_Parcel::find($process_item->form_id);
            $Land_Organizations = Land_Has_Organization::where('land_parcel_id', $item->id)->get();
            //dd($process_item,$item);
            return view('approvalItem::viewPrerequisite', [
                'item' => $item,
                'process_item' => $process_item,
                'polygon' => $item->polygon,
                'LandOrganizations' => $Land_Organizations,
                'Process_item_progresses' => $Process_item_progresses,
                'Prerequisites' => $Prerequisites,
            ]);
        }
    }
    public function create_prerequisite(Request $request)
    {

        $request->validate([
            'organization' => 'required|not_in:0',
            'request' => 'required',
        ]);
        $id = $request['process_id'];
        $Process_item_old = Process_Item::find($id);

        $Process_item = new Process_Item;
        $Process_item->created_by_user_id = $request['create_by'];
        $Process_item->request_organization = $request['create_organization'];
        $Process_item->activity_organization = $request['organization'];
        $Process_item->form_id = $Process_item_old['form_id'];
        $Process_item->form_type_id = $Process_item_old['form_type_id'];
        $Process_item->status_id = "2";
        $Process_item->prerequisite = "1";
        $Process_item->prerequisite_id = $Process_item_old['id'];
        $Process_item->remark = $request['request'];
        $Process_item->save();
        return back()->with('message', 'Prerequisite logged Successfully');
    }

    public function cancel_prerequisite($id, $userid)
    {
        $Process_item = Process_Item::find($id);
        $User = User::find($userid);
        $remark = $Process_item->remark . ' cancelled by ' . $User->name . ' (userId: ' . $User->id . ')';
        $Process_item->status_id = 8;
        $Process_item->remark = $remark;
        $Process_item->save();

        if ($Process_item->created_by_user_id == $userid) {
            return back()->with('message', 'Prerequisite is removed successfully');
        }
        $user = User::find($Process_item->created_by_user_id);
        $Process_item->created_by_user_id = $userid;
        if($user != null){
            Notification::send($user, new prereqmemo($Process_item));
        }
        return back()->with('message', 'Prerequisite is removed and the requestor has been notified');
    }

    public function progress_update(Request $request)
    {

        $request->validate([
            'status' => 'required|not_in:0',
            'request' => 'required',
        ]);
        $id = $request['process_id'];
        Process_Item::where('id', $id)->update(['status_id' => 4]);
        $Process_item_progress = new Process_item_progress;
        $Process_item_progress->created_by_user_id = $request['create_by'];
        $Process_item_progress->process_item_id = $request['process_id'];
        $Process_item_progress->status_id = $request['status'];
        $Process_item_progress->remark = $request['request'];
        $Process_item_progress->save();
        $Process_item_statuses = Process_item_status::all();

        //dd($Process_item_progress,$Process_item_statuses);
        return back()->with('message', 'Progress updated Successfully');
    }

    public function final_approval(Request $request)
    {

        $request->validate([
            'status' => 'required|not_in:0',
            'request' => 'required',
        ]);
        $id = $request['process_id'];
        $title = Process_item_status::where('id', $request['status'])->first()->status_title;
        if ($request['status'] == 5) {
            $Incomplete_prerequisites2 = Process_Item::all()->where(
                'status_id',
                '!=',
                '5',
            )->where(
                'status_id',
                '!=',
                '8',
            )->where('prerequisite_id', $id);
            if ($Incomplete_prerequisites2->isNotEmpty()) {
                //dd($Incomplete_prerequisites2);
                return back()->with('warning', 'Prerequisites need to be approved first');
            } else {
                $Process_item = Process_Item::where('id', $id)->first();
                $remark = $Process_item->remark . $request['request'];
                $Process_item->status_id = 5;
                $Process_item->remark = $remark;
                $Process_item->save();
                //Process_item::where('id',$id)->update(['status_id' => 5]);
                $Process_item_progress = new Process_item_progress;
                $Process_item_progress->created_by_user_id = $request['create_by'];
                $Process_item_progress->process_item_id = $request['process_id'];
                $Process_item_progress->status_id = $request['status'];
                $Process_item_progress->remark = 'Final Approval of application ' . $request['request'];
                $Process_item_progress->save();
                if ($Process_item_progress->form_type_id == 4) {
                    $crime = Crime_report::where('id', $Process_item_progress->form_id)->first();
                    $crime->action_taken = 1;
                }
            }
        } else {
            $Process_item = Process_Item::where('id', $id)->first();
            $remark = $Process_item->remark . $request['request'];
            $Process_item->status_id = 6;
            $Process_item->remark = $remark;
            $Process_item->save();
            //Process_item::where('id',$id)->update(['status_id' => 6]);
            $Process_item_progress = new Process_item_progress;
            $Process_item_progress->created_by_user_id = $request['create_by'];
            $Process_item_progress->process_item_id = $request['process_id'];
            $Process_item_progress->status_id = $request['status'];
            $Process_item_progress->remark = 'Final Reject of application ' . $request['request'];
            $Process_item_progress->save();
        }
        if($Process_item->form_type_id !=5){
        $Process_item =Process_item::find($id);
        $user =User::find($request['create_by']);
        switch($Process_item->form_type_id){
            case 1: $item = Tree_Removal_Request::find($Process_item->form_id);
            $data = $item->tree_details;
            break;
            case 2:
            $item = Development_Project::find($Process_item->form_id);
            $data = null;
            break;
            case 3:
            $item = Environment_Restoration::find($Process_item->form_id);
            $data = Environment_Restoration_Species::all()->where('environment_restoration_id', $item->id);
            break;
            case 4:
            $item = Crime_report::find($Process_item->form_id);
            $data = null;
            break;
        }
        $land = Land_Parcel::find($item);
        //dd($item);
            $pdf = PDF::loadView('approvalItem::certificate', [
                'process_item' => $Process_item,
                'user' => $user,
                'item' => $item,
                'tree_data' => $data,
                'remark' => $request['request'],
                'land' =>$land,
            ]);
            //return $pdf->stream();
            $array=$Process_item->toArray();
            if($Process_item->created_by_user_id !=null){
                $applicant=User::find($Process_item->created_by_user_id);
                Mail::send('emails.finalapproval', $array, function ($message) use ($pdf,$applicant,$user) {
                $message->to($applicant->email,$user->email);
                $message->subject('Assigning application');
                $message->attachData($pdf->output(), 'NEP Application Certificate.pdf');
                });
            }else{
                return $pdf->stream();
            }
        }
        return back()->with('message', 'Request ' . $title);
    }
}
