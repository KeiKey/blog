@extends('layouts.site')

@section('content')
    @include('site.partials.header_inside')

    <section class="main-content">
        <div class="container">
            <div class="main-content-introduction text-center">
            <h4>Contact Us</h4>
            <h3><i>Address:</i> 12 Tirane, Unit 102 Albania</h3>
            <h3><i>Tel:</i> +355 69 69 69 969</h3>
            <h3><i>Opening Hours:</i> 9:00 - 22:00</h3>

            @include('partials.contact_us_form')
        </div>
    </section>
@endsection
