<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    //
    protected $fillable =  [
      'nome',
      'nascimento',
      'serie_ingresso',
      'mae'
    ];
}
