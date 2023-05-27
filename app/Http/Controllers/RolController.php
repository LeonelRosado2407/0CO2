<?php  

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Rol;

class RolController extends Controller{

	public function listado(){
		$rol = Rol::all();
		$datos = array();
		$datos['rol'] = $rol;
		return view('Rol.listado')->with($datos);
	}

	public function formulario(Request $r){
		$datos = $r->all();
		if ($r->isMethod('POST')) {
			$operacion='Agregar';
			$rol = new Rol();
		}
		else{
			$operacion = 'Editar';
			$rol = Rol::find($datos['id_rol']);
		}
		$informacion = array();
		$informacion['operacion']=$operacion;
		$informacion['rol']=$rol;
		//$informacion['descripcion']=$aeropuerto;		
		return view('Rol.formulario')->with($informacion);
	}

	public function save(Request $r){
		$datos= $r->all();
		switch($datos['operacion']){
			case 'Agregar':
				$datos = $r->all();
				$rol = new Rol();
				$rol->nombre = $datos['nombre'];
				$rol->save();
				break;

			case 'Editar':
				$rol = Rol::find($datos["id_rol"]);
				$rol->nombre=$datos['nombre'];
				$rol->save();
				break;

			case 'Eliminar':
				$rol = Rol::find($datos["id_rol"]);
				$rol->delete();
				break;
		}
		return $this->listado();
	}
}
?>