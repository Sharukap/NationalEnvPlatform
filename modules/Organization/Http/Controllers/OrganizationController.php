<?php
namespace Organization\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use App\Models\Contact;
use App\Models\Province;
use App\Models\Activity;
use App\Models\Org_Activity;
use App\Models\Organization_Activity;
use App\Models\Form_Type;
use App\Models\District;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class OrganizationController extends Controller
{
    public function create()
    {
        return view('organization::create');
    }

    // When the user fills in the details of the new organization and clicks submit it will be handled here. organization details and contact details will store database.
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        if($request->type==1 || $request->type == 2){
            $condition= "required|digits:10";
        }else{
            $condition = "required|email";
        }
        $request->validate([
           
            'title' => 'required',
            'city' => 'required',
            'organization_type' => 'required',
            'contact' => $condition,
            'province'=>'required',
            'address' =>'required',
        ]);

        $org_type = Type::all();

        //dd($request->all());
        $organization = new Organization();
        $organization->title = $request->title;
        $organization->city = $request->city;
        $organization->type_id = $request->organization_type;
        $organization->description = $request->description;
        $organization->status = $request->status;
        $organization->save();
        $type = $request->type;

        $contact = new Contact();
        $contact->org_id = $organization->id;
        $contact->type ="Address";
        $contact->contact_signature = $request->address;
        $contact->primary = 0;

        $contact = new Contact();
        $contact->org_id = $organization->id;
        if($request->type==1){
            $contact->type ="Phone Number";
        }elseif($request->type==2){
            $contact->type ="email";
        }else{
            $contact->type ="Fax";
        }
        $contact->contact_signature = $request->contact;
        $contact->primary = 1;
        $contact->save();

        $ORG_ACT = $request->activity;
        $act_count = count((array)$ORG_ACT);

        for ($i = 0;$i < $act_count;$i++) {
            $ORG_ACT = new Org_Activity();
            $ORG_ACT->organization_id = $organization->id;
            $ORG_ACT->activity_id= $request->activity[$i];
            $ORG_ACT->province_id= $request->province;
            $ORG_ACT->save();
        }
        //direct back to the index page.
        return redirect('/organization/index')->with('message', 'Organization created Successfully ');
    }

    // Return the View more details window for organization.
    public function more(Request $request)
    {
        $organization = Organization::find($request->id);
        //$contact = Contact::all();
        $contact = Contact::Where('org_id', $request->id)->get();
        $ORG_ACT= Org_Activity::Where('organization_id', $request->id)->get();

        //dd($contact);
        //direct back to the index page.
        return view('organization::more', compact("organization", "contact", "ORG_ACT"));
    }

    
    // Returns the edit view for organization.
    public function edit($id)
    {
        $org_type=Type::all();
        $organization = Organization::find($id);
        $province=Province::all();
        $contact = Contact::Where('org_id', $id)->get();
        $ORG_ACT= Org_Activity::Where('organization_id', $id)->get();
        //$existActs= Org_Activity::select('activity_id')->where('organization_id', $id)->get()->toArray();
        $Activities=Activity::all();

        //dd($ORG_ACT,$Activities);
        //direct back to the index page.
        return view(
            'organization::edit',
            ['organization' => $organization,
        'contact' => $contact,
         'ORG_ACT' => $ORG_ACT,
         'org_type'=> $org_type,
          'Activities'=>$Activities,
          'province'=>$province
         ]
        );
    }

    
    // When the admin clicks the submit button in the edit view, the following data will be
    // patched for the relavant organization who is being edited and saved in the db.
    public function update(Request $request, $id)
    {
        // ddd($request->all());

        $organization = Organization::find($id);
       
        $organization->title = $request->title;
        $organization-> city =$request->city;
        // $organization-> country =$request->country;
        $organization-> type_id = $request->organization_type;
        $organization-> description = $request->description;
        $organization-> status = $request->status;
        $organization->save();
        
        //direct back to the index page.
        return redirect('/organization/index')->with('message', 'Organization Updated Successfully');
    }
    public function contactupdate(Request $request, $id)
    {
        $type = $request->type;
        

        $contact_signature = $request->contact_signature;
        $count = count((array)$type);
        
        for ($i = 0;$i < $count;$i++) {
            $contact = new Contact();
            $contact->org_id =$id;
            $contact->type = $request->type[$i];
            $contact->contact_signature = $request->contact_signature[$i];
            $contact->primary = $request->primary;
            //$contact->status = $request->status;
            $contact->save();
        }

        return redirect('/organization/index')->with('message', 'Contact updated Successfully');
    }

    
    public function contactremove($id)
    {
        Contact::where('id', $id)->delete();
        return redirect('/organization/index')->with('message', 'Contact removed Successfully');
    }
    

    public function activityupdate(Request $request, $id)
    {
        $request -> validate([
            'province' => 'required|not_in:0',
        ]);
        
        foreach ($request->modules as $newactivity) {
            $orgact=new Org_Activity();
            $orgact->organization_id=$id;
            $orgact->activity_id=$newactivity;
            $orgact->province_id=$request->province;
            $orgact->save();
        }
        return redirect('/organization/index')->with('message', 'Activity updated Successfully');
    }

    public function activityremove($id)
    {
        Org_Activity::where('id', $id)->delete();
        return redirect('/organization/index')->with('message', 'Activity removed Successfully');
    }

    // Routing logic
    public function index()
    {
        $organization = Organization::where('status', '!=', -1)->get();
        $contact = Contact::all();
        $ORG_ACT= Org_Activity::all();
        //direct back to the index page.
        return view('organization::index')->with('organization', $organization)->with('contact', $contact);
    }
    public function destroy($id)
    {
        $organization = Organization::find($id);
        $contacts = Contact::where('org_id', '=', $id)->get();
        foreach ($contacts as $contact) {
            $contact->delete();
        }
        $Org_act =Org_Activity::where('organization_id', '=', $id)->get();
        foreach ($Org_act as $ORG_ACT) {
            $ORG_ACT ->delete();
        }
        $organization->update([
            'status' => -1,
        ]);
        return redirect('/organization/index')->with('message', 'Organization Deleted');
    }

    public function activities()
    {
        $organizations = Organization_Activity::all();
        //direct back to the index page.
        return view('organization::activity', [
            'organizations' => $organizations,
        ]);
    }

    public function new_activity()
    {
        $organizations = Organization::all();
        $Forms =Form_Type::all();
        $province = Province::all();
        $district = District::all();
        //direct back to the index page.
        return view('organization::newactivity', [
            'organizations' => $organizations,
            'Forms' => $Forms,
            'provinces' => $province,
            'districts' => $district,
        ]);
    }

    public function activity_create(Request $request) {
        $request -> validate([
            'province' => 'required',
            'district' => 'required',
            'form_type' => 'required',
            'organization' => 'required|exists:organizations,title',
        ]);
        $Org_act = new Organization_Activity();
        $Org_act->form_type_id = $request->form_type;
        if(request('district') != 27){
            $Org_act->district_id = request('district');
        }
        else{
            $Org_act->province_id = request('province');
        }
        $org_id = Organization::where('title', request('organization'))->pluck('id');
        $Org_act->organization_id = $org_id[0];
        $Org_act->save();
        return redirect('/organization/actIndex')->with('message', 'Organization Successfully assigned to handle application');
    }

    public function activity_remove($id)
    {
        $organization = Organization_Activity::find($id);
        $organization->delete();
        return redirect('/organization/actIndex')->with('message', 'Organization Successfully removed from handling application');
    }

    public function organizationAutocomplete(Request $request)
    {
        $data = Organization::select("title")
            ->where("title", "LIKE", "%{$request->terms}%")
            ->get();

        return response()->json($data);
    }
}
