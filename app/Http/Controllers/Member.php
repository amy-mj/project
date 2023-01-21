<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member as member_model;
//use App\Models\Campaign;

class Member extends Controller
{
    public function index(Request $request) {
        //echo $request->aa;

        //$cm = new Campaign();
        //$cmp = $cm->retrieveGrp3();

        $members = member_model::all();
        $return  = ['members' => $members];
        
        return view('member.index', $return);
    }
}
