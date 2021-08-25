@extends('layouts.app')

@section('content')
    @include('partials.edit_form',
             [
                 'action' => 'panel.posts.update',
                 'action_data' => ['post' => $post->id],
                 'title' => 'Update post',
                 'entity' => $post,
                 'items' => [
                    'title' => true,
                    'content'=>true,
                    'category'=>true,
                    'thumbnail'=>true,
                    'bg_image'=>true
                ]
            ])
@endsection
