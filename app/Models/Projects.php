<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers;
class Projects extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'customers_id',
        'customer',
        'deadline',
        'start',
        'expired'
    ];

    function customer(){
        return $this->belongsTo('App\Models\Customers');
    }

    function creators(){
        return $this->belongsToMany('App\Models\Creators');
    }
}
