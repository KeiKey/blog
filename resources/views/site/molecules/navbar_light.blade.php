<!-- light navbar -->
<ul class="nav justify-content-center d-none d-md-flex">
    <li class="nav-item">
        <a class="nav-link active" href="#">{{ __('Home') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('static.page', 'about') }}">{{ __('About Us') }}</a>
    </li>

    <li class="nav-item">
        @auth
            @if(auth()->user()->isUser())
                <a class="nav-link" href="{{ route('panel.posts.index') }}">{{ __('Panel') }}</a>
            @else
                <a class="nav-link" href="{{ route('panel.admin.posts.index') }}">{{ __('Panel') }}</a>
            @endif
        @else
            <a class="nav-link" href="{{ route('login') }}">{{ __('Authenticate') }}</a>
        @endif
    </li>
</ul>
