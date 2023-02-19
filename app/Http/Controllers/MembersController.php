<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
//use App\Models\Campaign;
use App\Http\Controllers\Document;

class MembersController extends BaseController
{
    public function index(Request $request)
    {
        return view('member.index');
    }

    public function list(Request $request) 
    {
        $page             = 1; 
        $where = array();
        foreach($request->all() as $key => $val) {
            if($key === "page_num") {
                //$$key = $val;
                $page = (int) $val;
                continue;
            }
            $where[$key] = $val;
        }

        $membersTotal     = Members::count($where);
        $paging           = $this->paging($page, $membersTotal);
        $pagingForMembers = ['page' => $this->getStartNum($page), 'limit' => $this->limitForPaging];
        $members          = Members::retrieve($where, $pagingForMembers);
        $return           = ['members' => $members, 'membersTotal' => $membersTotal, 'paging' => $paging];

        return  view('member.list', $return);
    }

    public function register(Request $request)
    {
        return  view('member.register');
    }


}
