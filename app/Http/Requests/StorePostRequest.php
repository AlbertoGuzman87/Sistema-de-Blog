<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //La vilidacion ayuda a saber si el que esta creando el posts es el usuario autentificado
        if ($this->user_id == auth()->user()->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            //Solo acepta valores 1 y 2
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];
        //si en el campo estatus se manda el valor de 2
        if ($this->status == 2) {
            //array_merge(); Une el array de arriba con el nuevo dentro de sus ()
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }

        //devolvemos las reglas de validación
        return $rules;
    }
}
