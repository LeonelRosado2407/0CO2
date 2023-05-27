<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Chofer;
use App\Model\Viajes;

class ChoferController extends Controller{
	
	public function listado(){
		$Chofer= Chofer::all(); // con esto recuperamos toda la informacion de labase de datos
		$datos = array();
		$datos['Chofer_listado'] = $Chofer; //el indice es con el que llamaremos a la variable.
		return view('Chofer.listado')->with($datos);  // con esto hacemos que se devuelva una vista. 
	}
	public function formulario(Request $r){
		//con esto recibimos los datos de la petición
		$datos = $r->all();
		//Debemos identificar que tipo de peticion es la que recibimos y en base a ello hacer una u otra cosa
		if ($r->isMethod('POST')) {
			//POST significa que vamos a agregar
			//dd('vamos a agregar');
			$operacion='Agregar';
			$chofer=new Chofer();
		}
		else{
			//GET fue por enlace y significa que vamos a editar
			//dd('vamos a editar');
			$operacion='Editar';
			$chofer= Chofer::find($datos['id_Chofer']);
		}
		$informacion = array();
		$informacion['operacion']=$operacion;
		$informacion['chofer']=$chofer;	
		return view('Chofer.formulario')->with($informacion);   
	}
	public function save (Request $r){
		$datos=$r->all();
		switch ($datos['operacion']) {
			case 'Agregar':
				$datos=$r->all(); 
				$chofer=new Chofer();	
				$chofer->Nombres= $datos['nombres'];
				$chofer->Apellidos= $datos['apellidos'];
				$chofer->Edad= $datos['edad'];
				$chofer->CURP= $datos['curp'];
				$chofer->save();
		
			break;

			case 'Editar':
				$chofer= Chofer::find($datos["id_Chofer"]);
				$chofer->Nombres= $datos['nombres'];
				$chofer->Apellidos= $datos['apellidos'];
				$chofer->Edad= $datos['edad'];
				$chofer->CURP= $datos['curp'];
				$chofer->save();
				
				
			break;

			case 'Eliminar':
				$chofer= Chofer::find($datos["id_Chofer"]);
				$chofer -> delete();
			
			break;
			
			default:
				// code...
				break;
		}
		return $this->listado();
	}
}