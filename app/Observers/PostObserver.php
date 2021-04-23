<?php
//Se activa en app/Providers/EventServiceProvider.php para su funcionamiento
namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{

    //public function created(Post $post)   ----se ejecuta despues de se elimine el post
    //public function deleting(Post $post) ----se ejecuta antes de se elimine el post
    public function creating(Post $post)
    {
        //Validación para ver si no se estan ejecutando los seeders y lo deje pasar
        //Borrar validación cuando acabe las pruebas
        if (! \App::runningInConsole()) {
            //Al momento de crear un post se le asigna el usuario Autentificado
            $post->user_id = auth()->user()->id;
        }
    }

    //public function delete(Post $post)   ----se ejecuta despues de se elimine el post
    //public function deleting(Post $post) ----se ejecuta antes de se elimine el post
    public function deleting(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image->url);
        }
    }
}
