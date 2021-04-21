<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //$guarded=['',''...] Se ponen los campos que se quieren evitar por asignación masiva
    //Evita poner los 7 campos que estan en esa tabla
    protected $guarded = ['id','created_at','updated_at'];

    //Relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relación muchos a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Relacion uno a uno Polimorfica
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
