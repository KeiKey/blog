@extends('layouts.app')

@section('content')
    <header class="single-post-header d-flex align-items-center" style="background-image: url({{url('/images/bg_images/' . str_replace(' ', '_', $post->title) . '/'. $post->bg_image)}})">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
{{--                    <h2>{{ $post->title }}</h2>--}}
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row mt-2 mx-5">
            <div class="col-12">
                <span class="single-post-category px-3 py-1">{{ $post->category->name }}</span>
            </div>
        </div>

        <div class="row mx-5">
            <div class="col-12">
                <h2 class="single-post-title">{{ $post->title }}</h2>
            </div>
        </div>

        <div class="row mx-5">
            <div class="col-12 single-post-info">
                <span>{{ $post->user->name }}</span> | <span>{{ $post->created_at }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
{{--                todo - fix this --}}
                <p>{{ str_replace('\n','<br/>',$post->content) }}</p>
            </div>
        </div>
    </div>
@endsection
