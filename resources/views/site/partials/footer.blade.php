<footer>
    <div class="text-center footer-contact-us">
        <div class="content">
            <h4>{{ __('Stay informed') }}</h4>

            @include('site.molecules.subscribe_form')

            <br />

            @include('site.molecules.socials')
        </div>
    </div>

    @include('site.molecules.footer_navigation')

    @include('site.molecules.footer_copyright')

    @include('site.molecules.footer_mobile')
</footer>
