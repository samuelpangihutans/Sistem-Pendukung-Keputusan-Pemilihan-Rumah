<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gambar extends Model
{
    //table name
    protected $table='gambar';
    //primary key
    public $primaryKey='id';
    //Timestamps
    public $timestamps=false;
}
