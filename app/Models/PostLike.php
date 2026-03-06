<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostLike extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "post_likes";
    protected $fillable = [
        'post_id','user_id', 'lawyer_id', 'is_like', 'deleted_at'
    ];
    public function scopeWithAll($query){
        return $query->with('user')->with('lawyer')->with('post');
    }
    public function scopeLiked($query){
        return $query->where('is_like',1);
    }
    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function lawyer(){
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }
}
