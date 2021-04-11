<?php

namespace CrimeReport\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
Use App\Notifications\ApplicationMade;
use Illuminate\Http\Request;
use App\Models\Land_Parcel;
use App\Models\Crime_report;
use App\Models\Crime_type;
use App\Models\User;
use App\Models\Process_item;
use App\Models\Organization;
use App\Models\tree_removal_request;


class CrimeReportController extends Controller
{

    public function test()     
    {
        return view('general::generalA');   
    }
    
}

