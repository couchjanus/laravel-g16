<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'status', 'category_id', 'user_id'
    ];
    
    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
