<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
         //table name
         protected $table='rumah';
         //primary key
         public $primaryKey='id';
         //Timestamps
          public $timestamps=false;
}
