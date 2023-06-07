<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creators extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'experience',
        'major',
        'main_id'
    ];

    function projects(){
        return $this->belongsToMany('App\Models\Projects');
    }
}
