<div class="side-menu d-md-none">
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

            <li class="nav-item text-center" style="border-bottom: 1px solid white">
                @auth
                    @if(auth()->user()->isUser())
                        <a href="{{ route('panel.posts.index') }}">{{ __('Panel') }}</a>
                    @else
                        <a href="{{ route('panel.admin.posts.index') }}">{{ __('Panel') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}">{{ __('Authenticate') }}</a>
                @endif
            </li>
        </ul>
    </div>
</div>
