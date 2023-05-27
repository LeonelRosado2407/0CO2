<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
  protected $table = "servicios";

  protected $primaryKey = 'id_Servicio';

  public $timestamps = false;
}