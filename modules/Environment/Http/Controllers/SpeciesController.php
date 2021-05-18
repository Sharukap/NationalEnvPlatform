<?php

namespace Environment\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Species;
use App\Models\Organization;
use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Role_has_access;

class SpeciesController extends Controller
{
    // Load the form to enter data of the newly found species
    public function form()
    {
        $organization = Organization::all();
        return view('environment::species', [
            'org' => $organization,
        ]);
    }
    // Store the data in the database
    public function store(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'scientific_name' => 'required',
            'habitat' => 'required',
            'taxanomy' => 'required',
            'description' => 'required',
            'createby' => 'required',
            'district' => 'required',
            'polygon' => 'required',
            'district' => 'required|exists:districts,district',
        ]);
        $species = new Species;
        $species->type = $request->input('type');
        $species->title = $request->input('title');
        $species->scientefic_name = $request->input('scientific_name');
        $species->habitats = $request->input('habitat');
        $district_id1 = District::where('district', request('district'))->pluck('id');
        $species->district_id = $district_id1[0];
        $species->taxa = $request->input('taxanomy');
        $species->polygon = request('polygon');
        $species->description = $request->input('description');
        $species->status_id = $request->input('status');
        if( $request->hasFile('images')) {
            
            $file = $request->file('images') ;
            $extension = $file->getClientOriginalExtension() ; //geting the image extension
            $filename= time() . '.' . $extension;
            $file->move('uploads/species/', $filename);
            $species->images= $filename;

        }else{
            
$species->images = '';


        }


        $species->created_by_user_id = $request->input('createby');
        $species->save();



        return redirect('/environment/newspecies')->with('success', 'Data Added successfully');
    }

    /* 
    public function track(Request $request)
    {
        $id = $request['create_by'];
        $species = Species::all()->where('created_by_user_id', $id)->toArray();
        return view('environment::trackrequest');
    } */
    // Return the main view
    public function index()
    {
        $species = Species::all();
        return view('environment::Spcindex', compact('species', $species));
    }

    public function index2()
    {
        $role = Auth::user()->role_id;
        if($role != 1){
            $access1 = Role_has_access::where('role_id',$role)->where('access_id',2)->first();;
            if($access1 == null)
            {
                $species = Species::all();
                return view('environment::SpcGeneral', compact('species', $species));
            }
        }
        return redirect()->action([SpeciesController::class, 'index']);
       
    }


    /* public function showRequest()
    {

        $items = Species::where('created_by_user_id', '=', Auth::user()->id)->get();
        return view('environment::trackrequest', [
            'items' => $items,
        ]);
    } */
    // Show the index page with the user request details
    public function show($id)           //show one record for moreinfo button
    {
        $items = Species::find($id);
        return view('environment/Spcindex', compact('species', 'id'));
    }
    // Return more view.
    public function more($id)
    {

        $species = Species::find($id);
        $polygon = Species::find($id)->polygon;
        return view('environment::morespecies',[
            'species' => $species,
            'polygon' => $polygon,
            ]);
        return view('environment::morespecies', compact('species', $species));
    }
    public function delete($id)
    {

        $items = Species::find($id);

        $items->delete();
        return redirect()->back()->with('success', 'Request  Successfully Deleted');
    }



    public function statusupdate(Request $request, $id)
    {
        $species = Species::find($id);
        $species->update([

            'status_id' => $request->status

        ]);

        return redirect()->back()->with('success', 'Request Approved Succesfully');
    }
}
