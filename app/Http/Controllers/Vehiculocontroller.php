<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // es necesario agregar esta clase para poder borrar datos del almacenamjiento del servidor
use Illuminate\Support\Facades\File;// es necesario agregar esta clase para poder mostrar imagenes
use Illuminate\Support\Facades\Response;// es necesario agregar esta clase para poder mostrar imagenes
use Illuminate\Http\Request;
use App\Model\Vehiculo;
use App\Model\Chofer;

class VehiculoController extends Controller{
	
	public function listado(){
		//$Vehiculo= Vehiculo::all(); // con esto recuperamos toda la informacion de labase de datos
		$Vehiculo=Vehiculo::join('choferes','choferes.id_Chofer','=','vehiculos.id_Chofer')
				->select('Marca'
					,'id_Vehiculo'
				   ,'Modelo'
				   ,'Placa'
				   ,'Year'
				   ,'Foto'
				   ,'choferes.Nombres as Chofer'
				)
				->get();
		$datos = array();
		$datos['Vehiculos_listado'] = $Vehiculo; //el indice es con el que llamaremos a la variable.
		return view('Vehiculos.listado')->with($datos);  // con esto hacemos que se devuelva una vista. 
	}

	public function formulario(Request $r){
		//con esto recibimos los datos de la petición
		$datos = $r->all();
		//Debemos identificar que tipo de peticion es la que recibimos y en base a ello hacer una u otra cosa
		if ($r->isMethod('POST')) {
			//POST significa que vamos a agregar
			//dd('vamos a agregar');
			$operacion='Agregar';
			$vehiculo=new Vehiculo();
		}
		else{
			//GET fue por enlace y significa que vamos a editar
			//dd('vamos a editar');
			$operacion='Editar';
			$vehiculo= Vehiculo::find($datos['id_Vehiculo']);
		}
		$informacion = array();

		//recuperaremos todoso los registros de la base de datos apra ponder ponerlas como opciones en el formulario 
		$chofer=Chofer::all();
		$informacion['operacion']=$operacion;
		$informacion['vehiculo']=$vehiculo;		
		$informacion['chofer']=$chofer;		
		return view('Vehiculos.formulario')->with($informacion);   
	}


	public function save (Request $r){
		$datos=$r->all();
		switch ($datos['operacion']) {
			case 'Agregar':
			//con el codigo if ($r->hasfile('foto')){} validamos si el campo tienje o no algun archivo
				if ($r->hasfile('foto')) {
					//guardmos el nombre en una variable archivo.
					$archivo = $r->file('foto');
					//le ponemos un timestamp
					$nombre= 'foto-'.time().'.'.$archivo->getClientOriginalExtension();
					//la funcion storeAs() mueve el archivo que subimos al file sistem, además esta fuincion de laravel nos crea una carpeta si no la tenemos creada.
					$nombre_archivo= $archivo->storeAs('fotos',$nombre);
				}
				else{
					//Si no se sube uin archivo le ponemos de noimbre una cadena vacia, para no dañar la base de datos.
					$nombre_archivo='';
				}

				$datos=$r->all(); 
				$vehiculo=new Vehiculo();	
				$vehiculo->Marca= $datos['marca'];
				$vehiculo->Modelo= $datos['modelo'];
				$vehiculo->Placa= $datos['placa'];
				$vehiculo->Year= $datos['año'];
				$vehiculo->id_Chofer = $datos['idChofer'];

				$vehiculo->Foto= $nombre_archivo;
				$vehiculo->save(); 
		
			break;

			case 'Editar':
				if ($r->hasfile('foto')) {
					//guardmos el nombre en una variable archivo.
					$archivo = $r->file('foto');
					//le ponemos un timestamp
					$nombre= 'foto-'.time().'.'.$archivo->getClientOriginalExtension();
					//la funcion storeAs() mueve el archivo que subimos al file sistem, además esta fuincion de laravel nos crea una carpeta si no la tenemos creada.

					$nombre_archivo= $archivo->storeAs('fotos',$nombre);
				}
				else{
					//Si no se sube uin archivo le ponemos de noimbre una cadena vacia, para no dañar la base de datos.
					$nombre_archivo='';
				}
				$vehiculo= Vehiculo::find($datos["id_Vehiculo"]);
				$vehiculo->Marca= $datos['marca'];
				$vehiculo->Modelo= $datos['modelo'];
				$vehiculo->Placa= $datos['placa'];
				$vehiculo->Year= $datos['año'];
				$vehiculo->id_Chofer= $datos['idChofer'];
				//El archvi viejo que se tiene en el file sistem es $vehiculo->Foto, sin embargo el nuevo archivo que se subira sera el $nombre, por lo cual debemos borrar el archivo viejo ($vehiculo->Foto) antes de cargar el nuevo. También vañlidamos ant4ees si lo que se ha modificado es el archivo o solo algun registro.
				if($nombre_archivo!=''){
					Storage::delete($vehiculo->Foto); //aca borrramos el archivo viejo
					$vehiculo->Foto= $nombre_archivo; //acá guardamos la referencia al archivo nuevo.
				}
				$vehiculo->save();
				
				
			break;

			case 'Eliminar':
				$vehiculo= Vehiculo::find($datos["id_Vehiculo"]);
				$vehiculo -> delete();
				//para borrar el archivos completamente, es decir borrandolo de la base de datos y del file sistem es necesario el sig. Código
				Storage::delete($vehiculo->Foto);
			
			break;
		}
		return $this->listado();
	}

	public function mostrarfoto($nombre_foto){
		//usamos la funcion storage_path que me devuelve la ruta de la foto
		$path = storage_path('app/fotos/'.$nombre_foto);
		//preguntamos si el archivo existe y si no existe devolvemos un 404
		if (!File::exists($path)) {
			abort(404);
		}
		//aqui recuperamos el contenido del archivo
		$file = File::get($path);
		//aqui recuperamos el tipo de archivo
		$type = File::mimeType($path);
		//devolvemos el archivo.
		$response= Response::make($file,200);
		$response-> header("Content-Type",$type);
		return $response;
	}
 
}