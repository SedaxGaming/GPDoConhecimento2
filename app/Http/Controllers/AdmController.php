<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmController extends Controller
{
    public function layout(){
        return view("adm/painel");
    }
    public function menuCadastros(){
        return view("adm/cadastros");
    }
    public function menuJuri(){
        return view("adm/juri");
    }
    public function placar(){
        return view("adm/placar");
    }
    public function cronometro(){
        return view("adm/cronometro");
    }
}
