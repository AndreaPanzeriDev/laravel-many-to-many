@extends('layouts.app')

@section('content')
    <form method="POST" class="w-75 m-auto my-3" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label class="form-label">Titolo</label>
            <input name="title" type="text" class="form-control ">
        </div>

        <div class="mb-3">
            <label class="form-label">Descrizione</label>
            <textarea name="body" class="form-control"></textarea>
        </div>

        {{-- Category --}}

        <div class="my-3">
            <label for="">Category</label>
            <select class="form-control" name="category_id" id="">
                <option value="">Seleziona la categoria</option>
                @foreach ($categories as $elem)
                    <option value="{{ $elem->id }} ">
                        {{ $elem->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Tags --}}

        <div class="my-3">
            <label for="">Tags</label>
            @foreach ($tags as $tag)
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                {{ $tag->name }}
            @endforeach
        </div>


        {{-- Immage --}}

        <div class="my-3">
            <label for="">Aggiungi immagine</label>
            <input type="file" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Add Comic</button>

    </form>
@endsection
