<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nounours extends Model
{
    protected $fillable = ['name', 'tag', 'price', 'image', 'description'];
}