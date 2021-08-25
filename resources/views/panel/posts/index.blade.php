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
                        <th class="w-25">Title</th>
                        <th class="w-25">Content</th>
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
                                <a type="submit" class="btn btn-primary btn-success btn-sm" href="{{ route('panel.posts.show', ['post' => $post->id]) }}">
                                    <i class="fa fa-eye"></i> {{ __('Show') }}
                                </a>

                                <a type="submit" class="btn btn-primary btn-sm" href="{{ route('panel.posts.edit', ['post' => $post->id]) }}">
                                    <i class="fa fa-eye"></i> {{ __('Edit') }}
                                </a>

                                <form class="d-inline"
                                      action="{{ route('panel.posts.disable', ['post' => $post->id]) }}"
                                      method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-primary btn-warning btn-sm">
                                        <i class="fa fa-ban"></i> {{ __('Disable') }}
                                    </button>
                                </form>

                                <form class="d-inline"
                                      action="{{ route('panel.posts.destroy', ['post' => $post->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-primary btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> {{ __('Delete') }}
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
