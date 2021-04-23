@extends('adminlte::page')

@section('title', 'Sistema Blog')

@section('content_header')
    <h1>Asignar un Rol</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre: </p>
            <p class="form-control">
                {{ $user->name }}
            </p>

            <h2 class="h5">
                Listado de Roles
            </h2>

            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'autocomplete' => 'off', 'method' => 'put']) !!}

            @foreach ($roles as $rol)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-1']) !!}
                        {{ $rol->name }}
                    </label>
                </div>
            @endforeach

            {!! Form::submit('Asignar Rol', ['class' => 'btn btn-success mt-2']) !!}

            {!! Form::close() !!}

        </div>

    </div>
@stop
