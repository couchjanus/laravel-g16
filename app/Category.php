<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use SoftDeletes;
    use NodeTrait;

    protected $fillable = [
        'name', 'description', 'status', 'parent_id'
    ];

    protected $dates = [
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'parent_id' =>  'integer',
    ];



    /**
     * Scope a query to only include posts of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public static function scopeTrash($query, $id)
    {
        return $query->withTrashed()->where('id', $id)->first();       
    }

    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
