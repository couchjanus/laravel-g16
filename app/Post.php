<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Comment;
use Spatie\Searchable\Searchable as SpSearch;
use Spatie\Searchable\SearchResult;

use Laravel\Scout\Searchable;

class Post extends Model implements SpSearch
{
    use Sluggable;
    use Searchable;

    protected $fillable = [
        'title', 'content', 'status', 'user_id', 'cover_path', 'visits'
    ];

    protected $dates = ['created_at', 'deleted_at']; 


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

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->with('creator');
    }

    public function comment($data, Model $creator): Comment
    {
        return (new Comment())->createComment($this, $data, $creator);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('blog.show', $this->slug);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }

}
