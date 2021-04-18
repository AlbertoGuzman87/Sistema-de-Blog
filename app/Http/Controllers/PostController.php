<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::Where('status', 2)->latest('id')->paginate(8);
        return view('posts.index', compact('posts'));
    }

    //Lista los Posts relacionados a la misma categoria
    public function show(Post $post)
    {

        $similares = Post::where('category_id', $post->category_id)
            ->where('status', 2)
            ->Where('id', '!=', $post->id)
            //Ordena de manera decs
            ->latest('id')
            //Trae unicamente 4 registros
            ->take(4)
            ->get();

        return view('posts.show', compact('post', 'similares'));
    }

    //Busqueda por categoria especifica
    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->where('status', 2)
            ->latest('id')
            ->paginate(4);

        return view('posts.category', compact('posts', 'category'));
    }
}
