<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function header(){
        return view('/includes/header');
    }

    public function footer(){
        return view('/includes/footer');
    }
}
