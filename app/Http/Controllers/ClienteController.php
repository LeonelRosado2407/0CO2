<?php  
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Cliente;
use App\Model\Rol;
use App\Model\Usuario;

class ClienteController extends Controller{
	function perfil (){
		$usuario = auth()->user();
		$cliente = Cliente::where('id_Usuarios',$usuario->id_Usuarios)->first();
		$informacion = array();
		$informacion['cliente'] = $cliente;
		$informacion['usuario'] = $usuario;
		// $informacion['viajes'] = Viajes::where('id_Cliente',$cliente->id_Cliente)->get();
		return view('auth.profile')->with($informacion);
	}
}
?>