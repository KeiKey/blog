<header>
    @include('site.molecules.navbar-mobile')

    @include('site.molecules.navbar-dark')

    @include('site.molecules.navbar-light')

    <section class="about-header" @isset($post->bg_image) style='background-image: url("/images/thumbnails/<?php print_r($post->bg_image) ?>")' @endisset></section>
</header>
