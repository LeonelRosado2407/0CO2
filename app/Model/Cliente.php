<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = "clientes";

  protected $primaryKey = 'id_Cliente';

  public $timestamps = false;
}