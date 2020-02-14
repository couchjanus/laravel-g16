<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'content', 'status', 'category_id', 'user_id'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function tags()
    {
       return $this->belongsToMany(Tag::class,  'post_tag');
    }
}
