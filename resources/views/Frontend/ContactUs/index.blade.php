@extends('Frontend.layouts.master')
@section('content')
    <style>
        .contact_us {
            margin-top: 3%;
            margin-bottom: 3%;
        }

        .contact_form {
            border: 1px solid rgb(73, 71, 71);
            text-align: center;
            border-radius: 10px;
            padding-bottom: 3%;
        }

        .contact_form h5 {
            margin-top: 3%;
        }

        .contact_form h5 span {
            color: #f35b04;
        }

        .contact_dailomaa input {
            margin-top: 3%;
            height: 50px;
            width: 90%;
            border-radius: 10px;
            border: 1px solid rgb(215, 214, 214) !important;
            padding-left: 30px;

        }

        .contact_dailomaa textarea {
            width: 90%;
            margin-top: 3%;
            border: 1px solid rgb(215, 214, 214) !important;
            border-radius: 10px;
            padding-left: 30px;
        }

        .contact_dailomaa button {
            margin-top: 3%;
            margin-bottom: 1%;
            width: 90px;
            background-color: #f35b04;
            height: 45px;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: bold;
        }

        .contact_dailomaa button:hover {
            border: 2px solid #f35b04;
            background-color: #fff;
            color: #f35b04;
        }

        .details_dailomaa {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .after_line {
            height: 2px;
            border: 1px solid #000;
            width: 80%;
            margin: auto;
        }

        .details_content {
            margin-top: 3%;
        }

        .social_links {
            text-align: center;
        }

        .social_links a:hover {
            color: #f35b04;
        }

        .facebook {
            color: #4267B2;
        }

        .twitter {
            color: #1DA1F2;
        }

        .instagram {
            color: #F56040;
        }

        .youtube {
            color: #FF0000;
        }

        .my_hr {
            margin-top: 2%;
        }

        .location_map {
            text-align: center;
            margin-top: 3%;
        }

        .location_map iframe {
            width: 100%;
            height: 400px;
        }

        @media (max-width:1000px) {
            .contact_dailomaa input {
                padding-left: 5px;
            }

            .contact_dailomaa textarea {
                padding-left: 5px;
            }

            .details_dailomaa {
                margin-top: 4%;
            }

            .location_map iframe {
                width: 100%;
                height: 300px;
            }
        }
    </style>
    <div class="container contact_us">
    @if(session('message'))
        <div class="alert alert-success" class="text-center">Successfully Submitted</div>
    @endif
        <div class="row">
            <div class="col-md-8 contact_form">
                <h5>Get In <span> Touch</span></h5>
                <form class="contact_dailomaa" action="{{ route('user.mail.us') }}" method="POST">
                  @csrf
                    <input type="text" name="name" placeholder="Your Name" required />
                    <input type="tel" name="phone" placeholder="Phone Number" required />
                    <input type="email" name="email" placeholder="Someone@example.com" required />
                    <input type="text" name="requirement" placeholder="What's Your Product Requirements" required />
                    <textarea id="w3review" name="description" rows="4" cols="50" placeholder="Message If Any"></textarea>
                    <button type="submit" class="submit_dailomaa">Submit</button>
                </form>
            </div>
            <div class="col-md-4 details_dailomaa">
                <div class="details_head">
                    <h4>Detailed Address</h4>
                    <div class="after_line"></div>
                    <div class="details_content">
                        <p><i class="fa-solid fa-location-dot "></i>&nbsp;&nbsp;<strong>Address
                                :</strong>&nbsp;&nbsp;Kamaladi, Kathmandu</p>
                        <p><i class="fa-sharp fa-solid fa-phone"></i>&nbsp;&nbsp;<strong>Phone Number
                                :</strong>&nbsp;&nbsp;01-5237756</p>
                        <p><i class="fa-regular fa-envelope"></i>&nbsp;&nbsp;<strong>Email
                                :</strong>&nbsp;&nbsp;infodailomaa@gmail.com</p>
                    </div>
                    <div class="social_links">
                        <h5>Follow Us:</h5>
                        <a href="{{ $siteSetting->facebook }}" class="facebook" target="__blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $siteSetting->twitter }}" class="twitter" target="__blank"><i class="fa fa-twitter"></i></a>
                        <a href="{{ $siteSetting->instagram }}" class="instagram" target="__blank"><i class="fa fa-instagram" style="color:#ea08b9;"></i></a>
                        <a href="{{ $siteSetting->skype }}" class="youtube" target="__blank"><i class="fa fa-skype" aria-hidden="true" style="color:blue;"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my_hr">
            <div class="col-md-12 location_map">
               {!!$map->link !!}
            </div>
        </div>
    </div>
@endsection
