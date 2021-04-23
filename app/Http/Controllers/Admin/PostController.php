<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Tag;

//Para  mover la img de archivos tmp usamos Storage
use Illuminate\Support\Facades\Storage;
//Reglas de validación del frm create y edit
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->where('user_id', Auth::user()->id);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //El metodo pluck solo toma el campo name  de cada registro
        //el id es la llave del array
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Definir el metodo que es un objeto de PostRequest
    public function store(PostRequest $request)
    {

        //Prueba de que se esta mandando en el name file
        //return request()->file('file');

        $post = Post::create($request->all());

        //Si esta mandado una img
        if (request()->file('file')) {
            //Mueve la img a una carpeta en especifico
            $url =  Storage::put('posts', request()->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }

        //Si esta mandado etiquetas
        if ($request->tags) {
            //Entra a la relación muchos a muschos y asigna los valores del array generado en la vista create
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se creó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //Policy que perimte saber si es dueño del post
        $this->authorize('author', $post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Definir el metodo que es un objeto de PostRequest
    public function update(PostRequest $request, Post $post)
    {

        //Policy que perimte saber si es dueño del post
        $this->authorize('author', $post);

        $post->update($request->all());

        //Si esta mandado una img
        if (request()->file('file')) {
            //Mueve la img a una carpeta en especifico
            $url =  Storage::put('posts', request()->file('file'));
            //si ese post ya cuenta con una img
            if ($post->image) {
                //elimina la img existente relacionada a ese post 
                Storage::delete($post->image->url);
                //actualiza la nueva img del post
                $post->image->update([
                    'url' => $url
                ]);
            } else {
                //si no existe ninguna foto
                //crea un nuevo registro
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        //Si esta mandado etiquetas
        if ($request->tags) {
            //Entra a la relación muchos a muschos y reasigna los valores del array
            //sync verifica si ya exiten registros coinsidentes y ya no los inserta
            //sync si encuentra nuevos los inserta
            //sync si ya no encuentra uno nuevo seleccionado lo borra de BD
            $post->tags()->sync($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Policy que perimte saber si es dueño del post
        $this->authorize('author', $post);

        $post->delete();

        //Elimina la imagen del post a eliminar
        //Descomentar en caso de no usar observer
        // if ($post->image) {
        //     Storage::delete($post->image->url);
        // }

        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó correctamente');
    }
}
