<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Model\Permiso;
use App\Model\Rolxpermiso;

use Closure;
class Candado2
{
    public function handle($request, Closure $next,$permiso)
    {
        //1.-Obtener el idrol del usuario que visita la pagina
    	$idrol=Auth::user()->id_rol;
    	$permiso=Permiso::where('Clave',$permiso)->first();
    	$rolxpermiso=Rolxpermiso::where('id_rol',$idrol)->where('id_permiso',$permiso->id_permiso)->first();

    	if($rolxpermiso){
    	return $next($request);	
    	}
    	else{
    		return response("No tienes permisos",401);    		
    	}        
    }
}