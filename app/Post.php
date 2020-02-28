<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'content', 'status', 'user_id', 'cover_path', 'visits'
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

    public function author()
    {
       return $this->belongsTo(Admin::class);
    }

    public function tags()
    {
       return $this->belongsToMany(Tag::class, 'post_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getCoverAttribute()
    {
        $parts = explode("/", $this->cover_path);

        return end($parts);
    }

    public function getDescriptionAttribute()
    {
        return substr($this->content, 0, 70) . "...";
    }
}
