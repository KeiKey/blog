@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Categories</h2>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form class="d-inline"
                                      action="{{ route('panel.admin.categories.edit', ['category' => $category->id]) }}"
                                      method="POST">
                                    @csrf

                                    <a class="btn btn-primary btn-success">
                                        <i class="fa fa-edit" aria-hidden="false"></i> Edit
                                    </a>
                                </form>

                                <form class="d-inline"
                                      action="{{ route('panel.admin.categories.destroy', ['category' => $category->id]) }}"
                                      method="POST">
                                    @csrf

                                    <a class="btn btn-primary btn-warning">
                                        <i class="fa fa-ban"></i> Disable
                                    </a>
                                </form>

                                <form class="d-inline"
                                      action="{{ route('panel.admin.categories.destroy', ['category' => $category->id]) }}"
                                      method="POST">
                                    @csrf

                                    <a class="btn btn-primary btn-danger">
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
