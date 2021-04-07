<?php

namespace UserIntruction\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserIntructionController extends Controller
{
    // public function home()
    // {
    //     $name = 'Yashod';
    //     return view('treeRemoval::home', compact('name'));
    // }

    public function test()
    {
       
        return view('UserIntruction::test', [

        ]);
    }

}
