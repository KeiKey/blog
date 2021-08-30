@extends('layouts.site')

@section('content')
    @include('site.partials.header_home')

    <section class="main-content">
        <div class="container">
            <div class="main-content-introduction text-center">
                <h4>{{ __('Introduction') }}</h4>

                <h3>
                    <i>{{ __('Cue') }}</i> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.
                </h3>

                <div class="main-content-posts container">
                    <h4 id="intro">{{ __('Featured posts') }}</h4>

                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-lg-6 col-md-12 post">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                    <img
                                        class="img-fluid"
                                        src="{{ $post->thumbnail ? url('/images/thumbnails/'.$post->thumbnail) : url('thumbnail-default.jpeg') }}"
                                        alt="{{ $post->title }}"
                                    />
                                </a>

                                <h4>{{ $post->category->name ?? '' }}</h4>
                                <h3>{{ $post->title }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="load-more">
                    <a class="btn light load-btn" href="#" role="button">{{ __('Load more') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
