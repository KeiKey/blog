@extends('layouts.app')

@section('content')
    @include('partials.create-form',
             [
                 'action' => 'panel.admin.users.store',
                 'title' => 'Create a new user',
                 'items' =>
                            [
                                'name' => true,
                                'surname' => true,
                                'email' => true,
                                'password' => true,
                                'role' => true
                            ]
            ])
@endsection
