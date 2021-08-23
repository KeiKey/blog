<form method="{{ $method }}"
      action="{{ route($action) }}"
      enctype="multipart/form-data">
    @csrf

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>{{ $title }}</h2>
            </div>
        </div>
    </div>

    <div class="container">
        @isset($items['name'])
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-8">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        @isset($items['title'])
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                <div class="col-md-8">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        @isset($items['content'])
            <div class="form-group row">
                <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>

                <div class="col-md-8">
                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content" rows="4">{{ old('content') }}</textarea>

                    @error('content')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        {{--        todo - category as multiple options    --}}
        @isset($items['category'])
            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

                <div class="col-md-8">
                    @foreach($categories as $category)
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="{{$category->id}}" name="category" value="{{$category->id}}">
                            <label class="custom-control-label" for="{{$category->id}}">{{$category->name}}</label>
                        </div>
                    @endforeach

                    @error('content')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        @isset($items['thumbnail'])
            <div class="form-group row">
                <label for="thumbnail" class="col-md-4 col-form-label text-md-right">Thumbnail</label>

                <div class="col-md-8">
                    <input id="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" value="{{ old('thumbnail')}}">

                    @error('thumbnail')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        @isset($items['bg_image'])
            <div class="form-group row">
                <label for="bg_image" class="col-md-4 col-form-label text-md-right">Background Image</label>

                <div class="col-md-8">
                    <input id="bg_image" type="file" class="form-control @error('bg_image') is-invalid @enderror" name="bg_image" value="{{ old('bg_image')}}">

                    @error('bg_image')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        <div class="form-group row">
            <div class="col-md-4">

            </div>
            <div class="col-md-8">
                <button type="submit" class="btn btn-success">
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </div>
</form>
