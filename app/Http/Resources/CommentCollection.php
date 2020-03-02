<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public function threaded()
    {
        $comments = parent::groupBy('parent_id');
        if (count($comments)) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }
        return $comments;
    }
}
