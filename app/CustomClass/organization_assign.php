<?php
namespace App\CustomClass;
 
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\Process_Item;
use App\Models\District;
use App\Models\User;
use App\Models\Organization_Activity;
use Illuminate\Support\Facades\Notification;
Use App\Notifications\AssignOrg;
Use App\Notifications\ApplicationMade;

class organization_assign
{
    public static function  auto_assign($P_id, $District)
    {
      $Process_Item = Process_Item::find($P_id);
      $activity_org = Organization_Activity::where('district_id',$District)->where('form_type_id',$Process_Item->form_type_id)->first();
      if($activity_org != null){
        $Process_Item->activity_organization = $activity_org->organization_id;
        $Process_Item->status_id=2;
      }
      else{
        $district=District::find($District);
        $activity_org2 = Organization_Activity::where('province_id',$district->province_id)->where('form_type_id',$Process_Item->form_type_id)->first();
        if($activity_org2 != null){
          $Process_Item->activity_organization = $activity_org2->organization_id;
          $Process_Item->status_id=2;
        }
        else{
            $activity_org3 = Organization_Activity::where('district_id',26)->where('form_type_id',$Process_Item->form_type_id)->first(); //checking for all island
          if($activity_org3 != null){
            $Process_Item->activity_organization = $activity_org3->organization_id;
            $Process_Item->status_id=2;
          }
          else{
            $Process_Item->activity_organization=2;
          }
        }
      }
      $Process_Item->save();
      $Process_Itemnew = Process_Item::find($P_id);
      $Users = User::where([
        ['role_id', '=', 3],
        ['organization_id', '=', $Process_Item->activity_organization],
      ])->orWhere([
          ['role_id', '=', 4],
          ['organization_id', '=', $Process_Item->activity_organization],
      ])->get();
      if($Process_Itemnew->status_id==2){
        Notification::send($Users, new AssignOrg($Process_Itemnew));
      }else{
        Notification::send($Users, new ApplicationMade($Process_Itemnew));
      }
      return $Process_Item->activity_organization;
    }
}