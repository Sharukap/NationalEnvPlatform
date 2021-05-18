<?php

namespace TreeRemoval\Http\Controllers;

use App\Models\Tree_Removal_Request;
use App\Models\Land_Parcel;
use App\Models\Land_Has_Gazette;
use App\Models\Land_Has_Organization;
use App\Models\Province;
use App\Models\District;
use App\Models\GS_Division;
use App\Models\Organization;
use App\Models\Process_Item;
use App\Models\Gazette;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationMade;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\CustomClass\organization_assign;
use Illuminate\Support\Facades\Validator;



class TreeRemovalController extends Controller
{
    public function openForm()
    {
        $landbyuser = Process_Item::where([
            ['status_id', '=', 5],
            ['form_type_id', '=', 5],
            ['created_by_user_id', '=', Auth()->user()->id],
            ['request_organization', '!=', NULL],
        ])->get()->pluck('form_id');
        $landsdetails = Land_Parcel::whereIn('id', $landbyuser)->get();
        $gazettes = Gazette::all();
        $organizations = Organization::where('type_id', '<', '3')->get();
        return view('treeRemoval::form', [
            'organizations' => $organizations,
            'gazettes' => $gazettes,
            'registered_lands' => $landsdetails,
        ]);
    }

    public function save(Request $request)
    {
        if ($request->hasfile('file')) {

            request()->validate([
                'file' => 'required',
                'file.*' => 'mimes:jpeg,jpg,png|max:40000'
            ]);
        }

        if (request('registered_land')) {
            $request->validate([
                'planNo' => 'nullable',
                'surveyorName' => 'nullable',
                'district' => 'required|exists:districts,district',
                'gs_division' => 'nullable|exists:gs_divisions,gs_division',
                'polygon' => 'nullable',
                'land_extent' => 'nullable|numeric|between:0,99.999',
                'land_gazettes' => 'nullable',
                'land_governing_orgs' => 'nullable',
                'registered_land' => 'required|exists:land_parcels,id',

                'number_of_trees' => 'required|integer',
                'description' => 'required',
                'number_of_tree_species' => 'nullable|integer',
                'number_of_flora_species' => 'nullable|integer',
                'number_of_reptile_species' => 'nullable|integer',
                'number_of_mammal_species' => 'nullable|integer',
                'number_of_amphibian_species' => 'nullable|integer',
                'number_of_fish_species' => 'nullable|integer',
                'number_of_avian_species' => 'nullable|integer',
                'externalRequestor' => 'nullable|regex:/^[0-9]{9}[vVxX]$/',
                'erEmail' => 'nullable|email',
                'location.*.tree_species_id' => 'required',
                'location.*.circumference_at_breast_height' => 'required|numeric|between:0,999.999',
                'location.*.height'    => 'required||numeric|between:0,999.999',
            ]);
        } else {
            $request->validate([
                'planNo' => 'required|regex:/^[A-Za-z0-9\-]+$/u',
                'surveyorName' => 'required',
                'district' => 'required|exists:districts,district',
                'gs_division' => 'nullable|exists:gs_divisions,gs_division',
                'polygon' => 'required',
                'number_of_trees' => 'required|integer',
                'description' => 'required',
                'land_extent' => 'nullable|numeric|between:0,99.999',
                'number_of_tree_species' => 'nullable|integer',
                'number_of_flora_species' => 'nullable|integer',
                'number_of_reptile_species' => 'nullable|integer',
                'number_of_mammal_species' => 'nullable|integer',
                'number_of_amphibian_species' => 'nullable|integer',
                'number_of_fish_species' => 'nullable|integer',
                'number_of_avian_species' => 'nullable|integer',
                'externalRequestor' => 'nullable|regex:/^[0-9]{9}[vVxX]$/',
                'erEmail' => 'nullable|email',
                'land_gazettes' => 'nullable',
                'land_governing_orgs' => 'nullable',
                'location.*.tree_species_id' => 'required',
                'location.*.circumference_at_breast_height' => 'required|numeric|between:0,999.999',
                'location.*.height'    => 'required||numeric|between:0,999.999',
            ]);
        }

        DB::transaction(function () use ($request) {
            //used by a function outside the for loop below
            $gs_division_id1 = GS_Division::where('gs_division', request('gs_division'))->pluck('id');
            $district_id1 = District::where('district', request('district'))->pluck('id');
            $org_id = $request->organization;

            if (!(request('registered_land'))) {
                $land = new Land_Parcel();
                $land->title = request('planNo');
                $land->surveyor_name = request('surveyorName');

                $land->polygon = request('polygon');

                $land->created_by_user_id = request('createdBy');

                if (request('isProtected')) {
                    $land->protected_area = request('isProtected');
                }

                $land->district_id = $district_id1[0];

                if (request('gs_division')) {
                    $land->gs_division_id = $gs_division_id1[0];
                }

                if (($request->organization) != null) {
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
            }


            $tree = new Tree_Removal_Request();
            //Required and/or filled in fields
            $tree->created_by_user_id = request('createdBy');
            $tree->description = request('description');
            $tree->no_of_trees = request('number_of_trees');

            //$district_id1 = District::where('district', request('district'))->pluck('id');
            $tree->district_id = $district_id1[0];

            //$gs_division_id1 = GS_Division::where('gs_division', request('gs_division'))->pluck('id');
            if (request('gs_division')) {
                $tree->gs_division_id = $gs_division_id1[0];
            }
            if (($request->organization) != null) {
                $tree->organization_id = $org_id;
            }
            //Default value/ non-compulsory fields
            if (request('land_extent')) {
                $tree->land_size = request('land_extent');
            }
            if (request('number_of_flora_species')) {
                $tree->no_of_flora_species = request('number_of_flora_species');
            }
            if (request('number_of_avian_species')) {
                $tree->no_of_avian_species = request('number_of_avian_species');
            }
            if (request('number_of_reptile_species')) {
                $tree->no_of_reptile_species = request('number_of_reptile_species');
            }
            if (request('number_of_reptile_species')) {
                $tree->no_of_amphibian_species = request('number_of_amphibian_species');
            }
            if (request('number_of_mammal_species')) {
                $tree->no_of_mammal_species = request('number_of_mammal_species');
            }
            if (request('number_of_tree_species')) {
                $tree->no_of_tree_species = request('number_of_tree_species');
            }
            if (request('number_of_ambhibian_species')) {
                $tree->no_of_ambhibian_species = request('number_of_ambhibian_species');
            }
            if (request('species_special_notes')) {
                $tree->species_special_notes = request('species_special_notes');
            }

            $tree->status_id = 1;

            if (request('registered_land')) {
                $tree->land_parcel_id = request('registered_land');
            } else {
                $tree->land_parcel_id = $landid;
            }

            //calculating volume
            $locations = request('location');
            foreach ($locations as &$location) {
                $radius = $location['circumference_at_breast_height'] / (2 * pi());
                $volume = pi() * $radius * $radius * $location['height'];
                $location['timber_volume'] = $volume;
            }
            $tree->tree_details = $locations;
            $tree->images = "{}";
            $tree->save();

            //saving the images to the db
            $latest = Tree_Removal_Request::latest()->first();
            if ($request->hasfile('file')) {
                $y = 0;
                foreach ($request->file('file') as $file) {
                    $filename = $file->getClientOriginalName();
                    $newname = $latest->id . 'No' . $y . $filename;
                    $path = $file->storeAs('treeremoval', $newname, 'public');
                    $photoarray[$y] = $path;
                    $y++;
                }
                //dd($photoarray);
                $tree = Tree_Removal_Request::where('id', $latest->id)->update(['images' => json_encode($photoarray)]);
            }

            $treeProcess = new Process_Item();
            $treeProcess->form_type_id = 1;
            $treeProcess->form_id = $latest->id;
            $treeProcess->created_by_user_id = request('createdBy');

            if (request('checkExternalRequestor')) {
                $treeProcess->ext_requestor = request('externalRequestor');
                $treeProcess->ext_requestor_email = request('erEmail');
            } else {
                $treeProcess->request_organization = auth()->user()->organization_id;
            }
            if (($request->organization) != null) {
                $treeProcess->activity_organization = $org_id;
            }

            $treeProcess->status_id = 1;
            //dd($treeProcess);
            $treeProcess->save();

            $latestTreeProcess = Process_Item::latest()->first();

            if (($request->organization) == null) {
                $org_id = organization_assign::auto_assign($latestTreeProcess->id, $district_id1[0]);
                if (!(request('registered_land'))) {
                    Land_Parcel::where('id', $landid)->update(['activity_organization' => $org_id]);
                }
                Tree_Removal_Request::where('id', $latest->id)->update(['organization_id' => $org_id]);
            } else {
                $users = User::where('role_id', '<', 3)->get();
                Notification::send($users, new ApplicationMade($latestTreeProcess));
            }
            if (!(request('registered_land'))) {
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
                $landProcess->prerequisite_id = $latestTreeProcess->id;
                $landProcess->save();
            }


            //making a downloadable version of the KML file
            if (request('kml') !== null) {  //if the file is uploaded then the kml file will not be created
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
        $item = Process_Item::find($id);
        $tree_removal = Tree_Removal_Request::find($item->form_id);
        $Photos = Json_decode($tree_removal->images);
        $location_data = $tree_removal->tree_details;
        $land_data = Land_Parcel::find($tree_removal->land_parcel_id);
        // $images = json_decode($tree_removal->images);
        // ddd($images);
        return view('treeRemoval::show', [
            'tree' => $tree_removal,
            'location' => $location_data,
            'land' => $land_data,
            'polygon' => $land_data->polygon,
            'Photos' => $Photos,
            'process' => $item,
        ]);
    }

    public function destroy($processid, $treeid, $landid)
    {
        $prereqs = Process_Item::where("prerequisite_id", "=", $processid)->pluck('id');
        //ddd($processid, $treeid, $landid, $prereqs[0]);

        DB::transaction(function () use ($processid, $treeid, $landid, $prereqs) {

            if (!($prereqs->isEmpty())) {
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

                $landParcel = Land_Parcel::find($landid);
                $landParcel->delete();
            }

            $treeRemovalProcess = Process_Item::find($processid);
            $treeRemovalProcess->delete();

            $treeRemoval = Tree_Removal_Request::find($treeid);
            $treeRemoval->delete();
        });
        return redirect('/approval-item/showRequests')->with('message', 'Request Successfully Deleted');
    }

    //Typeahead AutoCompletes
    public function districtAutocomplete(Request $request)
    {
        $data = District::select("district")
            ->where("district", "LIKE", "%{$request->terms}%")
            ->where("district", "!=", "All island")
            ->get();

        return response()->json($data);
    }

    public function GSAutocomplete(Request $request)
    {
        $data = GS_Division::select("gs_division")
            ->where("gs_division", "LIKE", "%{$request->terms}%")
            ->get();

        return response()->json($data);
    }

    public function SpeciesAutocomplete(Request $request)
    {
        $data = Species::select("title")
            ->where("title", "LIKE", "%{$request->terms}%")
            ->get();

        return response()->json($data);
    }
}
