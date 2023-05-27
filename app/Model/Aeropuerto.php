<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
  protected $table = "aeropuerto";

  protected $primaryKey = 'id_Aeropuerto';

  public $timestamps = false;
}