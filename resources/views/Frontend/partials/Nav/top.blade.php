<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Architects Daughter', cursive;

    }

    button:focus {
        outline: 0;
    }

    .button_login {
        background-color: #c9c9de;
    }

    .button_login button {
        background-color: #c9c9de;
        border: none;
        color: rgb(3, 3, 3);
        padding: auto;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        height: 21px;
        width: 80px;
        justify-content: center;

    }

    /* .dropdown-menu{
   border:1px solid yellow;
} */
    /* Center the image and position the close button */
    .close {
        text-align: center;
        margin: 7px 10px 2px 0;
        position: relative;
    }

    .close span {
        text-align: right;
        float: right;
        margin-left: 2% !important;

    }


    img.avatar {
        width: 40%;
        border-radius: 50%;
    }



    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 10000;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.6);
        /* Black w/ opacity */
        padding-top: 30px;

    }


    .close span {
        position: absolute;
        /* right: 25px;
     top: 0; */
        right: -51px;
        top: -51px;
        color: rgb(0, 0, 0) !important;
        font-size: 35px;
        font-weight: bold;
    }

    fieldset {
        border: 0;
        margin: 0;
        padding: 0;
    }

    .close span:hover,
    .close:focus {
        color: rgb(253, 1, 1);
        cursor: pointer;
    }

    /* Add Zoom Animation */
    /* .animate {
     -webkit-animation: animatezoom 0.6s;
     animation: animatezoom 0.6s;
   } */

    .modal_image {
        text-align: center;
        width: 100% !important;

    }

    .modal_image img {
        width: 100% !important;
        height: 726px;

        /* margin-top: 5%; */
        padding: auto;
        margin-left: 7%;
    }

    /* @-webkit-keyframes animatezoom {
     from {
       -webkit-transform: scale(0);
     }
     to {
       -webkit-transform: scale(1);
     }
   }

   @keyframes  animatezoom {
     from {
       transform: scale(0);
     }
     to {
       transform: scale(1);
     }
   } */
    @media screen and (max-width: 1200px) {
        .modal_image img {
            width: 100% !important;
            height: 600px;
            border-top-left-radius: 55px;
            margin-top: 5%;
            padding: auto;
            margin-left: 7%;
        }
    }

    @media screen and (max-width: 1000px) {
        .modal_image {
            display: none;
        }

        .close span {

            right: -15px;
        }
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }

    #myBtn_s {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 9999;
        font-size: 13px;
        border: none;
        outline: none;
        background-color: #1b1752;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 50%;

        width: 50px;
        height: 50px;
    }

    #myBtn_s:hover {
        background-color: #555;
    }
</style>


<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-8 anchor-list d-flex justify-content-between">
                <p>
                    <a href="{{ route('user.contact.us') }}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="contact">
                        <i class="fa fa-phone-square" aria-hidden="true" style="color:#000;"></i>
                    </a>
                    <a href="{{ $setting->skype }}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="youtube">
                        <i class="fa fa-whatsapp" style="color:#018a45" aria-hidden="true"></i>
                    </a>
                    <a href={{ $setting->instagram }}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="Instagram">
                        <i class="fa fa-youtube-play" style="color:red" aria-hidden="true"></i>
                    </a>

                    <a href="{{ $setting->twitter }}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="Twitter">
                        <i class="fa fa-twitter" style="color:rgb(29, 155, 240);"></i>
                    </a>
                    <a href="{{ $setting->facebook }}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                        title="" data-original-title="Facebook">
                        <i class="fa fa-facebook" style="color:#346ff4;"></i>
                    </a>

                </p>

            </div>
            <div class="col-md-4 col-sm-4 col-4 span-list ">
                <p>
                    @auth
                    <span>
                        <a onclick="window.location.href='{{ url('customer/track/order') }}'">
                            <button style="border:none;background:none;padding:0;">Track your order</button></a>
                    </span>

                    <div class="dropdown show" >
                        <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float:right; font-size:12px;">
                            {{ auth()->user()->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ url('customer/home') }}">Profile</a>
                            <a class="dropdown-item" href="#">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button style="border:none;background:none;"> <i class="fa fa-sign-in"
                                            aria-hidden="true"></i>
                                        Logout</button>
                                </form>
                            </a>
                        </div>
                    </div>
                @else
                    <span class="button_login">
                        <a onclick="document.getElementById('id01').style.display='block'">
                            <button><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button></a>
                    </span>
                @endauth

                </p>
            </div>

            <div id="id01" class="modal">

                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="close">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                                    title="Close Modal">&times;</span>

                            </div>

                            <div class="login animate w3-animate-top"
                                style="background:url(../Asset/Uploads/Products/aaa.jpg) 0% 0% no-repeat;background-size: 38% 100%;background-color: #fff;">
                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                                <strong>Welcome!</strong>
                                <span>Sign in to your account</span>
                                @if ($errors->any())
                                    <div class="alert alert-danger col-md-12">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                                @isset($url)
                                    <form method="POST" class="login-form mt-3" action='{{ url("login/$url") }}'
                                        aria-label="{{ __('Login') }}">
                                    @else
                                        <form method="POST" class="login-form mt-3" action="{{ route('login') }}"
                                            aria-label="{{ __('Login') }}">
                                        @endisset
                                        @csrf

                                        <fieldset>
                                            <div class="form">
                                                <div class="form-row">
                                                    {{-- <i class="fa fa-user" aria-hidden="true"></i> --}}
                                                    <label class="form-label" for="input">Email</label>
                                                    <input id="email" type="email"
                                                        class="form-text @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="off" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-row">
                                                    {{-- <i class="fa fa-eye" aria-hidden="true"></i> --}}
                                                    <label class="form-label" for="input">Password</label>
                                                    <input id="password" type="password"
                                                        class="form-text @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="off">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-row bottom">
                                                    <div class="form-check">
                                                        <input type="checkbox" onclick="showPassword()">
                                                        <label for="show"> Show Password</label>
                                                    </div>

                                                </div>
                                                <div class="form-row button-login">
                                                    <button class="btn btn-login form-control">
                                                        {{-- <i class="fa fa-sign-in" aria-hidden="true" style="color: #fff;"></i> --}}
                                                        Login
                                                    </button>
                                                </div>
                                                <p class="text-center mt-1 mb-1">Or, Login With</p>
                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <button type="button"
                                                            class="btn btn-login form-control fb-btn">
                                                            {{-- <i class="fa fa-facebook pr-4" aria-hidden="true"></i> --}}
                                                            Facebook

                                                        </button>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <a href="{{ route('google-login-proceed') }}">
                                                            <button type="button"
                                                                class="btn btn-login form-control google-btn">
                                                                {{-- <i class="fa fa-google-plus pr-4" aria-hidden="true"></i> --}}
                                                                Google
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-center mt-3 mb-2">Are you a New Member ? </p>
                                        </fieldset>
                                    </form>

                                    @isset($url)
                                        <strong> <a href="{{ url("register/$url") }}" style="color: #00A145 ">

                                                Register Now

                                            </a></strong>
                                    @else
                                        <strong> <a href="{{ url('register') }}"style="color: #00A145 ">

                                                Register Now

                                            </a></strong>
                                    @endisset
                            </div>


                        </div>
                        <div class="col-md-2 "></div>
                    </div>
                </div>
                </form>
            </div>


        </div>
    </div>
</div>
<button onclick="topFunction()" id="myBtn_s" title="Go to top"><i class="fa fa-angle-double-up"
        aria-hidden="true"></i></button>
<script>
    // Get the modal
    var modal = document.getElementById("id01");

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // Get the button
    let mybutton = document.getElementById("myBtn_s");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
