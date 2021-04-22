<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre del post']) !!}
    @error('name')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug del post', 'readonly']) !!}
    @error('slug')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoria:') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @error('category_id')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="from-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)

        <label class="mr-3">
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{ $tag->name }}
        </label>

    @endforeach

    @error('tags')
        <br>
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label>
        {!! Form::radio('status', 1, true) !!}
        Borrador
    </label>
    <label>
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>

    @error('status')
        <br>
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            {{-- Si existe una img relacionado a ese posts --}}
            {{-- @isset nos ayuda a saber si el obj esta definido --}}
            @isset($post->image)
                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2015/07/09/22/45/tree-838667_960_720.jpg" alt="">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostra en el post') !!}
            {!! Form::file('file', ['class' => 'from-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <br>
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
            <p class="mt-3"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem deleniti
                consequatur explicabo
                rerum doloremque, officiis, nesciunt, non eos quam corrupti minima officia aliquam suscipit.
                Tempora reiciendis porro quisquam nihil cum. </p>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
    @error('extract')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo del Post:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    @error('body')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>
