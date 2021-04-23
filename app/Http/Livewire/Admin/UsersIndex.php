<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    //Ayuda a paginar dentro de la vista
    use WithPagination;

    //Ayuda a ocupara los estilos de bootstrap en la paginación
    protected $paginationTheme = "bootstrap";

    public $search;

    //Metodo que resetea la paginación para la busqueda efectiva
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $users = User::Where('name', 'like', '%' . $this->search . '%')
            ->OrWhere('email', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(5);

        return view('livewire.admin.users-index', compact('users'));
    }
}
