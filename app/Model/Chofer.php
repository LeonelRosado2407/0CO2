<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
  protected $table = "choferes";

  protected $primaryKey = 'id_Chofer';

  public $timestamps = false;
}