<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Aeropuerto;
use App\Model\Servicios;
use App\Model\Aeropuerto_servicio;

class Aeropuerto_servicioController extends Controller{
	function formulario(Request $r){
		$datos=$r->all();
		$info= array();
		$servicios= Servicios::all();
		$asignadas = Aeropuerto_servicio::where('id_Aeropuerto',$datos['id_Aeropuerto'])->get();
		for ($i=0; $i <count($servicios) ; $i++) { 
			$bandera= false;

			foreach($asignadas as $elemento){
				if($elemento->id_Servicio == $servicios[$i]->id_Servicio ){
					$bandera = true;
				}
			}
			$servicios[$i]->asignado = $bandera;
		}

		$aeropuerto =Aeropuerto::find($datos['id_Aeropuerto']);
		$info['servicios']=$servicios;
		$info['aeropuerto']=$aeropuerto;
		return view('Aeropuerto_servicio.formulario')->with($info);
	}
	function save (Request $r){
		$datos=$r->all();
		//1er paso es  borrar todos los servicios de la base de datos
		Aeropuerto_servicio::where('id_Aeropuerto',$datos['id_Aeropuerto'])->delete();

		//cuando no se selecciona ningun checkbox no existe ningun datos entonces:
		if(isset($datos['id_Servicio'])){

			//2do paso  ionsertar todos los servicios de la peticion
			foreach ($datos['id_Servicio'] as $servicio) {
				$aeroserv = new Aeropuerto_servicio();
				$aeroserv->id_Aeropuerto = $datos['id_Aeropuerto'];
				$aeroserv->id_Servicio = $servicio;
				$aeroserv->save();
			}
		}
		return $this->formulario($r);
	}

}








?>