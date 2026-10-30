<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadeau extends Model
{
    protected $table = 'cadeaux';
    protected $fillable = ['name', 'tag', 'price', 'image', 'description'];
}
