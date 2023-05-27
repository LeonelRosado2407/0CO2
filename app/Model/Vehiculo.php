<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
  protected $table = "vehiculos";

  protected $primaryKey = 'id_Vehiculo';

  public $timestamps = false;
}