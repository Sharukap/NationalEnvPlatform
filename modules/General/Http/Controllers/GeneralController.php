<?php

namespace General\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Process_Item;

class GeneralController extends Controller
{

    public function showRequests()
    {
        $items = Process_Item::where('created_by_user_id', '=', Auth::user()->id)->orderby('id','desc')->paginate(10);
        return view('approvalItem::requests', [
            'items' => $items,
        ]);
    }

    public function pending()
    {
        // dd('test');
        $organization = Auth::user()->organization_id;
        $role = Auth::user()->role_id;
        $id = Auth::user()->id;
        $tree_removals = Process_Item::where('form_type_id', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $dev_projects = Process_Item::where('form_type_id', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        //IF ADMIN DISPLAYS ALL THE PENDING REQUESTS TO BE ASSIGNED
        if ($role == 1 || $role == 2) {
            $Process_items = Process_Item::where([
                ['status_id', '=', 1],
                ['form_type_id', '<', 5],
            ])->orderby('id','desc')->paginate(10);
            return view('general::generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        }
        //IF HOO OR MANAGER, DISPLAYS ALL THE PENDING REQUESTS OF THEIR ORGANIZATION
        if ($role == 3 || $role == 4) {
            $Process_items = Process_Item::where('status_id', '>=', 2)->where('activity_organization', $organization)->where('form_type_id', '<', 5)->orderby('id','desc')->paginate(10);

            return view('general::generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        }

        //IF STAFF DISPLAYS ALL THE REQUESTS ASSIGNED TO THEM
        else if ($role == 5) {
            $Process_items = Process_Item::where('activity_user_id', $id)->where('form_type_id', '<', 5)->orderby('id','desc')->paginate(10);
            return view('general::generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        }
        //IF CITIZEN, DISPLAYS THE REQUESTS MADE
        else if ($role == 6) {
            $citizen_tree_removals = Process_Item::where([
                ['form_type_id', '=', 1],
                ['created_by_user_id', '=', Auth()->user()->id]
            ])->whereMonth('created_at', Carbon::now()->month)
                ->count();
            $citizen_dev_projects = Process_Item::where([
                ['form_type_id', '=', 2],
                ['created_by_user_id', '=', Auth()->user()->id]
            ])->whereMonth('created_at', Carbon::now()->month)
                ->count();
            $Process_items = Process_Item::where('created_by_user_id', $id)->orderby('id','desc')->paginate(10);
            return view('general::generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $citizen_tree_removals,
                'dev_projects' => $citizen_dev_projects
            ]);
        } else {
            return view('admin::unauthorized')->with('Msg', 'User is not authorized');
        }
    }

    public function filter_process_items(Request $request)
    {
        $request->validate([
            'form_type' => 'required|not_in:0',
        ]);
        $type = $request['form_type'];
        $organization = Auth::user()->organization_id;
        $role = Auth::user()->role_id;
        $id = Auth::user()->id;
        $tree_removals = Process_Item::where('form_type_id', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $dev_projects = Process_Item::where('form_type_id', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        if ($role == 1 || $role == 2) {
            $Process_items = Process_Item::where('form_type_id', $type)->orderby('id')->paginate(10);
            return view('general::generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        }

        if ($role == 3 || $role == 4) {
            $Process_items = Process_Item::where('activity_organization', $organization)->where('form_type_id', $type)->where('status_id', '>=', 2)->orderby('id','desc')->paginate(10);
            return view('general::generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        } else if ($role == 5) {
            $Process_items = Process_Item::where('activity_user_id', $id)->where('form_type_id', $type)->orderby('id','desc')->paginate(10);
            return view('general::.generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        } else if ($role == 6) {
            $Process_items = Process_Item::where('created_by_user_id', $id)->where('form_type_id', $type)->orderby('id','desc')->paginate(10);
            return view('general::.generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        } else {
            return view('unauthorized')->with('message', 'No access to general module');
        }
    }
}
