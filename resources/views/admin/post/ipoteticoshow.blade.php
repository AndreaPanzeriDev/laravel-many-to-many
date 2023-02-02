@extends('layouts.app')

@section('content')
    <div class="w-75 m-auto text-center">
        <h1>{{$single_post->title}}</h1>
        <p>{{$single_post->body}}</p>
        <img class="img-fluid" src="{{asset("storage/$single_post->image")}}" alt="img">
    </div>
@endsection
