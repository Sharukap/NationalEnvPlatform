<?php

namespace Admin\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Organization;
use App\Models\Designation;
use App\Models\Access;
use App\Models\Role_has_access;
use App\Models\User_has_access;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    // Deletes selected record from the admin Home view.
    public function destroy($id)     
    {
        $user = User::find($id);
        $user->update([
            'status' => -1,
        ]);
        return redirect('/user/index')->with('message', 'User Successfully Deleted');
    }

    // Open the view to be able to change the selected user's privileges (roles and module access)
    public function changePrivilege($id)          
    {
        $roles = Role::where('id', '>', 1)->get(); 
        $user = User::find($id);
        $Useraccesses=User_has_access::where('user_id',$id)->get();
        $existaccess=User_has_access::select('access_id')->where('user_id',$id)->get()->toArray();
        $accesses=Access::whereNotIn('id',$existaccess)->get();
        return view('admin::admin.privilege', [
            'user' => $user,
            'roles' => $roles,
            'accesses' => $accesses,
            'Useraccesses' =>$Useraccesses,
        ]);
    }

    // Privileges changed will be saved to the db using this function.
    public function savePrivilege(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'role_id' => $request->role,
        ]);
        return redirect('/user/index')->with('message', 'Privilege Updated Successfully');
    }

    // When user clicks on the Activate users button in admin Home, this function
    // will open the selfRegistered view.
    public function showSelfRegistered()           
    {
        $users = User::where('status', 0)->get();   //get only records where the status = 0 = self registered users.
        return view('admin::admin.selfRegistered', [
            'users' => $users,
        ]);
    }

    // Opens the view to activate users (Activate button in the selfRegistered view)
    public function showActivate($id)    
    {
        $roles = Role::where('id', '>', 1)->get(); 
        $organizations = Organization::all();
        $designations = Designation::all();
        $user = User::find($id);
        return view('admin::admin.activate', [
            'user' => $user,
            'organizations' => $organizations,
            'designations' => $designations,
            'roles' => $roles,
        ]);
    }

    // Activates the user by saving the new data to the database and setting the user status to 1.
    public function activate(Request $request, $id)     
    {
        $request->validate([
            'designation' => 'required|exists:designations,id',
            'organization' => 'required|exists:organizations,id',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::find($id);
        $user->update([
            'status' => $request->status,
            'role_id' => $request->role,
            'designation_id' => $request->designation,
            'organization_id' => $request->organization,
        ]);
        return redirect('/admin/showSelfRegistered')->with('message', 'User Activated Successfully');
    }

    public function index()
    {
        $roles = Role::where('id', '>', 1)->get(); 
        return view('admin::admin.roles', [
            'roles' => $roles,
        ]);

    }

    public function roleedit($id)
    {
        //dd($id);
        $role = Role::find($id);
        $roleaccesses=Role_has_access::where('role_id',$id)->get();
        $existrole=Role_has_access::select('access_id')->where('role_id',$id)->get()->toArray();
        $accesses=Access::whereNotIn('id',$existrole)->get();
        return view('admin::admin.roleedit', [
            'role' => $role,
            'accesses' => $accesses,
            'roleaccesses' =>$roleaccesses,
        ]);
    }

    public function roleupdate(Request $request,$id)
    {
        foreach($request->modules as $newaccess)
        {
            $roleaccess=new Role_has_access();
            $roleaccess->role_id=$id;
            $roleaccess->access_id=$newaccess;
            $roleaccess->save();
        }
        return redirect()->route('roleedit', ['id' =>$id])->with('message', 'Access permission granted Successfully');
    }

    public function accessremove($id)
    {
        $roleId =Role_has_access::where('id',$id)->value('role_id');
        Role_has_access::where('id',$id)->delete();
        return redirect()->route('roleedit', ['id' =>$roleId])->with('message', 'Access permission withdrawn Successfully');
    }

    public function user_access_update(Request $request,$id)
    {
        foreach($request->modules as $newaccess)
        {
            $useraccess=new User_has_access();
            $useraccess->user_id=$id;
            $useraccess->access_id=$newaccess;
            $useraccess->save();
        }
        return redirect()->route('privilegeview', ['id' =>$id])->with('message', 'Special access permission granted Successfully');
    }

    public function user_access_remove($id)
    {
        $userId =User_has_access::where('id',$id)->value('user_id');
        User_has_access::where('id',$id)->delete();
        return redirect()->route('privilegeview', ['id' =>$userId])->with('message', 'Special access permission withdrawn Successfully');
    }
}
