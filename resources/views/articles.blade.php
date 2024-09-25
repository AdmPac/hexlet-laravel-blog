@extends('layouts.app')
@section('header', 'О блоге')

@section('content')
    @foreach ($data as $item)
        <h1>{{$item->name}}</h1>
        <p>{{$item->body}}</p>
    @endforeach
    <p></p>
@endsection
