<header>
    @include('site.molecules.navbar_mobile')

    @include('site.molecules.navbar_dark')

    @include('site.molecules.navbar_light')

    <section class="about-header" @isset($post->bg_image) style='background-image: url("/images/thumbnails/<?php print_r($post->bg_image) ?>")' @endisset></section>
</header>
