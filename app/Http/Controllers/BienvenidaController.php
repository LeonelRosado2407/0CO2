<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BienvenidaController extends Controller{
    public function mostrar(){
        return view('Bienvenida.Bienvenida');
    }

}
