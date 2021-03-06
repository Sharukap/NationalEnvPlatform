<?php
namespace App\CustomClass;
 
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\Process_Item;
use App\Models\Land_Parcel;
use App\Models\Land_Has_Gazette;


class lanparcel_creation
{
    public static function  land_save($request)
    {
        $land = new Land_Parcel();
        $land->title = $request->landTitle;
        if (($request->surveyorName)!= null) {
            $land->surveyor_name = $request->surveyorName;
        } else {
            $land->surveyor_name = "not given";
        }
        

        //$land->governing_organizations = request('governing_orgs');
        if (($request->governing_orgs)!= null) {
            $land->governing_organizations = request('governing_orgs');
        } else {
            $land->governing_organizations = [];
        }
        
        $land->polygon = request('polygon');
        $land->created_by_user_id = request('create_by');
        if (request('isProtected')) {
            $land->protected_area = request('isProtected');
        }
        
        $land->status_id = 1;
        dd("i");
        $land->save();
        
        $landid = Land_Parcel::latest()->first()->id;
        if (request('gazettes')) {

          $gazettes = request('gazettes');

          foreach ($gazettes as $gazette) {
              $land_has_gazette = new Land_Has_Gazette();
              $land_has_gazette->land_parcel_id = $landid;
              $land_has_gazette->gazette_id = $gazette;
              $land_has_gazette->status = 2;
              $land_has_gazette->save();
          }
      }
        
        return $landid;
    }
    public static function  landprocesses_save($request,$landid,$pid){
      if (request('governing_orgs')) {
        $governing_organizations = request('governing_orgs');

        foreach ($governing_organizations as $governing_organization) {
            $land_has_organization = new Land_Has_Organization();
            $land_has_organization->land_parcel_id = $landid;
            $land_has_organization->organization_id = $governing_organization;
            $land_has_organization->status = 1;
            $land_has_organization->save();

            $process = new Process_Item();
            $process->form_type_id = 5;
            $process->form_id = $landid;
            $process->created_by_user_id = request('createdBy');
            $process->request_organization = Auth::user()->organization_id;
            $process->activity_organization = $governing_organization;
            $process->prerequisite_id = $pid; 
            $landProcess->prerequisite = 1;  
            $process->save();
        }
    }


    }
}