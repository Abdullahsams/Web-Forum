@extends('adminlte.master') 

@section('content')
    <div class='mt-4 ml-4'>
        <h3> {{ $list->title }}</h3>
        <h5> {{ $list->body }} </h5>
        <p> Author : {{$list->author->name}} , created at : {{$list->author->created_at}} </p>
    </div>
@endsection