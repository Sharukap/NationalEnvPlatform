<?php

namespace DevelopmentProject\Http\Controllers;

use App\Models\Development_Project;
use App\Models\Land_Parcel;
use App\Models\Gazette;
use App\Models\Organization;
use App\Models\User;
use App\Models\District;
use App\Models\GS_Division;
use App\Models\Process_Item;
use App\Models\Land_Has_Organization;
use App\Models\Land_Has_Gazette;
use Illuminate\Http\Request;
use App\Models\Test_Map;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationMade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\CustomClass\organization_assign;

class DevelopmentProjectController extends Controller
{

    //Returns the view for the application form passing in data of lands, organziations and gazettes
    public function form()
    {
        $gazettes = Gazette::all();
        $organizations = Organization::where('type_id', '<', '3')->get();
        return view('developmentProject::form', [
            'organizations' => $organizations,
            'gazettes' => $gazettes,
        ]);
    }

    // Saves the form to the development projects table as well as creates 1 or more entries in the process items table
    // depenign on the number of governing organizations selected.
    public function save(Request $request)
    {
        if ($request->hasfile('file')) {
            request()->validate([
                'file' => 'required',
                'file.*' => 'mimes:jpeg,jpg,png|max:40000'
            ]);
        }
        $request->validate([
            'title' => 'required',
            'planNo' => 'required',
            'surveyorName' => 'required',
            'gazette' => 'nullable|exists:gazettes,gazette_number',
            'polygon' => 'required',
            'district' => 'required|exists:districts,district',
            'gs_division' => 'nullable|exists:gs_divisions,gs_division',
            'description' => 'required',
            'externalRequestor' => 'nullable|regex:/^[0-9]{9}[vVxX]$/',
            'erEmail' => 'nullable|email',
            'land_extent' => 'nullable|numeric|between:0,99.999',
            'land_gazettes' => 'nullable',
            'land_governing_orgs' => 'nullable',
        ]);



        DB::transaction(function () use ($request) {
            $land = new Land_Parcel();
            $land->title = request('planNo');
            $land->surveyor_name = request('surveyorName');

            $land->polygon = request('polygon');

            $land->created_by_user_id = request('createdBy');

            if (request('isProtected')) {
                $land->protected_area = request('isProtected');
            }

            $district_id1 = District::where('district', request('district'))->pluck('id');
            $land->district_id = $district_id1[0];

            if (request('gs_division')) {
                $gs_division_id1 = GS_Division::where('gs_division', request('gs_division'))->pluck('id');
                $land->gs_division_id = $gs_division_id1[0];
            }


            if (($request->organization) != null) {
                $org_id = $request->organization;
                $land->activity_organization = $org_id;
            }
            $land->status_id = 1;
            $land->save();

            $landid = Land_Parcel::latest()->first()->id;

            if (request('land_governing_orgs')) {
                $governing_organizations = request('land_governing_orgs');

                foreach ($governing_organizations as $governing_organization) {
                    $land_has_organization = new Land_Has_Organization();
                    $land_has_organization->land_parcel_id = $landid;
                    $land_has_organization->organization_id = $governing_organization;
                    $land_has_organization->save();
                }
            }

            if (request('land_gazettes')) {
                $gazettes = request('land_gazettes');

                foreach ($gazettes as $gazette) {
                    $land_has_gazette = new Land_Has_Gazette();
                    $land_has_gazette->land_parcel_id = $landid;
                    $land_has_gazette->gazette_id = $gazette;
                    $land_has_gazette->save();
                }
            }


            $dev = new Development_Project();
            $dev->title = request('title');

            if (request('isProtected')) {
                $dev->protected_area = request('isProtected');
            }

            $dev->created_by_user_id = request('createdBy');

            if (request('land_extent')) {
                $dev->land_size = request('land_extent');
            }

            $dev->description = request('description');
            if (request('organization')) {
                $dev->organization_id = $org_id;
            }

            if (request('gazette')) {
                $gazette = Gazette::where('gazette_number', request('gazette'))->pluck('id');
                $dev->gazette_id = $gazette[0];
            }

            $dev->status_id = 1;

            $dev->land_parcel_id = $landid;

            $dev->images = "{}";

            $dev->save();

            //saving the images to the db
            $latest = Development_Project::latest()->first();
            if ($request->hasfile('file')) {
                $y = 0;
                foreach ($request->file('file') as $file) {
                    $filename = $file->getClientOriginalName();
                    $newname = $latest->id . 'No' . $y . $filename;
                    $path = $file->storeAs('development', $newname, 'public');
                    $photoarray[$y] = $path;
                    $y++;
                }
                //dd($photoarray);
                $devp = Development_Project::where('id', $latest->id)->update(['images' => json_encode($photoarray)]);
            }


            $devProcess = new Process_Item();
            $devProcess->form_id = $latest->id;
            $devProcess->form_type_id = 2;
            $devProcess->created_by_user_id = request('createdBy');

            if (request('checkExternalRequestor')) {
                $devProcess->ext_requestor = request('externalRequestor');
                $devProcess->ext_requestor_email = request('erEmail');
            } else {
                $devProcess->request_organization = auth()->user()->organization_id;
            }
            if (($request->organization) != null) {
                $devProcess->activity_organization = $org_id;
            }
            $devProcess->status_id = 1;

            $devProcess->save();

            $latestDevProcess = Process_Item::latest()->first();
            if (($request->organization) == null) {
                $org_id = organization_assign::auto_assign($latestDevProcess->id, $district_id1[0]);
                Land_Parcel::where('id', $landid)->update(['activity_organization' => $org_id]);
                Development_Project::where('id', $latest->id)->update(['organization_id' => $org_id]);
            }else{
                $users = User::where('role_id', '<', 3)->get();
                Notification::send($users, new ApplicationMade($latestDevProcess));
            }
            $landProcess = new Process_Item();
            $landProcess->form_id = $landid;
            $landProcess->remark = "Verify these land details";
            $landProcess->prerequisite = 0;

            if (request('checkExternalRequestor')) {
                $landProcess->ext_requestor = request('externalRequestor');
                $landProcess->ext_requestor_email = request('erEmail');
            } else {
                $landProcess->request_organization = auth()->user()->organization_id;
            }
            $landProcess->activity_organization = $org_id;

            $landProcess->status_id = 1;
            $landProcess->form_type_id = 5;
            $landProcess->created_by_user_id = request('createdBy');
            $landProcess->prerequisite_id = $latestDevProcess->id;
            $landProcess->save();

            //making a downloadable version of the KML file
            if (request('kml') !== null) { //if the file is uploaded then the kml file will not be created
                try {
                    $kml = request('kml');
                    //setting the new name of the coordinates as {{landid}}.kml
                    $new_name = $landid . '.' . "kml";

                    Storage::put("kml_files/$new_name", $kml);
                } catch (\Exception $e) {
                    dd($e);
                }
            }
        });


        return redirect('/general/pending')->with('message', 'Request Created Successfully');
    }

    public function show($id)
    {
        $process_item = Process_Item::find($id);
        $development_project = Development_Project::find($process_item->form_id);
        $Photos = Json_decode($development_project->images);
        $land_data = Land_Parcel::find($development_project->land_parcel_id);
        return view('developmentProject::show', [
            'development_project' => $development_project,
            'land' => $land_data,
            'Photos' => $Photos,
            'process' => $process_item,
            'polygon' => $land_data->polygon,
        ]);
    }

    public function destroy($processid, $devid, $landid)
    {
        $prereqs = Process_Item::where("prerequisite_id", "=", $processid)->pluck('id');
        //ddd($processid, $treeid, $landid, $prereqs[0]);

        DB::transaction(function () use ($processid, $devid, $landid, $prereqs) {

            $landhasGazettes = Land_Has_Gazette::where("land_parcel_id", "=", $landid)->get();
            foreach ($landhasGazettes as $landhasGazette) {
                $landhasGazette->delete();
            }

            $landHasOrganizations = Land_Has_Organization::where("land_parcel_id", "=", $landid)->get();
            foreach ($landHasOrganizations as $landHasOrganization) {
                $landHasOrganization->delete();
            }

            $landParcelProcess = Process_Item::find($prereqs[0]);
            $landParcelProcess->delete();

            $devProjectProcess = Process_Item::find($processid);
            $devProjectProcess->delete();

            $devProject = Development_Project::find($devid);
            $devProject->delete();

            $landParcel = Land_Parcel::find($landid);
            $landParcel->delete();
        });
        return redirect('/approval-item/showRequests')->with('message', 'Request Successfully Deleted');
    }

    public function gazetteAutocomplete(Request $request)
    {
        $data = Gazette::select("gazette_number")
            ->where("gazette_number", "LIKE", "%{$request->terms}%")
            ->get();

        return response()->json($data);
    }
}
