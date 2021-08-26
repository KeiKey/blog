@extends('layouts.app')

@section('content')
    @include('partials.edit_form',
             [
                 'action' => 'panel.admin.categories.update',
                 'action_data' => [''],
                 'title' => 'Update a Category',
                 'entity' => $category,
                 'items' => [
                    'name' => true
                ]
            ])
@endsection
