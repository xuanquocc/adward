<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comments;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'creator_id',
        'status',
        'image',
        'content',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comments::class, 'blog_id', 'id')->orderBy('id', 'DESC');
    }

   
}
