@extends('layouts.app')

@section('content')
    @include('partials.edit-form',
             [
                 'action' => 'panel.admin.posts.update',
                 'title' => 'Update post',
                 'data' => $post,
                 'items' => [
                    'title' => true,
                    'content'=>true,
                    'category'=>true,
                    'thumbnail'=>true,
                    'bg_image'=>true
                ]
            ])
@endsection
