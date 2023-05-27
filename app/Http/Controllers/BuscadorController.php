<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuscadorController extends Controller{
	function index(Request $r){

		$context=$r->all();

		if ($r->isMethod('POST')) {
			$registro = DB::table('vehiculos')
			->Join('choferes','choferes.id_Chofer','=','vehiculos.id_Chofer')
			->select('Marca'
				   ,'Modelo'
				   ,'Placa'
				   ,'Year'
				   ,'Foto'
				   ,DB::Raw('choferes.Nombres as Chofer')
			)
			->whereRaw("choferes.Nombres like '%".$context['criterio']."%' or Marca like'%".$context['criterio']."%' or Modelo like '%".$context['criterio']."%' or PLaca like '%".$context['criterio']."%' or Year like '%".$context['criterio']."%' or Foto like '%".$context['criterio']."%'")
			->get();

			$Datos = array();
			$Datos['registro']=$registro;
			$Datos['criterio']=$context['criterio'];
		}
		else{
			$Datos = array();
			$Datos['criterio']='';
			$Datos['registro']=array();
		}

		return view('Buscador.index')->with($Datos);
		/*
		select Marca
			   ,Modelo
			   ,Placa
			   ,Year
			   ,Foto
			   ,choferes.Nombres
		from vehiculos
		join choferes on choferes.id_Chofer=vehiculos.id_Chofer
		*/
	} 

	function pruba (Request $r){
		$vechiculos = DB::table('vehiculos')
		->join('choferes','choferes.id_Chofer','=','vehiculos.id_Chofer')
		->get();
		dd($vechiculos);
	}

	function mostrar(){
		return view('Buscador.index');
	}
}