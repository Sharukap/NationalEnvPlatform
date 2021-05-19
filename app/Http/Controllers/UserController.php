<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process_Item;
use Carbon\Carbon;

class UserController extends Controller
{
    public function home()
    {
        $tree_removals = Process_Item::where('form_type_id', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $dev_projects = Process_Item::where('form_type_id', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        return view('unauthorized', [
            'tree_removals' => $tree_removals,
            'dev_projects' => $dev_projects
        ]);
    }

    public function dashboard()
    {
        if (Auth()->user()->role_id == 6) {
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
            $Process_items = Process_Item::all()->where('created_by_user_id', Auth()->user()->id);
            return view('general::generalA', [
                'Process_items' => $Process_items,
                'tree_removals' => $citizen_tree_removals,
                'dev_projects' => $citizen_dev_projects
            ]);
        } else {
            $tree_removals = Process_Item::where('form_type_id', 1)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count();
            $dev_projects = Process_Item::where('form_type_id', 2)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count();
            return view('unauthorized', [
                'tree_removals' => $tree_removals,
                'dev_projects' => $dev_projects
            ]);
        }
    }
}
