<header class="header">
    @include('site.molecules.navbar-mobile')

    @include('site.molecules.navbar-dark')

    @include('site.molecules.navbar-light')

    <ul class="nav justify-content-center brand">
        <li class="nav-item">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{url('logo.png')}}" alt="{{ __('Logo') }}" />
            </a>
        </li>
    </ul>

    @include('site.atoms.button-explore')
</header>
