<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Servicios;

class ServiciosController extends Controller{
	
	public function listado(){
		$servicios= Servicios::all(); // con esto recuperamos toda la informacion de labase de datos
		$datos = array();
		$datos['servicios'] = $servicios;
		return view('Servicios.listado')->with($datos);  // con esto hacemos que se devuelva una vista. 
	}
	public function formulario(Request $r){
		//con esto recibimos los datos de la petición
		$datos = $r->all();
		//Debemos identificar que tipo de peticion es la que recibimos y en base a ello hacer una u otra cosa
		if ($r->isMethod('POST')) {
			//POST significa que vamos a agregar
			//dd('vamos a agregar');
			$operacion='Agregar';
			$servicio=new Servicios();
		}
		else{
			//GET fue por enlace y significa que vamos a editar
			//dd('vamos a editar');
			$operacion='Editar';
			$servicio= Servicios::find($datos['id_Servicio']);
		}
		$informacion = array();
		$informacion['operacion']=$operacion;
		$informacion['servicio']=$servicio;
		return view('Servicios.formulario')->with($informacion);   
	}
	public function save(Request $r){
		$datos=$r->all();
		switch ($datos['operacion']) {
			case 'Agregar':
				$datos=$r->all(); 
				$servicio=new Servicios();
				$servicio->Nombre_Servicio= $datos['servicio'];
				$servicio->Descripcion= $datos['Descripcion'];
				$servicio->Precio= $datos['Precio'];
				$servicio->save();
		
			break;

			case 'Editar':
				$servicio= Servicios::find($datos["id_Servicio"]);
				$servicio->Nombre_Servicio= $datos['servicio'];
				$servicio->Descripcion= $datos['Descripcion'];
				$servicio->Precio= $datos['Precio'];
				$servicio->save();
				
				
			break;

			case 'Eliminar':
				$servicio= Servicios::find($datos["id_Servicio"]);
				$servicio -> delete();
			
			break;
			
			default:
				// code...
				break;
		}
		return $this->listado();
	}
 
}