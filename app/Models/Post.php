<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'comment',
        'topic',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
