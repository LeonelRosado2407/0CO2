<?php  
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Permiso;
use App\Model\Rol;
use App\Model\Rolxpermiso;

class RolxpermisoController extends Controller{
	function formulario (Request $r){
		$datos = $r->all();
		$info = array();
		$permiso = Permiso::all();
		$asignadas = Rolxpermiso::where('id_rol',$datos['id_rol'])->get();
		for ($i=0; $i <count($permiso) ; $i++) { 
			$bandera= false;

			foreach($asignadas as $elemento){
				if($elemento->id_permiso == $permiso[$i]->id_permiso ){
					$bandera = true;
				}
			}
			$permiso[$i]->asignado = $bandera;
		}
		$rol = Rol::find($datos['id_rol']);
		$info['permiso']=$permiso;
		$info['rol']=$rol;
		return view('Rolxpermiso.formulario')->with($info);
	}
	function save(Request $r){
		$datos=$r->all();
		Rolxpermiso::where('id_rol',$datos['id_rol'])->delete();

		if(isset($datos['id_permiso']))
		{
			foreach ($datos['id_permiso'] as $permiso) {
				$rolpermiso = new Rolxpermiso();
				$rolpermiso->id_rol = $datos['id_rol'];
				$rolpermiso->id_permiso = $permiso;
				$rolpermiso->save();
			}
		}
		return $this->formulario($r);

	}

}
?>