@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="post-preview">
            </div>
        @endforeach
    </div>
@endsection
