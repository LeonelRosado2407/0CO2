<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
  protected $table = "permiso";

  protected $primaryKey = 'id_permiso';

  public $timestamps = false;
}