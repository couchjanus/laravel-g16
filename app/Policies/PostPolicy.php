<?php

namespace App\Policies;

use App\Post;
use App\Admin;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user, $ability)
    {
        // dd('The \`before\`method is called.');
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function owner(Admin $user, Post $post)
    {
        if ($user->id == $post->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(Admin $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(Admin $user, Post $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(Admin $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(Admin $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(Admin $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(Admin $user, Post $post)
    {
        return $user->id == $post->user_id;
    }
}
