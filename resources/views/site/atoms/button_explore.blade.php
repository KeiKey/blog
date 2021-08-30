<div id="explore-button">
    <a class="btn dark" href="#" role="button" onclick="smoothScroll('intro')">{{ __('Read now') }}</a>
</div>

@section('scripts')
    <script>
        function smoothScroll(target) {
            $('html,body').animate({scrollTop: $("#"+target).offset().top}, 'slow');
        }
    </script>
@endsection
