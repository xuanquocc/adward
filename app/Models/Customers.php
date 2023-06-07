<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Projects;

class Customers extends Model
{
    use HasFactory;

    function projects(){
       return $this->hasMany('App\Models\Projects');
    }
}
