@extends('layouts.app')

@section('content')
    <div class="container mx-xs-4 mx-sm-auto">
        <div class="row">
            <div class="col-6">
                <h2>{{ __('Users') }}</h2>
            </div>

            <div class="col-6 text-right">
                <a type="submit" class="btn btn-primary btn-sm" href="{{ route('panel.admin.users.create') }}">
                    <i class="fa fa-plus"></i> {{ __('Create a new user') }}
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <table class="table table-striped table-bordered datatable-custom">
                <thead>
                    <tr>
                        <th>{{ __('Id') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Surname') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('State') }}</th>
                        <th class="w-25">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->state }}</td>
                        <td>
                            @if($user->role !== \App\Enums\Role::ADMIN)
                                <form class="d-inline"
                                      action="{{ route('panel.admin.users.promote', ['user' => $user->id]) }}"
                                      method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-arrow-up"></i> {{ __('Promote') }}
                                    </button>
                                </form>
                            @endif


                            @if($user->isUser() && !$user->isActive())
                                <form class="d-inline"
                                      action="{{ route('panel.admin.users.enable', ['user' => $user->id]) }}"
                                      method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-undo"></i> {{ __('Enable') }}
                                    </button>
                                </form>
                            @endif

                            @if($user->isUser() && $user->isActive())
                                <form class="d-inline"
                                      action="{{ route('panel.admin.users.disable', ['user' => $user->id]) }}"
                                      method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-primary btn-warning btn-sm">
                                        <i class="fa fa-ban"></i> {{ __('Disable') }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
