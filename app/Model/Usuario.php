<?php 
namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
  protected $table = "usuarios";
  protected $primaryKey = 'id_Usuarios';
  public $timestamps = false;
  protected $fillable=[
  	'email','password','id_rol'
  ];
}
?>