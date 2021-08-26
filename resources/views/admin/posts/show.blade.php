@extends('layouts.app')

@section('content')
    @include('partials.edit_form',
             [
                 'view_only' => true,
                 'title' => 'Your post',
                 'entity' => $post,
                 'items' => [
                    'title' => true,
                    'content'=>true,
                    'thumbnail'=>true,
                    'bg_image'=>true
                ]
            ])
@endsection
