<?php
namespace Organization\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use App\Models\Type;
use App\Models\Activity;
use App\Models\Province;

class TypeController extends Controller
{
    public function getTypesList()
    {
        $org_type = Type::all();
        $Activities=Activity::all();
        $Provinces = Province::all();
        return view('organization::create')->with('org_type', $org_type)->with('Activities', $Activities)->with('Provinces', $Provinces);
    }

    public function edit()
    {
        $org_type = Type::all();
       
        return view('organization::edit')->with('org_type', $org_type);
    }
}
