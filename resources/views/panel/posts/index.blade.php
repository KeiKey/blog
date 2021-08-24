@extends('layouts.app')

@section('content')
    <div class="container mx-xs-4 mx-sm-auto">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Posts</h2>
            </div>
        </div>

        <div class="row mt-3">
            <table class="table table-striped table-bordered datatable-custom">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ substr($post->content , 0, 40)}} ...</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <form class="d-inline"
                                  action="#"
                                  method="POST">
                                @csrf

                                <a class="btn btn-primary btn-success">
                                    <i class="fa fa-edit" aria-hidden="false"></i> Edit
                                </a>
                            </form>

                            <form class="d-inline"
                                  action="#"
                                  method="POST">
                                @csrf

                                <a class="btn btn-primary btn-warning">
                                    <i class="fa fa-ban"></i> Disable
                                </a>
                            </form>

                            <form class="d-inline"
                                  action="#"
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
