<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Viajes;
use App\Model\Chofer;
use App\Model\Servicios;
use App\Model\Aeropuerto;

class ViajesController extends Controller{
	public function listado(Request $r){

		$context=$r->all();
		$viajes=Viajes::join('aeropuerto','aeropuerto.id_Aeropuerto','=','viajes.id_Aeropuerto')
		->join('servicios','servicios.id_Servicio','=','viajes.id_Servicio')
		->join('horario','horario.id_horario','=','viajes.id_horario')
		->select(
			"id_Viajes"
			,"id_Chofer"
			,"Clave_viaje"
			,"aeropuerto.Nombre_Aeropuerto as aeropuerto"
			,"servicios.Nombre_Servicio as servicio"
			,"horario.hora_inicial as hora_inicial"
			,"horario.hora_final as hora_final"
			,DB::Raw("DATE_FORMAT(Fecha_reserva,'%Y-%m-%d') as Fecha_Reservacion")
			,DB::Raw("DATE_FORMAT(Fecha_llegada,'%Y-%m-%d') as Fecha_Llegada")
			,DB::Raw("DATE_FORMAT(atencion_inical,'%Y-%m-%d') as inicial")
			,DB::Raw("DATE_FORMAT(atencion_final,'%Y-%m-%d') as final")
		)
		->where('id_Chofer',$context['id_Chofer'])
		->get();
		$chofer=Chofer::find($context['id_Chofer']);
		$datos = array();
		$datos['Viajes_listado'] = $viajes;
		$datos['chofer']=$chofer;

		return view('Viajes.listado')->with($datos);
	}

	public function formulario(Request $r){
		$datos = $r->all();
		if($r->isMethod('POST')){
			$operacion = 'Agregar';
			$viajes = new Viajes();
			$viajes->id_Chofer = $datos['id_Chofer'];
		}
		else{
			$operacion='Editar';
			$viajes = Viajes::find($datos['id_Viajes']);
		}
		$servicio = Servicios::all();
		$aeropuerto = Aeropuerto::all();
		//$chofer=Chofer::find($datos['id_Chofer']);
		$informacion = array();
		$informacion['operacion'] = $operacion;
		$informacion['viajes'] = $viajes;
		$informacion['servicios_nombre']=$servicio;
		$informacion['aeropuertos_nombre']=$aeropuerto;
		//$informacion['chofer'] = $chofer;
		return view('Viajes.formulario')->with($informacion);
	}
	public function save(Request $r){
		$datos = $r->all();
		date_default_timezone_set("America/Merida");
		// dd($datos);
		switch ($datos['operacion']) {
			case 'Agregar':
				$datos = $r->all();
				$viajes = new Viajes();
				$viajes->Fecha_reserva = date('Y-m-d H:i:s');
				$viajes->Fecha_llegada = $datos['llegada'];
				$viajes->Clave_viaje = $datos['viaje'];
				$viajes->id_Chofer = $datos['id_Chofer'];
				$viajes->id_Servicio = $datos['id_Servicio'];
				$viajes->id_Aeropuerto = $datos['id_Aeropuerto'];
				$viajes->atencion_inical = $datos['atencion_inical'];
				$viajes->atencion_final = $datos['atencion_final'];
				$viajes->id_horario = 1;
				$viajes->save();
				break;
			case 'Editar':
				$viajes=Viajes::find($datos["id_Viajes"]);
				$viajes->Fecha_llegada = $datos['llegada'];
				$viajes->Clave_viaje = $datos['viaje'];
				$viajes->id_Chofer = $datos['id_Chofer'];
				$viajes->id_Servicio = $datos['id_Servicio'];
				$viajes->id_Aeropuerto = $datos['id_Aeropuerto'];
				$viajes->atencion_inical = $datos['atencion_inical'];
				$viajes->atencion_final = $datos['atencion_final'];
				$viajes->id_horario = 2;
				$viajes->save();
				break;
			case 'Eliminar':
				$viajes=Viajes::find($datos["id_Viajes"]);
				$viajes->delete();

				break;
			default:
				// code...
				break;
		}
		return $this->listado($r);
	}
}
?>