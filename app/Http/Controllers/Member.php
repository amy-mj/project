<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Member extends Controller
{
    public function index() {
        return view('member.index');
    }
}
