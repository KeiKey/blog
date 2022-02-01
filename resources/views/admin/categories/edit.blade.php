@extends('layouts.app')

@section('content')
    @include('partials.edit-form',
             [
                 'action' => 'panel.admin.categories.update',
                 'action_data' => [$category->id],
                 'title' => 'Update a Category',
                 'entity' => $category,
                 'items' => [
                    'name' => true
                ]
            ])
@endsection
