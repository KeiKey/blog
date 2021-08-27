<div class="footer-parent d-none d-md-flex">
    <div class="footer-navigation container">
        <div class="row">
            <div class="col-9">
                <a href="{{ route('home') }}">
                    <img src="{{URL('logo.png')}}" alt="{{ __('Logo') }}"/>
                </a>
            </div>

            <ul class="footer-links col-3">
                <li class="bold-link">
                    <a href="{{ route('home') }}">{{ __('Cue') }}</a>
                </li>

                <li class="footer-link">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>

                <li class="footer-link">
                    <a href="#">{{ __('Contact') }}</a>
                </li>

                <li class="footer-link">
                    <a href="{{ route('about') }}">{{ __('About Us') }}</a>
                </li>

                <li class="footer-link">
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
</div>
