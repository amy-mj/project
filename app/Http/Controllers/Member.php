<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member as member_model;
//use App\Models\Campaign;

class Member extends Controller
{
    public function index(Request $request)
    {


        return view('member.index');
    }

    public function list(Request $request) 
    {
        $where = array();
        foreach($request->all() as $key => $val) {
            $$key = $val;
            $where[$key] = $val;
        }
        $return             = ['members' => member_model::retrieve($where)];
        
        return  view('member.list', $return);
    }

    private function printToJson($data)
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE );
    }
}
