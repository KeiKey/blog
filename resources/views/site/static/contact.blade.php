@extends('layouts.site')

@section('content')
    @include('site.partials.header_inside')

    <section class="main-content">
        <div class="container">
            <div class="main-content-introduction text-center">
            <h4>Contact Us</h4>
            <h3>
                <i>Address:</i> 12 Tirane, Unit 102 Albania
            </h3>
            <h3>
                <i>Tel:</i> +355 69 69 69 969
            </h3>
            <h3>
                <i>Opening Hours:</i> 9:00 - 22:00
            </h3>
            <div class="container contact-form">
                <form method="post">
                    <h3>Drop Us a Message</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea name="txtMsg" class="form-control text-msg" placeholder="Your Message *" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div id="load-more">
                        <a class="btn light load-btn" href="#" role="button">Contact Us</a>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection
