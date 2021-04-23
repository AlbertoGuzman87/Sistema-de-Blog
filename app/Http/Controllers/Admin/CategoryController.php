<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    //Metodo para proteger vistas
    public function __construct()
    {
        $this->middleware('can:admin.categories.index')->only('index');
        $this->middleware('can:admin.categories.edit')->only('edit', 'update');
        $this->middleware('can:admin.categories.create')->only('create', 'store');
        $this->middleware('can:admin.categories.destroy')->only('destroy');
    }


    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        //Rescata los valores que se mandan y valida los campos
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

        //Crea una nueva categoria
        $category =  Category::create($request->all());

        //retorna y manda el parametro category
        return redirect()->route('admin.categories.edit', $category)->with('info', 'La categoria se creó con éxito');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category  $category)
    {
        //Rescata los valores que se mandan y valida los campos
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:categories,slug,$category->id"
        ]);

        $category->update($request->all());
        //->with('info', 'La categoria se actualizo con éxito');
        //Genera una variable temporal y se puede utilizar en la vista edit
        return redirect()->route('admin.categories.edit', $category)->with('info', 'La categoria se actualizo con éxito');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('info', 'La categoria se eliminó con éxito');;
    }
}
