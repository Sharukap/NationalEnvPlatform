<?php
namespace Organization\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use App\Models\Contact;
use App\Models\Province;
use App\Models\Activity;
use App\Models\Org_Activity;
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
           
            'title' => 'required',
            'city' => 'required',
            'organization_type' => 'required',
            'type' => 'required',
           'contact_signature' => 'required',
           'province'=>'required',
         
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
        

        $contact_signature = $request->contact_signature;
        $count = count((array)$type);
        
        for ($i = 0;$i < $count;$i++) {
            $contact = new Contact();
            $contact->org_id = $organization->id;
            $contact->type = $request->type[$i];
            $contact->contact_signature = $request->contact_signature[$i];
            $contact->primary = $request->primary;
            $contact->status = $request->status;
            $contact->save();
        }
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
        $Activities=Activity::all();
        $organization = Organization::find($id);
       
        $contact = Contact::Where('org_id', $id)->get();
        $ORG_ACT= Org_Activity::Where('organization_id', $id)->get();

        //dd($contact);
        //direct back to the index page.
        return view(
            'organization::edit',
            ['organization' => $organization,
        'contact' => $contact,
         'ORG_ACT' => $ORG_ACT,
         'org_type'=> $org_type,
          'Activities'=>$Activities,
         ]
        );
    }

    
    // When the admin clicks the submit button in the edit view, the following data will be
    // patched for the relavant organization who is being edited and saved in the db.
    public function update(Request $request, $id)
    {
        $organization = Organization::find($id);
        $organization->update([
            'title' => $request->title,
            'city' => $request->city,
            'country' => $request->country,
            'type_id' => $request->organization_type,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $contact = Contact::find($id);
        $contact->update([
            'org_id' => $organization->id,
            'type' => $request->type,
            'contact_signature' => $request->contact_signature,
            'primary' => $request->primary,
            'status' => $request->status,
        ]);
        $ORG_ACT =Org_Activity::find($id);
        $ORG_ACT->update([
            'organization_id' => $organization->id,
            'activity_id' => $request->activity,
           'province_id' => $request->province,

        ]);
           


        //direct back to the index page.
        return redirect('/organization/index')->with('message', 'Organization Updated Successfully');
    }

    // Routing logic
    public function index()
    {
        $organization = Organization::all();
        $contact = Contact::all();
        $ORG_ACT= Org_Activity::all();
        //direct back to the index page.
        return view('organization::index')->with('organization', $organization)->with('contact', $contact)->with('ORG_ACT', $ORG_ACT);
    }

    public function destroy($id)
    {
        $organization = Organization::find($id);
        $organization->delete();
        return redirect('/organization/index')->with('message', 'Organization Deleted');
    }
}
