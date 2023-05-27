<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
//use App\Model\Libro;
use App\BusinessLogic\BoViaje;

class DemoController extends Controller{

	public function prueba_bo()
	{
		$boviaje = new BoViaje();
		$x = new \stdClass();
		$x->id_Chofer = 6;
		$x->Clave_viaje = 'Cuarto viaje';
		// $x->Fecha_reserva = '2022-12-04 19:00:23 ';
		$x->Fecha_llegada = '2022-12-05';
		$x->id_Aeropuerto = 7;
		$x->id_Servicio = 5;
/*		$x->atencion_inical = '';
		$x->atencion_final = '';*/
		$x->id_horario = 1;
		$y = $boviaje->registrar_Viaje($x);
		dd($y);
	}
}