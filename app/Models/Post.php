<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'reward', 'address', 'deadline'];

    public function acceptance(){
        return $this->hasOne(Acceptance::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
