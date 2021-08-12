@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header text-center">
                {{$post->title}}
            </div>
            <div class="card-body">
                {{$post->content}}
            </div>
        </div>
        
    </div>
@endsection