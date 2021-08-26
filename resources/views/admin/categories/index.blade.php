@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>{{ __('Categories') }}</h2>
            </div>

            <div class="col-6 text-right">
                <a type="submit" class="btn btn-primary btn-sm" href="{{ route('panel.admin.categories.create') }}">
                    <i class="fa fa-plus"></i> {{ __('Create a new category') }}
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-striped table-bordered datatable-custom">
                <thead>
                    <tr>
                        <th>{{ __('Id') }}</th>
                        <th class="w-50">{{ __('Category') }}</th>
                        <th>{{ __('State') }}</th>
                        <th class="w-25">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->state }}</td>
                            <td>
                                <a type="submit" class="btn btn-success btn-sm" href="{{ route('panel.admin.categories.edit', ['category' => $category->id]) }}">
                                    <i class="fa fa-eye"></i> {{ __('Edit') }}
                                </a>

                                @if($category->isActive())
                                    <form class="d-inline"
                                          action="{{ route('panel.admin.categories.disable', ['category' => $category->id]) }}"
                                          method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fa fa-ban"></i> {{ __('Disable') }}
                                        </button>
                                    </form>
                                @else
                                    <form class="d-inline"
                                          action="{{ route('panel.admin.categories.enable', ['category' => $category->id]) }}"
                                          method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-undo"></i> {{ __('Enable') }}
                                        </button>
                                    </form>
                                @endif

                                <form class="d-inline"
                                      action="{{ route('panel.admin.categories.destroy', ['category' => $category->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> {{ __('Delete') }}
                                    </button>
                                </form>
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
        // $(document).ready(function() {
        //     $('.datatable-custom').DataTable({
        //         processing: false,
        //         serverSide: false,
        //         info: true
        //     });
        // });
    </script>
@endsection
