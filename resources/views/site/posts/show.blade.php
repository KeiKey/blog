@extends('layouts.site')

@section('content')
    @include('site.partials.header-inside')

    <div class="container" style="margin-top: -15vh;">
        <div class="row">
            <div class="col-md-9 offset-md-3 p-5" style="background-color: white">
                <h1 style="font-size: 65px">{{ $post->title }} </h1>
                <br>
                <h2>- <b>{{ $post->user->name }} {{ $post->user->surname }}</b> </h2>

                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection
