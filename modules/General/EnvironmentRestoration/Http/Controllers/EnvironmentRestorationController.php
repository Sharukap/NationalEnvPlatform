<?php

namespace EnvironmentRestoration\Http\Controllers;
use App\Models\Land_Parcel;
use App\Models\Environment_Restoration;
use App\Models\Environment_Restoration_Activity;
use App\Models\Environment_Restoration_Species;
use App\Models\Organization;
use App\Models\Process_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Ecosystem;
use App\Models\Land_Has_Organization;
use App\Models\Species_Information;
use Livewire\WithPagination;

class EnvironmentRestorationController extends Controller
{
    use WithPagination;
    // public function index()
    // {
    //     $restorations = Environment_Restoration::all();       //show all records for index
    //     return view('environmentRestoration::index', [
    //         'restorations' => Environment_Restoration::paginate(10),
    //     ]);
    // }

    // public function myIndex()
    // {
    //     $userID = Auth::user()->id;
    //     $restorations = Environment_Restoration::where('created_by_user_id','=', $userID)->get();       //show all records for index
    //     return view('environmentRestoration::myIndex', [
    //         'restorations' => $restorations,
    //     ]);
    // }
    
    public function create()
    {
        $restorations = Environment_Restoration::all();         //shows all records of enviroment restoration request
        $organizations = Organization::where('type_id','=','1')->get(); //show all records for all government organizations
        $restoration_activities = Environment_Restoration_Activity::all();
        $ecosystems = Ecosystem::all();
        return view('environmentRestoration::create', [
            'restorations' => $restorations,
            'organizations' => $organizations,
            'restoration_activities' => $restoration_activities,
            'ecosystems' => $ecosystems
        ]);
    }

    // public function show($id)           //show one record for moreinfo button
    // {
    //     $restoration = Environment_Restoration::find($id);
    //     // $species = Environment_Restoration_Species::find($restoration->id); 
    //     $species = Environment_Restoration_Species::where('environment_restoration_id','=',($restoration->id))->get();              
    //     return view('environmentRestoration::show', [
    //         'restoration' => $restoration,
    //         'species' => $species,
    //     ]);
    // }

    public function store(Request $request)
    {
        $landparcel = new Land_Parcel();
        $landparcel->title = request('landparceltitle');
        $landparcel->polygon = request('polygon');
        
        $landparcel->protected_area = request('isProtected');
        if (request('isProtected')) {
        $landparcel->created_by_user_id = request('created_by');
        $landparcel->save();
        }
        $latest = Land_Parcel::latest()->first();
        $newland = $latest->id;

        $orgs = request('govOrg');
        foreach($orgs as $org){
            $landhasorg = new Land_Has_Organization();
            $landhasorg->land_parcel_id = $newland;
            $landhasorg->organization_id = $org;
            $landhasorg->save();
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
        $Process_item = new Process_Item();
        $Process_item->form_id = $latest->id;
        $Process_item->form_type_id = 3;
        $Process_item->created_by_user_id = request('created_by');
        $Process_item->activity_organization = request('organization');
        $Process_item->status_id = 1;
        $Process_item->save();
        //+
        dd($Process_item,$request,$restoration);
        $latestprocess = Process_Item::latest()->first();

        //Adding map coordinates to the land parcel table


        //Adding to Environment Restoration Species Table using ajax
        $rules = array(
            'statusSpecies.*'  => 'required',
            'species_name.*'  => 'required',
            'quantity.*'  => 'required',
            'height.*'  => 'required',
            'dimension.*'  => 'required',
            'remark.*'  => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
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
        for($count = 0; $count < count($species_names); $count++)
        {
            $species_id = Species_Information::where('title',$species_names[$count])->pluck('id');
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
        $activityorgname = request('request_org');
        $activityorgid = Organization::where('title',$activityorgname)->pluck('id');
        $process = new Process_Item();
        $process->form_type_id = 5;
        $process->form_id = $latest->id;
        $process->created_by_user_id = request('created_by');
        $process->request_organization = Auth::user()->organization_id;
        $process->activity_organization = request('organization');
        $process->prerequisite_id=$latestprocess->id;
        $process->prerequisite=0;
        $process->save();
        

        return redirect('/general/pending')->with('message', 'Restoration Request Created Successfully');
    }
}