<!-- Mobile navbar-->
<nav class="navbar navbar-expand-lg navbar-dark d-md-none fixed-top mobile-nav">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{url('logo.png')}}" alt="Logo" class="mobile-nav-brand"/>
    </a>

    <a href="#menu-toggle" id="menu-toggle"><span class="navbar-toggler-icon"></span></a>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
        </div>
    </div>
</nav>
