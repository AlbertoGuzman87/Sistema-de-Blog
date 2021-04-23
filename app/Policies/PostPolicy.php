<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    //Verifica si el usuario autentificado es dueño del post
    public function author(User $user, Post $post)
    {
        if ($user->id == $post->user_id) {
            return true;
        } else {
            return false;
        }
    }

    //Verifica si el status del post es igual a 2
    // (? User $user ...) Nos ayuda a que el parametro sea opcional
    public function published(?User $user, Post $post)
    {
        if ($post->status == 2) {
            return true;
        } else {
            return false;
        }
    }
}
