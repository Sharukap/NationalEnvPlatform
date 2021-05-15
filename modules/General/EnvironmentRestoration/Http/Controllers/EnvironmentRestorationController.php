<?php

namespace EnvironmentRestoration\Http\Controllers;

use App\Models\Land_Parcel;
use App\Models\District;
use App\Models\GS_Division;
use App\Models\Environment_Restoration;
use App\Models\Environment_Restoration_Activity;
use App\Models\Environment_Restoration_Species;
use App\Models\Organization;
use App\Models\Process_Item;
use App\Models\Ecosystem;
use App\Models\Env_type;
use App\Models\Land_Has_Organization;
use App\Models\Species;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationMade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnvironmentRestorationController extends Controller
{
    public function create()
    {
        $restorations = Environment_Restoration::all();         //shows all records of enviroment restoration request
        $organizations = Organization::where('type_id', '=', '1')->get(); //show all records for all government organizations
        $restoration_activities = Environment_Restoration_Activity::all();
        $districts = District::all();
        $gs = GS_Division::orderBy('gs_division')->get();
        $ecosystems = Env_type::all();
        return view('environmentRestoration::create', [
            'restorations' => $restorations,
            'organizations' => $organizations,
            'restoration_activities' => $restoration_activities,
            'districts' => $districts,
            'gs' => $gs,
            'ecosystems' => $ecosystems
        ]);
    }

    public function show($id)           //show request
    {
        $process_item = Process_Item::find($id);
        $restoration = Environment_Restoration::find($process_item->form_id);
        //$restoration = Environment_Restoration::find($id);
        // $species = Environment_Restoration_Species::find($restoration->id); 
        $species = Environment_Restoration_Species::where('environment_restoration_id', ($restoration->id))->get();
        $land = Land_Parcel::where('id', ($restoration->land_parcel_id))->get();
        $polygon = $land->pluck('polygon')->first();

        //ddd($land[0]->id);
        $govorgs = Land_Has_Organization::where('land_parcel_id', $land[0]->id)->pluck('organization_id');
        //ddd($govorgs);
        return view('environmentRestoration::show', [
            'restoration' => $restoration,
            'species' => $species,
            'land' => $land,
            'polygon' => $polygon,
            'govorgs' => $govorgs
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'landparceltitle' => 'required',
            'environment_restoration_activity' => 'required',
            'environment_restoration_activity' => 'required',
            'ecosystem' => 'required',
            'district' => 'required',
            'gs_division' => 'required',
            'activity_org' => 'required',
            'polygon' => 'required'
        ]);

        DB::transaction(function () use ($request) {
            $landparcel = new Land_Parcel();
            $landparcel->title = request('landparceltitle');
            $landparcel->polygon = request('polygon');
            $landparcel->surveyor_name = 'not given';
            if (request('isProtected')) {
                $landparcel->protected_area = request('isProtected');
            }
            $landparcel->surveyor_name = "No Surveyor";
            $landparcel->district_id = $request->district;
            $landparcel->gs_division_id = $request->gs_division;
            $landparcel->created_by_user_id = request('created_by');
            $landparcel->save();

            $latest = Land_Parcel::latest()->first();
            $newland = $latest->id;

            $orgs = request('govOrg');
            if ($orgs != null) {
                foreach ($orgs as $org) {
                    $landhasorg = new Land_Has_Organization();
                    $landhasorg->land_parcel_id = $newland;
                    $landhasorg->organization_id = $org;
                    $landhasorg->save();
                }
            }

            $restoration = new Environment_Restoration();
            $restoration->title = request('title');
            $restoration->environment_restoration_activity_id = request('environment_restoration_activity');
            $restoration->organization_id = request('organization');
            $restoration->eco_system_id = request('ecosystem');
            $restoration->land_parcel_id = $newland;
            $restoration->created_by_user_id = request('created_by');
            $restoration->status = request('status');
            $restoration->save();

            $latest = Environment_Restoration::latest()->first();
            $newres = $latest->id;
            // $activityorgname = request('activity_org');
            // $activityorgid = Organization::where('title', $activityorgname)->pluck('id');

            $Process_item = new Process_Item();
            $Process_item->form_id = $latest->id;
            $Process_item->form_type_id = 3;
            $Process_item->created_by_user_id = request('created_by');
            $Process_item->activity_organization = request('activity_org');
            $Process_item->status_id = 1;
            $Process_item->save();
            //+
            $latestprocess = Process_Item::latest()->first();

            //creating a notification for restoration made
            $users = User::where('role_id', '<', 3)->get();
            Notification::send($users, new ApplicationMade($Process_item));

            //Adding to Environment Restoration Species Table using ajax
            $rules = array(
                'statusSpecies.*'  => 'required',
                'species_name.*'  => 'required|exists:species_information,title',
                'quantity.*'  => 'required|integer',
                'height.*'  => 'required|integer',
                'dimension.*'  => 'required',
                'remark.*'  => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            $statusSpecies = $request->statusSpecies;
            $species_names = $request->species_name;
            $quantity = $request->quantity;
            $height = $request->height;
            $dimension = $request->dimension;
            $remark = $request->remark;
            for ($count = 0; $count < count($species_names); $count++) {
                $species_id = Species::where('title', $species_names[$count])->pluck('id');
                $data = array(
                    'environment_restoration_id' => $newres,
                    'status' => $statusSpecies[$count],
                    'species_id'  => $species_id[0],
                    'quantity'  => $quantity[$count],
                    'height'  => $height[$count],
                    'dimensions'  => $dimension[$count],
                    'remarks'  => $remark[$count],
                );
                $insert_data[] = $data;
            }

            Environment_Restoration_Species::insert($insert_data);

            $latest = Land_Parcel::latest()->first();
            $process = new Process_Item();
            $process->form_type_id = 5;
            $process->form_id = $latest->id;
            $process->created_by_user_id = request('created_by');
            $process->request_organization = Auth::user()->organization_id;
            $process->activity_organization = request('activity_org');
            $process->prerequisite_id = $latestprocess->id;
            $process->prerequisite = 0;
            $process->save();
        });

        return redirect('/general/pending')->with('message', 'Restoration Request Created Successfully');
    }
}
