<?php

namespace CrimeReport\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationMade;
use Illuminate\Http\Request;
use App\Models\Land_Parcel;
use App\Models\Crime_report;
use App\Models\Crime_type;
use App\Models\User;
use App\Models\Process_item;
use App\Models\Organization;
use App\Models\District;
use App\CustomClass\organization_assign;
use App\CustomClass\lanparcel_creation;


class CrimeReportController extends Controller
{


    public function create_crime_report(Request $request)
    {
        if ($request->hasfile('file')) {
            request()->validate([
                'file' => 'required',
                'file.*' => 'mimes:jpeg,jpg,png|max:40000'
            ]);
        }
        $request->validate([
            'crime_type' => 'required|not_in:0',
            'description' => 'required',
            'landTitle' => 'required',
            'district' => 'required|exists:districts,district',
            'confirm' => 'required',
            'create_by' => 'required',
            'polygon' => 'required',
            'landTitle' => 'required',
            'erEmail' => 'nullable|email',
            'externalRequestor' => 'nullable|regex:/^[0-9]{9}[vVxX]$/',
        ]);


        $array = DB::transaction(function () use ($request) {

            $land = new Land_Parcel();
            $land->title = $request['landTitle'];
            $land->polygon = request('polygon');
            $district_id1 = District::where('district', request('district'))->pluck('id');
            $land->district_id = $district_id1[0];
            $land->surveyor_name = 'No Surveyor';
            $land->created_by_user_id = $request['create_by'];
            if (request('isProtected')) {
                $land->protected_area = request('isProtected');
            }
            if (request('organization') != null) {
                $land->activity_organization = request('organization');
            }
            $land->status_id = 1;
            
            $land->save();
           
            $landid = Land_Parcel::latest()->first()->id;

            $Crime_report = new Crime_report;
            $Crime_report->Created_by_user_id = $request['create_by'];
            $Crime_report->crime_type_id = $request['crime_type'];
            $Crime_report->description = $request['description'];
            $Crime_report->photos = "{}";

            $Crime_report->logs = "{}";


            $Crime_report->action_taken = "0";
            $Crime_report->land_parcel_id = $landid; //add relationship later
            $Crime_report->status = "1";
            $Crime_report->save();
            $id = Crime_report::latest()->first()->id;

            if ($request->hasfile('file')) {
                $y = 0;
                foreach ($request->file('file') as $file) {
                    $filename = $file->getClientOriginalName();
                    $newname = $id . 'No' . $y . $filename;
                    $result = $file->storeOnCloudinaryAs('crimereport', $newname);
                    $photoarray[$y] = $result->getSecurePath();; // Get the url of the uploaded file; https
                    $y++;
                }
                //dd($photoarray);
                $crime = Crime_report::where('id', $id)->update(['photos' => json_encode($photoarray)]);
            }
            if (request('kml') !== null) {  //if the file is uploaded then the kml file will not be created

                try {
                    $kml = request('kml');
                    //setting the new name of the coordinates as {{landid}}.kml
                    $new_name = $landid . '.' . "kml";

                    Storage::put("kml_files/$new_name", $kml);
                    return download($kml);
                } catch (\Exception $e) {
                    dd($e);
                }
            }
            $Process_item = new Process_Item;
            $Process_item->created_by_user_id = $request['create_by'];
            if (($request->organization) != null) {
                $org_id = request('organization');
                $Process_item->activity_organization = $org_id;
            }
            $Process_item->activity_user_id = null;
            $Process_item->form_id =  $id;
            $Process_item->form_type_id = "4";
            $Process_item->status_id = "1";
            $Process_item->remark = "to be made yet";
            if ($request->has('nonreguser')) {
                $Process_item->ext_requestor_email = $request['erEmail'];
                $Process_item->ext_requestor = $request['externalRequestor'];
            } else {
                $Process_item->request_organization = Auth()->user()->organization_id;
            }
            $Process_item->save();
            $latestcrimeProcess = Process_Item::latest()->first();
            if (($request->organization) == null) {
                $org_id = organization_assign::auto_assign($latestcrimeProcess->id, $district_id1[0]);
            } else {
                $Users = User::where('role_id', '=', 2)->get();
                Notification::send($Users, new ApplicationMade($latestcrimeProcess));
            }
            $landProcess = new Process_Item();
            $landProcess->form_id = $landid;
            $landProcess->remark = "Verify these land details";
            $landProcess->prerequisite = 0;
            $landProcess->activity_organization = $org_id;
            $landProcess->status_id = 1;
            $landProcess->form_type_id = 5;
            $landProcess->created_by_user_id = $request['create_by'];
            $landProcess->prerequisite_id = $latestcrimeProcess->id;
            $landProcess->save();
            $successmessage = 'Crime report logged Successfully the reference no of the application is ' . $latestcrimeProcess->id;
            return $successmessage;
        });
        return redirect('/general/pending')->with('message', $array);
    }

    public function crime_report_form_display()
    {
        $Organizations = Organization::where('type_id', '<', '3')->get();
        $crime_types = Crime_type::all();
        $district = District::all();
        //dd($crime_types,$Organizations);
        return view('crimeReport::logComplaint', [
            'Organizations' => $Organizations,
            'crime_types' => $crime_types,
            'districts' => $district,
        ]);
    }

    public function download_image($path, $file)
    {
        //dd($path,$file);    
        return Storage::disk('public')->download($path . '/' . $file);
    }



    public function view_crime_reports($id)
    {
        $process_item = Process_Item::find($id);
        $crime = Crime_report::find($process_item->form_id);
        $Photos = Json_decode($crime->photos);
        $land_parcel = Land_Parcel::find($crime->land_parcel_id);
        return view('crimeReport::crimeview', [
            'crime' => $crime,
            'Photos' => $Photos,
            'polygon' => $land_parcel->polygon,
            'process_item' => $process_item,
        ]);
    }

    //related to crime_types
    public function create_crime_type()
    {
        return view('crimeReport::crimeTypeCreate');
    }

    public function edit_crime_type($id)
    {
        $crime_type = Crime_type::find($id);
        return view('crimeReport::crimeTypeEdit', [
            'crime_type' => $crime_type,
        ]);
    }

    public function delete_crime_type($id)
    {
        $Crime_types = Crime_type::find($id);
        $Crime_types->delete();
        return redirect('/crime-report/crimehome')->with('messagetypes', 'Crime type Successfully Deleted');
    }

    public function store_crime_type()
    {
        $ctype = new Crime_type();
        $ctype->type = request('crimetype');
        $ctype->status = request('status');
        $ctype->save();
        return redirect('/crime-report/crimehome')->with('messagetypes', 'Crime Type Successfully Added');
    }

    public function update_crime_type(Request $request, $id)
    {
        $crime_type = Crime_type::find($id);
        $crime_type->update([
            'type' => $request->type,
        ]);
        return redirect('/crime-report/crimehome')->with('messagetypes', 'Crime type Successfully Updated');
    }
}
