<form method="POST"
      @isset($action) action="{{ route($action, $action_data) }}" @endisset
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

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
                    <input id="name"
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ $entity->name ?? old('name') }}"
                           required
                           autocomplete="name"
                           autofocus
                           @if(isset($view_only)) disabled @endif>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        @isset($items['surname'])
            <div class="form-group row">
                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                <div class="col-md-8">
                    <input id="surname"
                           type="text"
                           class="form-control @error('surname') is-invalid @enderror"
                           name="surname"
                           value="{{ $entity->surname ?? old('surname') }}"
                           required
                           autocomplete="surname"
                           @if(isset($view_only)) disabled @endif>

                    @error('surname')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

        @isset($items['email'])
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                <div class="col-md-8">
                    <input id="email"
                           type="email"
                           class="form-control @error('surname') is-invalid @enderror"
                           name="email"
                           value="{{ $entity->email ?? old('email') }}"
                           required
                           autocomplete="email"
                           @if(isset($view_only)) disabled @endif>

                    @error('email')
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
                    <input id="title"
                           type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           name="title"
                           value="{{ $entity->title ?? old('title') }}"
                           required
                           autocomplete="title"
                           autofocus
                           @if(isset($view_only)) disabled @endif>

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
                    <textarea id="content"
                              type="text"
                              class="form-control @error('content') is-invalid @enderror"
                              name="content"
                              required
                              autocomplete="Content"
                              rows="4"
                              @if(isset($view_only)) disabled @endif>
                        {{ $entity->content ?? old('content') }}
                    </textarea>

                    @error('content')
                    <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endisset

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
        @else
            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>
                <div class="col-md-8">
                    <input id="category"
                           type="text"
                           class="form-control"
                           name="category"
                           value="{{ $entity->category->name ?? old('category') }}"
                           required
                           autocomplete="title"
                           @if(isset($view_only)) disabled @endif>
                </div>
            </div>
        @endisset

        @isset($items['thumbnail'])
            <div class="form-group row">
                <label for="thumbnail" class="col-md-4 col-form-label text-md-right">Thumbnail</label>

                <div class="col-md-8">
{{--                    todo - fix this with images--}}
                    <input id="thumbnail"
                           type="file"
                           class="form-control @error('thumbnail') is-invalid @enderror"
                           name="thumbnail"
                           value="{{ $entity->thumbnail ?? old('thumbnail') }}"
                           @if(isset($view_only)) disabled @endif>

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
                    <input id="bg_image"
                           type="file"
                           class="form-control @error('bg_image') is-invalid @enderror"
                           name="bg_image" value="{{ $entity->bg_image ?? old('bg_image') }}"
                           @if(isset($view_only)) disabled @endif>

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
                <button type="submit"
                        class="btn btn-success"
                        @isset($view_only) disabled @endisset>
                    {{ __('Update') }}
                </button>
            </div>
        </div>
    </div>
</form>
