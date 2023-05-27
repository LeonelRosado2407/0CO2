<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//incluimos los modelos
use App\Model\Chofer;
use App\Model\Vehiculo;
//Incluimos la libreria de faker
use Faker\Factory as Faker;

class DbUpController extends Controller{
	public function Chofer(){
		$faker = Faker::create();
		for ($i=1; $i <=50 ; $i++) { 
			$chofer = new Chofer();
			$chofer->Nombres= $faker->name;
			$chofer->Apellidos = $faker->lastname;
			$chofer->Edad = $faker->regexify('([0-9]{2})');
			$chofer->CURP = $faker->regexify('([A-Z0-9]){10}');
			$chofer->save();
			//nombre

			//Apellidos

			//Edad

			//CURP

			//marca
			//$chofer->Marca=$faker->company; 
			
		}
	}

	public function pruebas(){
		$faker = Faker::create();
		$marcas= array('Hyundai','Toyota','Ford','Tesla','Chrevolet','Volkswagen','Honda','Nissan');
		$modelos= array('N vision 74','RN22e','Prius hybrid','Corolla Hybrid','Model 3');
		$chofer = Chofer::all();
		for ($i=1; $i <=50 ; $i++) { 
			//echo $faker->regexify('([Aa-zZ0-9]){15}').'<br>'; 
			// echo $faker->regexify('(Y|W|X|Q){1}([A-Z]){2}-([0-9]{2})-([0-9]{2})').'<br>';
			// echo $faker->numberBetween(2020,2022).'<br>';
			// echo $faker->randomElement($marcas).'<br>';
			// echo $faker->randomElement($modelos).'<br>';
			echo $chofer->random()->id_Chofer.'<br>';
		}
	}

	public function vehiculos(){
		$faker = Faker::Create();
		$marcas= array('Hyundai','Toyota','Ford','Tesla','Chrevolet','Volkswagen','Honda','Nissan');
		$modelos= array('N vision 74','RN22e','Prius hybrid','Corolla Hybrid','Model 3');
		$chofer = Chofer::all();
		for ($i=1; $i <=50 ; $i++) { 
			$vehiculo= new Vehiculo();
			$vehiculo->Marca = $faker->randomElement($marcas);
			$vehiculo->Modelo=$faker->randomElement($modelos);
			$vehiculo->Placa=$faker->regexify('(Y|W|X|Q){1}([A-Z]){2}-([0-9]{2})-([0-9]{2})');
			$vehiculo->Year=$faker->numberBetween(2020,2022);
			$vehiculo->Foto='';
			$vehiculo->id_Chofer=$chofer->random()->id_Chofer;
			$vehiculo->save();



		}
	}

 
}