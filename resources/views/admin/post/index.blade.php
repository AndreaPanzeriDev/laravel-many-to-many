@extends('layouts.app')

@section('content')
    <div class="containerM">
        <div class="function">
            <h1>Post</h1>
            <div>
                <button class="buttonN"><a href="{{route('admin.posts.create')}}">+ Add new</a></button>
            </div>
        </div>
        <div class="cards">
            @foreach ($info_posts as $item)
                <div class="cardM">
                    <div class="text-center my-2">{{ $item->title }}</div>
                    <div class="buttons">
                        <!-- web.php/PostController/ipoteticoshow.blade.php-->
                        <button><a href="{{route('admin.posts.show', $item->id)}}">show</a></button>
                        <button class="editB"><a href="{{route('admin.posts.edit', $item->id)}}">Edit</a></button>
                        <form action="{{route('admin.posts.destroy', $item->id)}}" method="POST">

                            @csrf
                            @method('DELETE')
                            <button class="deleteB" type="submit">Delete</button>
                        </form>

                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
