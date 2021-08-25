@extends('layouts.app')

@section('content')
    @include('partials.create_form',
             [
                 'action' => 'panel.posts.store',
                 'title' => 'Create a new post',
                 'items' => [
                    'title' => true,
                    'content'=>true,
                    'category'=>true,
                    'thumbnail'=>true,
                    'bg_image'=>true
                ]
            ])
@endsection
