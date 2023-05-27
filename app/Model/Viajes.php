<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Viajes extends Model
{
  protected $table = "viajes";

  protected $primaryKey = 'id_Viajes';

  public $timestamps = false;
}