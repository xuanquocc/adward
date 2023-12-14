<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Blogs;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'blog_id',
        'content',
        'reply_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function blog(){
        return $this->belongsTo(Blogs::class, 'blog_id', 'id');
    }

    public function cus() {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function replies() {
        return $this->hasMany(Comments::class, 'reply_id', 'id');
    }
    


}
