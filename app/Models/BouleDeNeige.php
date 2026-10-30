<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BouleDeNeige extends Model
{
    protected $table = 'boules_de_neige'; 
    protected $fillable = ['name', 'tag', 'price', 'image', 'description'];
}