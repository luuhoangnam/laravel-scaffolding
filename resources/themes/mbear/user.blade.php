@extends('default')

@section('content')

    <p>User: {{$author->name}}</p>
    <em>Permalink: {{$author->present()->url}}</em>

@stop