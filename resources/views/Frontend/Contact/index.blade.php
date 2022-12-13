@extends('Frontend.layouts.master')
@section('content')
    <div class="nav-info mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>Art Kit</h3>
                    <nav class="breadcrumbs">
                        <a href="{{ route('home') }}">home</a>
                        <span class="divider">/</span>
                        Contact Us
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <div class="contacts-9 py-lg-5 py-md-4">
        <div class="container">
            <div style="margin: 8px auto; display: block; text-align:center;">

                <!---728x90--->


            </div>
            <div class="d-grid contact-view mb-5 pb-lg-5">
                <div class="cont-details">
                    <div class="contactct-fm-text text-left mb-md-5 mb-4">
                        <div class="header-title mb-md-5 mt-4">
                            <span class="sub-title">Find Us</span>
                            <h3 class="hny-title text-left">Additional information </h3>
                        </div>
                        <p class="mb-sm-5 mb-4">
                            {{ $siteSetting[0]['about'] ?? '' }}
                        </p>

                    </div>
                    <div class="cont-top">
                        <div class="cont-left text-center">
                            <span class="fa fa-phone"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Phone number</h6>
                            <p><a href="tel:+(977) 01 6653535">{{ $siteSetting[0]['mobile_no'] ?? '' }}</a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-envelope-o"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Send Email</h6>
                            <p><a href="mailto:{{ $siteSetting[0]['email'] ?? '' }}"
                                    class="mail">{{ $siteSetting[0]['email'] ?? '' }}</a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-map-marker"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Office Address</h6>
                            <p class="pr-lg-5">{{ $siteSetting[0]['address'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="map-content-9">
                    <div class="contactct-fm map-content-9 pl-lg-4">
                        <div class="contactct-fm-text text-left">
                            <div class="header-title mb-md-5 mt-4">
                                <span class="sub-title">Contact Us</span>
                                <h3 class="hny-title text-left">Fill out the form.</h3>
                            </div>
                            <p class="mb-sm-5 mb-4">
                                Start working with Us that can provide everything you need to
                                generate awareness,
                                drive traffic,
                                connect. <br> We guarantee that you’ll be able to have any issue resolved within 24
                                hours.
                            </p>
                        </div>
                        <form role="form" action="{{ route('contact-store') }}" method="POST"
                            enctype="multipart/form-data" id="contact-form">
                            @csrf
                            @if (session()->has('message'))
                                <div class="alert alert-success" id="successMessage">
                                    {{ session()->get('message') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger col-md-12">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Auth::user())
                                @include('Frontend.Contact.Partials.loggedin-users')
                            @else
                                @include('Frontend.Contact.Partials.not-loggedin-users')
                            @endif
                            <div class="twice">
                                <input type="text" class="form-control" name="phone_number" id="phone_number"
                                    value="{{ old('phone_number', $contact->phone_number) }}" placeholder="Phone Number"
                                    required="">
                            </div>
                            <div class="twice">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    value="{{ old('subject', $contact->subject) }}" placeholder="Subject" required="">
                            </div>
                            <textarea name="message" class="form-control" id="Message" placeholder="Message"
                                required="">{{ old('message', $contact->message) }}</textarea>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-style mt-4">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="map-iframe">
                <iframe src="{!! $siteSetting[0]['google_maps'] !!}" width="100%" height="400" frameborder="0" style="border: 0px;"
                    allowfullscreen=""></iframe>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        window.setTimeout("document.getElementById('successMessage').style.display='none';", 4000);
    </script>
@endsection
