<?php  
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Permiso;


class PermisoController extends Controller{
	public function listado(){
		$permiso = Permiso::all();
		$datos = array();
		$datos['permiso'] = $permiso;
		return view('Permisos.listado')->with($datos);
	}

	public function formulario(Request $r){
		$datos = $r->all();

		if ($r->isMethod('POST')) 
		{
			$operacion = 'Agregar';
			$permiso = new Permiso();
		}
		else
		{
			$operacion = ' Editar';
			$permiso = Permiso::find($datos['id_permiso']);
		}

		$informacion = array();
		$informacion['operacion'] = $operacion;
		$informacion['permiso'] = $permiso;

		return view('Permisos.formulario')->with($informacion);		
	}

	public function save(Request $r){
		$datos = $r->all();
		switch ($datos['operacion']) {
			case 'Agregar':
				$datos=$r->all();
				$permiso = new Permiso();
				$permiso->nombre = $datos['nombre'];
				$permiso->Clave = $datos['clave'];
				$permiso->save();
				break;
			
			case 'Editar':
				$permiso = Permiso::find($datos['id_permiso']);
				$permiso->nombre = $datos['nombre'];
				$permiso->Clave = $datos['clave'];
				$permiso->save();
				break;

			case 'Eliminar':
				$permiso = Permiso::find($datos['id_permiso']);
				$permiso->delete();
				break;
		}
		return $this->listado();
		
	}
}
?>