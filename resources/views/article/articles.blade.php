@extends('layouts.app')
@section('header', 'О блоге')

@section('content')
    <a href="{{route('create')}}">Создать статью</a>
    @foreach ($data as $item)
        <h1><a href="{{route('arc_id', ['id' => $item->id])}}">{{$item->name}}</a></h1>
        <a href="{{route('articles.edit', ['id' => $item->id])}}">Изменить статью</a>
        {{ html()->form('POST', route('articles.destroy', ['id' => $item->id]))->open() }}
            @csrf
            @method('DELETE')
            {{ html()->submit('Удалить')->class('link-danger')->attribute('onclick', "return confirm('Вы уверены, что хотите удалить эту статью?')") }}
        {{ html()->form()->close() }}   
        <p>{{$item->body}}</p>
        {{  html()->form('GET', route('arc_id', ['id' => $item->id]))->open() }}
            {{  html()->input('text', 'name') }}
            {{  html()->submit('Search') }}
        {{ html()->form()->close() }}
    @endforeach
@endsection
