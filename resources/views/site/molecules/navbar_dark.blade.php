<!-- dark navbar  visible on scroll -->
<ul class="nav fixed-top justify-content-center scrollable scrollnav" >
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('home') }}">{{ __('Home') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact') }}</a>
    </li>

    <li class="nav-item">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{URL('logo.png')}}" alt="{{ __('Logo') }}" />
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">{{ __('About Us') }}</a>
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
