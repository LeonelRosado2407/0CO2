<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
  protected $table = "destinos";

  protected $primaryKey = 'id_Destinos';

  public $timestamps = false;
}