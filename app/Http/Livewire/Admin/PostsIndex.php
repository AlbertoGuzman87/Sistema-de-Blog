<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    //Ayuda a paginar dentro de la vista
    use WithPagination;

    //Ayuda a ocupara los estilos de bootstrap en la paginación
    protected $paginationTheme = "bootstrap";

    public $search;

    //Metodo que resetea la paginación para la busqueda
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(5);
        return view('livewire.admin.posts-index', compact('posts'));
    }
}
