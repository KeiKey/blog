<div class="container contact-form">
    <form method="POST" action="{{ route('contact') }}">
        @csrf

        <h3>Drop Us a Message</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Your Name *"
                        required
                        autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="Your Email *"
                        required>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        id="phone"
                        name="phone"
                        type="text"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}"
                        placeholder="Your Phone Number *"
                        required>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea
                        id="message"
                        name="message"
                        class="form-control text-msg @error('phone') is-invalid @enderror"
                        placeholder="Your Message *" ></textarea>

                    @error('message')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div id="load-more">
            <button type="submit" class="btn light load-btn">
                {{ __('Contact Us') }}
            </button>
        </div>
    </form>
</div>
