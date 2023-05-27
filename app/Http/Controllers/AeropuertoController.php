<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Aeropuerto;

class AeropuertoController extends Controller{
	
	public function listado(){
		$Aeropuerto= Aeropuerto::all(); // con esto recuperamos toda la informacion de labase de datos
		$datos = array();
		$datos['Aeropuertos_listado'] = $Aeropuerto; //el indice es con el que llamaremos a la variable.
		return view('Aeropuerto.listado')->with($datos);  // con esto hacemos que se devuelva una vista. 
	}
	public function formulario(Request $r){
		//con esto recibimos los datos de la petición
		$datos = $r->all();
		//Debemos identificar que tipo de peticion es la que recibimos y en base a ello hacer una u otra cosa
		if ($r->isMethod('POST')) {
			//POST significa que vamos a agregar
			//dd('vamos a agregar');
			$operacion='Agregar';
			$aeropuerto=new Aeropuerto();
		}
		else{
			//GET fue por enlace y significa que vamos a editar
			//dd('vamos a editar');
			$operacion='Editar';
			$aeropuerto= Aeropuerto::find($datos['id_Aeropuerto']);
		}
		$informacion = array();
		$informacion['operacion']=$operacion;
		$informacion['aeropuerto']=$aeropuerto;
		//$informacion['descripcion']=$aeropuerto;		
		return view('Aeropuerto.formulario')->with($informacion);   
	}
	public function save (Request $r){
		$datos=$r->all();
		switch ($datos['operacion']) {
			case 'Agregar':
				$datos=$r->all(); 
				$aeropuerto=new Aeropuerto();	
				$aeropuerto->Nombre_Aeropuerto= $datos['nombre'];
				$aeropuerto->Ubicacion_Aeropuerto= $datos['Descripcion'];
				$aeropuerto->save();
		
			break;

			case 'Editar':
				$aeropuerto= Aeropuerto::find($datos["id_Aeropuerto"]);
				$aeropuerto->Nombre_Aeropuerto= $datos['nombre'];
				$aeropuerto->Ubicacion_Aeropuerto= $datos['Descripcion'];
				$aeropuerto->save();
				
				
			break;

			case 'Eliminar':
				$aeropuerto= Aeropuerto::find($datos["id_Aeropuerto"]);
				$aeropuerto -> delete();
			
			break;
			
			default:
				// code...
				break;
		}
		return $this->listado();
	}
 
}