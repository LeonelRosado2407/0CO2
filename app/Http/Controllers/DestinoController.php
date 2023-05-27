<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Destino;

class DestinoController extends Controller{
	
	public function listado(){
		$Destino= Destino::all(); // con esto recuperamos toda la informacion de labase de datos
		$datos = array();
		$datos['Destino_listado'] = $Destino;
		return view('Destino.listado')->with($datos);  // con esto hacemos que se devuelva una vista. 
	}
	public function formulario(Request $r){
		//con esto recibimos los datos de la petición
		$datos = $r->all();
		//Debemos identificar que tipo de peticion es la que recibimos y en base a ello hacer una u otra cosa
		if ($r->isMethod('POST')) {
			//POST significa que vamos a agregar
			//dd('vamos a agregar');
			$operacion='Agregar';
			$destino=new Destino();
		}
		else{
			//GET fue por enlace y significa que vamos a editar
			//dd('vamos a editar');
			$operacion='Editar';
			$destino= Destino::find($datos['id_Destinos']);
		}
		$informacion = array();
		$informacion['operacion']=$operacion;
		$informacion['destino_editar']=$destino;
		return view('Destino.formulario')->with($informacion);   
	}
	public function save(Request $r){
		$datos=$r->all();
		switch ($datos['operacion']) {
			case 'Agregar':
				$datos=$r->all(); 
				$destino=new Destino();
				$destino->Nombre_Destino= $datos['Destino'];
				$destino->Ubicacion_Destino= $datos['Direccion'];
				$destino->save();
		
			break;

			case 'Editar':
				$destino= Destino::find($datos["id_Destinos"]);
				$destino->Nombre_Destino= $datos['Destino'];
				$destino->Ubicacion_Destino= $datos['Direccion'];
				$destino->save();
				
				
			break;

			case 'Eliminar':
				$destino= Destino::find($datos["id_Destinos"]);
				$destino -> delete();
			
			break;
		}
		return $this->listado();
	}
 
}