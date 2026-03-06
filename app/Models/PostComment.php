<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "post_comments";
    protected $fillable = [
        'post_id','user_id', 'lawyer_id', 'content','is_like', 'parent_id', 'deleted_at'
    ];
    public function scopeWithAll($query){
        return $query->with('user')->with('lawyer')->with('post')->with('parent');
    }
    public function scopeWithChildren($query){
        return $query->with('replies');
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
    public function replies(){
        return $this->hasMany(PostComment::class, 'parent_id', 'id');
    }
    public function parent(){
        return $this->belongsTo(PostComment::class, 'parent_id', 'id');
    }
}
