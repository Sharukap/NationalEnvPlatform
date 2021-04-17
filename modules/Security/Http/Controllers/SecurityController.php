<?php

namespace Security\Http\Controllers;


use App\Models\Process_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SecurityController extends Controller
{
    

    public function moredetails($id,$pid)
    {
        $process_item = Process_Item::find($pid);
        $audit = $process_item->audits()->find($id);
        $data =$audit->old_values;
        $datanew=$audit->new_values;
        //dd($audit);
        return view('Security::recordsview', [
            'data' => $data,
            'datanew' => $datanew,
            'audit' => $audit,
            'process_item' =>$process_item,
        ]);
    }

    public function auditdisplay($id)
    {
        $process_item = Process_Item::find($id);
        $Audits = $process_item->audits()->get();
        
        return view('Security::mainview', [
            'Audits' => $Audits,
            'process_item' => $process_item,
        ]);
    }

}
