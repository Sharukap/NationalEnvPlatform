<?php

namespace SystemData\Http\Controllers;

use App\Models\Access;
use App\Models\User;
use App\Models\Crime_type;
use App\Models\Type;
use App\Models\Env_type;
use App\Models\Gazette;
use App\Models\Activity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class SystemDataController extends Controller
{
    
   
    //Access

    public function accessindex()
    {
        $access = Access::all();
        return view('SystemData::index')->with('access', $access);
    }
  
    public function accesscreate()
    {
        return view('SystemData::access/accesscreate', [

        ]);
    }
    public function accesssave(Request $request)
    {
        $access = new Access();
        $access->access = $request->access;
        $access->status = $request->status;
        $access->save();


        return redirect('sytem-data/accessindex')->with('success', 'Data Stored Successfully');
    }
    public function accessedit($id)
    {
        $access=Access::find($id);
       

        return view('SystemData::access/accessedit', [
            'access'=>$access,
           
            ]);
    }
    public function accessupdate(Request $request, $id)
    {
        $access =Access::find($id);
        $access->access = $request->access;
        $access->status = $request->status;
        $access->save();

        
        //direct back to the index page.
        return redirect('sytem-data/accessindex')->with('success', 'Access Updated Successfully');
    }
    public function accessdelete($id)
    {
        $access =Access::find($id);
        $access->delete();
        return redirect('sytem-data/accessindex')->with('success', 'Access Deleted');
    }
    
    //Crime Types
    public function crimetypeindex()
    {
        $crimetype = Crime_type::all();
        return view('SystemData::crimetypeindex')->with('crimetype', $crimetype);
    }
    public function crimetypescreate()
    {
        return view('SystemData::crime_types/crimetypescreate', [

        ]);
    }
    public function crimetypessave(Request $request)
    {
        $crimetype = new Crime_type();
        $crimetype->type = $request->type;
    
        $crimetype->save();


        return redirect('sytem-data/crimetypeindex')->with('success', 'Data Stored Successfully');
    }

    public function crime_typesedit($id)
    {
        $crimetype=Crime_type::find($id);
        return view('SystemData::crime_types/crime_typesedit', ['crimetype'=> $crimetype,]);
    }
    public function crime_typesupdate(Request $request, $id)
    {
        $crimetype =Crime_type::find($id);
        $crimetype->type = $request->type;
    
        $crimetype->save();
        //direct back to the index page.
        return redirect('sytem-data/crimetypeindex')->with('success', 'Crime Type Updated Successfully');
    }
    public function crime_typesdelete($id)
    {
        $crimetype =Crime_type::find($id);

        $crimetype ->delete();
        return redirect('sytem-data/crimetypeindex')->with('success', 'Crime Type Deleted');
    }
     
    
    //Organization Types
    public function org_typesindex()
    {
        $org_type=Type::all();
        return view('SystemData::org_typesindex')->with('org_type', $org_type);
    }

    public function org_typescreate()
    {
        return view('SystemData::org_types/org_typescreate', [

        ]);
    }
    public function org_typessave(Request $request)
    {
        $org_type = new Type();
        $org_type->title = $request->type;
    
        $org_type->save();


        return redirect('sytem-data/org_typesindex')->with('success', 'Data Stored Successfully');
    }
    public function org_typesedit($id)
    {
        $org_type=Type::find($id);
        return view('SystemData::org_types/org_typesedit', ['org_type'=>  $org_type,]);
    }
    public function org_typesupdate(Request $request, $id)
    {
        $org_type=Type::find($id);
        $org_type->title = $request->type;
    
        $org_type->save();

        //direct back to the index page.
        return redirect('sytem-data/org_typesindex')->with('success', 'Organization Type Updated Successfully');
    }
    public function org_typesdelete($id)
    {
        $org_type=Type::find($id);
        $org_type->delete();
        return redirect('sytem-data/org_typesindex')->with('success', 'Organization Type Deleted');
    }

    //Eco Types
    public function eco_typesindex()
    {
        $env_type=Env_type::all();
        return view('SystemData::eco_typesindex')->with('env_type', $env_type);
    }
    
    public function eco_typescreate()
    {
        return view('SystemData::ecosystem_types/eco_typescreate', [

        ]);
    }
    public function eco_typessave(Request $request)
    {
        $env_type= new Env_type();
        $env_type->type = $request->type;
    
        $env_type->save();


        return redirect('sytem-data/eco_typesindex')->with('success', 'Data Stored Successfully');
    }
    public function eco_typesedit($id)
    {
        $env_type=Env_type::find($id);
        return view('SystemData::ecosystem_types/eco_typesedit', ['env_type'=> $env_type,]);
    }
    public function eco_typesupdate(Request $request, $id)
    {
        $env_type=Env_type::find($id);
        $env_type->type = $request->type;
    
        $env_type->save();


        //direct back to the index page.
        return redirect('sytem-data/eco_typesindex')->with('success', 'Eco System Type Updated Successfully');
    }
    public function eco_typesdelete($id)
    {
        $env_type=Env_type::find($id);

        $env_type->delete();
        return redirect('sytem-data/eco_typesindex')->with('success', 'Eco System Type Deleted');
    }
    //Gazette
    public function gazettesindex()
    {
        $gazette = Gazette::all();
        return view('SystemData::gazetteindex')->with('gazette', $gazette);
    }
    public function gazettescreate()
    {
        return view('SystemData::gazzette/gazettescreate', [

        ]);
    }

    public function gazettessave(Request $request)
    {
        // ddd($request->all());
      
        $gazette= new Gazette();
        $gazette->title = $request->title;
        $gazette->gazette_number = $request->gazettenumber;
        $gazette->gazetted_date = $request->gazetteddate;
        $gazette->degazetted_date = $request->degazetteddate;
        $gazette->organizations = $request->organizations;
        $gazette->content= $request->content;
        $gazette->status=$request->status;
        $gazette-> created_by_user_id = $request->created_by_user_id;
        $gazette->save();


        return redirect('sytem-data/gazetteindex')->with('success', 'Data Stored Successfully');
    }
    public function gazzettesedit($id)
    {
        $gazette=Gazette::find($id);
        return view('SystemData::gazzette/gazzettesedit', ['gazette'=> $gazette,]);
    }
    public function gazzettesupdate(Request $request, $id)
    {
        $gazette=Gazette::find($id);
        $gazette->title = $request->title;
        $gazette->gazette_number = $request->gazettenumber;
        $gazette->gazetted_date = $request->gazetteddate;
        $gazette->degazetted_date = $request->degazetteddate;
        $gazette->organizations = $request->organizations;
        $gazette->content= $request->content;
        $gazette->status=$request->status;
        $gazette-> created_by_user_id = $request->created_by_user_id;
        $gazette->save();



        //direct back to the index page.
        return redirect('sytem-data/gazetteindex')->with('success', 'Gazette Updated Successfully');
    }
    public function gazzettesdelete($id)
    {
        $gazette=Gazette::find($id);
        $gazette->delete();
        return redirect('sytem-data/gazetteindex')->with('success', 'Gazette Deleted');
    }
    public function gazzettesview(Request $request)
    {
        $gazette=Gazette::find($request->id);
                       
        return view('SystemData::gazzette/gazettesview', [
            'gazette'=> $gazette,
           
            ]);
    }
    //Activity
    public function activityindex()
    {
        $activity = Activity::all();
        return view('SystemData::activityindex')->with('activity', $activity);
    }
  
    public function activitycreate()
    {
        return view('SystemData::activity/activitycreate', [

        ]);
    }
    public function activitysave(Request $request)
    {
        $activity = new Activity();
        $activity->activity = $request->activity;
        $activity->description = $request->description;

        $activity->save();


        return redirect('sytem-data/activityindex')->with('success', 'Data Stored Successfully');
    }
    public function activityedit($id)
    {
        $activity=Activity::find($id);
       

        return view('SystemData::activity/activityedit', [
            'activity'=>$activity,
           
            ]);
    }
    public function activityupdate(Request $request, $id)
    {
        $activity =Activity::find($id);
        $activity->activity = $request->activity;
        $activity->description = $request->description;

        $activity->save();


        
        //direct back to the index page.
        return redirect('sytem-data/activityindex')->with('success', 'Activity Updated Successfully');
    }
    public function activitydelete($id)
    {
        $activity =Activity::find($id);
        $activity->delete();
        return redirect('sytem-data/activityindex')->with('success', 'Activity Deleted');
    }
}
