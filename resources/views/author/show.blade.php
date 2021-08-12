@extends('layouts.admin')
@section('title')
    {{$post->title}}
@endsection
@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">{{$post->title}}</div>
            <div class="card-body text-justify">
                {{$post->content}}
            </div>
        </div>
    </div>
@endsection
