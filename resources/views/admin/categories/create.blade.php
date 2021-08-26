@extends('layouts.app')

@section('content')
    @include('partials.create_form',
             [
                 'action' => 'panel.admin.categories.store',
                 'title' => 'Create a new category',
                 'items' => [
                     'name' => true
                 ]
            ])
@endsection
