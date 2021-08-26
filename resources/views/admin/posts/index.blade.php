@extends('layouts.app')

@section('content')
    <div class="container mx-xs-4 mx-sm-auto">
        <div class="row">
            <div class="col-12">
                <h2>Posts</h2>
            </div>
        </div>

        <div class="row mt-3">
            <table class="table table-striped table-bordered datatable-custom">
                <thead>
                    <tr>
                        <th>{{ __('Id') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th class="w-50">{{ __('Content') }}</th>
                        <th >{{ __('Category') }}</th>
                        <th >{{ __('State') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ substr($post->content , 0, 40)}} ...</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->state }}</td>
                            <td>
                                <a type="submit" class="btn btn-success btn-sm" href="{{ route('panel.admin.posts.show', ['post' => $post->id]) }}">
                                    <i class="fa fa-eye"></i> {{ __('Show') }}
                                </a>

                                @if($post->isActive())
                                    <form class="d-inline"
                                          action="{{ route('panel.admin.posts.disable', ['post' => $post->id]) }}"
                                          method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fa fa-ban"></i> {{ __('Disable') }}
                                        </button>
                                    </form>
                                @else
                                    <form class="d-inline"
                                          action="{{ route('panel.admin.posts.enable', ['post' => $post->id]) }}"
                                          method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-undo"></i> {{ __('Enable') }}
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
        // $(document).ready(function() {
        //     $('.datatable-custom').DataTable({
        //         processing: false,
        //         serverSide: false,
        //         info: true
        //     });
        // });
    </script>
@endsection
