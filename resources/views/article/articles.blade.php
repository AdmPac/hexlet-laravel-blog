@extends('layouts.app')
@section('header', 'О блоге')

@section('content')
    @foreach ($data as $item)
        <h1><a href="{{route('arc_id', ['id' => $item->id])}}">{{$item->name}}</a></h1>
        <a href="{{route('create')}}">Создать статью</a>
        <p>{{$item->body}}</p>
        {{  html()->form('GET', route('arc_id', ['id' => $item->id]))->open() }}
            {{  html()->input('text', 'name') }}
            {{  html()->submit('Search') }}
        {{ html()->form()->close() }}
    @endforeach
@endsection
