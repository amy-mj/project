<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Campaign;

class Member extends Controller
{
    public function index(Request $request) {
        echo $request->aa;

        $cm = new Campaign();
        $cmp = $cm->retrieveGrp3();
        foreach($cmp as $cp)
        {
            print_r($cp);

        }
        

        return view('member.index');
    }
}
