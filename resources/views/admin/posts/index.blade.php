@extends('adminlte::page')

@section('title', 'Sistema Blog')

@section('content_header')
    <a class="btn btn-success btn-md float-right" href="{{ route('admin.posts.create') }}">Nuevo Post</a>
    <h1>Listado de Posts</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    @livewire('admin.posts-index')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');

    </script>
@stop
