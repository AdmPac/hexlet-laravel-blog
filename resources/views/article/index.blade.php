@extends('layouts.app')
@section('header', 'О блоге')

@section('content')
    <a href="{{route('articles.create')}}">Создать статью</a>
    @foreach ($data as $article)
        <h1><a href="{{route('articles.show', $article)}}">{{$article->name}}</a></h1>
        <a href="{{route('articles.edit', $article)}}">Изменить статью</a>
        {{ html()->form('POST', route('articles.destroy', $article))->open() }}
            @csrf
            @method('DELETE')
            {{ html()->submit('Удалить')->class('link-danger')->attribute('onclick', "return confirm('Вы уверены, что хотите удалить эту статью?')") }}
        {{ html()->form()->close() }}   
        <p>{{$article->body}}</p>
        {{  html()->form('GET', route('articles.index', $article))->open() }}
        {{ html()->form()->close() }}
    @endforeach
@endsection
