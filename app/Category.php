<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'status'
    ];

    protected $dates = [
        'deleted_at',
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
}
