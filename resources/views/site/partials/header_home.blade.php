<header class="header">
    @include('site.molecules.navbar_mobile')

    @include('site.molecules.navbar_dark')

    @include('site.molecules.navbar_light')

    <ul class="nav justify-content-center brand">
        <li class="nav-item">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{url('logo.png')}}" alt="{{ __('Logo') }}" />
            </a>
        </li>
    </ul>

    @include('site.atoms.button_explore')
</header>
