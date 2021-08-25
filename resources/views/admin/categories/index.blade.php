@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Categories</h2>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-striped table-bordered datatable-custom">
                <thead>
                    <tr>
                        <th class="w-25">Id</th>
                        <th class="w-50">Category</th>
                        <th class="w-25">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a type="submit" class="btn btn-primary btn-sm" href="{{ route('panel.admin.categories.edit', ['post' => $post->id]) }}">
                                    <i class="fa fa-eye"></i> {{ __('Edit') }}
                                </a>

                                <form class="d-inline"
                                      action="{{ route('panel.admin.categories.destroy', ['category' => $category->id]) }}"
                                      method="POST">
                                    @csrf

                                    <a class="btn btn-primary btn-warning btn-sm">
                                        <i class="fa fa-ban"></i> Disable
                                    </a>
                                </form>

                                <form class="d-inline"
                                      action="{{ route('panel.admin.categories.destroy', ['category' => $category->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-primary btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
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
