<footer>
    <div class="text-center footer-contact-us">
        <div class="content">
            <h4>{{ __('Stay informed') }}</h4>

            @include('site.molecules.subscribe_form')

            <br />

            @include('site.molecules.socials')
        </div>
    </div>

    @include('site.molecules.footer-navigation')

    @include('site.molecules.footer-copyright')

    @include('site.molecules.footer-mobile')
</footer>
