<?php

namespace App\BusinessLogic;
use App\Model\Chofer;
use App\Model\Viajes;
use App\Model\Servicios;	
use App\Model\Aeropuerto;	
use App\Model\Horario;	

class BoViaje{
	function validar_viaje($objeto)
	{
		$bandera = true;

		$viaje = Viajes::where('id_Chofer',$objeto->id_Chofer)
		->whereRaw("atencion_inical <'".$objeto->fa_final."' and atencion_final >'".$objeto->fa_inicial."'")
		->get();
		if(count($viaje) !=0)
		{
			$bandera = false; 
		}
		return $bandera;
	}

	function registrar_Viaje($objeto)
	{
		$resultado = new \stdClass();

		/*Para registrar un Viaje necesito de:
		id_Viajes
		id_Chofer
		Clave_viaje
		Fecha_reserva (Opcional)
		Fecha_llegada*/

		//1.- Tratamiento de informacion
		//En este paso lo que hacemos es verificar los datos que recibimos y si alguno no recibimos poner uno por defecto
		if(!isset($objeto->Fecha_reserva))
		{
			$objeto->Fecha_reserva=date('Y-m-d H:i:s');
		}

		if(!isset($objeto->fa_inicial))
		{
			$horario=Horario::find($objeto->id_horario);
			$objeto->fa_inicial=$objeto->Fecha_llegada.' '.$horario->hora_inicial;
			$objeto->fa_final=$objeto->Fecha_llegada.' '.$horario->hora_final;

		}
	
		//1.- Tratamiento de informacion

		//2.- Validaciones
		$bandera = $this->validar_viaje($objeto);
		//2.- Validaciones

		//3.- crear infromacion
		if($bandera)
		{
			$resultado->status = 'OK';
			$resultado->mensaje = 'todo god';
			$viaje = new Viajes();
			$viaje->id_Chofer = $objeto->id_Chofer;
			$viaje->Clave_viaje = $objeto->Clave_viaje;
			$viaje->Fecha_reserva = $objeto->Fecha_reserva;
			$viaje->Fecha_llegada = $objeto->Fecha_llegada;
			$viaje->atencion_inical = $objeto->fa_inicial;
			$viaje->atencion_final = $objeto->fa_final;
			$viaje->id_horario = $objeto->id_horario;
			$viaje->id_Aeropuerto = $objeto->id_Aeropuerto;
			$viaje->id_Servicio = $objeto->id_Servicio;
			$viaje->save();
			$resultado->viaje = $viaje;
		}
		else
		{
			$resultado->status = 'Error';
			$resultado->mensaje = 'El Chofer no esta disponible para ese dia';
		}
		//3.- crear infromacion


		return $resultado;
	}
}