@extends('adminlte::page')

@section('title', 'Sistema Blog')

@section('content_header')
    <h1>Lista de roles</h1>
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

        <div class="card-header">
            <a class="btn btn-info" href="{{ route('admin.roles.create') }}">Nuevo Rol</a>
        </div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Rol</td>
                        <td colspan="2"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td width="10px">
                                <a class="btn btn-success btn-sm" href="{{ route('admin.roles.edit', $role) }}">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                    @csrf
                                    @method('Delete')
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');

    </script>
@stop
