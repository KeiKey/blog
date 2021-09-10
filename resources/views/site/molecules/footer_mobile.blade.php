<div class="footer-mobile d-md-none">
    <div class="row no-gutters">
        <ul class="nav">
            <li class="nav-item text-center">
                <a class="nav-link active" href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>

            <li class="nav-item text-center">
                <a class="nav-link" href="{{ route('static.page', 'contact') }}">{{ __('Contact') }}</a>
            </li>

            <li class="nav-item text-center">
                <a class="nav-link" href="{{ route('static.page', 'about') }}">{{ __('About Us') }}</a>
            </li>

            <li class="nav-item text-center">
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

            <li class="nav-item text-center">
                <a class="nav-link" href="#">{{ __('Back to top') }}</a>
            </li>
        </ul>
    </div>
</div>
