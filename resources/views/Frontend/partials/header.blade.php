<style>


.logo-img {

  animation-name: rotate-windows;
  animation-iteration-count: infinite;
  animation-duration: 40s;
  animation-fill-mode: forwards;
}


@keyframes rotate-windows {
  0% {
    transform: perspective(500px) rotateY(360deg);
    -webkit-transform: perspective(500px) rotateY(360deg);
    -moz-transform: perspective(500px) rotateY(360deg);
    -ms-transform: perspective(500px) rotateY(360deg);
    -o-transform: perspective(500px) rotateY(360deg);


  }
 100% {
    transform: perspective(500px) rotateY(0deg);
    -webkit-transform: perspective(500px) rotateY(0deg);
    -moz-transform: perspective(500px) rotateY(0deg);
    -ms-transform: perspective(500px) rotateY(0deg);
    -o-transform: perspective(500px) rotateY(0deg);
  }
  /* 100% {
    transform: perspective(500px) rotateY(-180deg);
    -webkit-transform: perspective(500px) rotateY(-180deg);
    -moz-transform: perspective(500px) rotateY(-180deg);
    -ms-transform: perspective(500px) rotateY(-180deg);
    -o-transform: perspective(500px) rotateY(-180deg);
  } */
}

</style>
<header class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="adc">
                <div class="logo-img">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('Asset/Uploads/Logo/' . $settings[0]['logo']) }}">
                    </a>
                </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="search header_search self-menu text-center">
                    <button class="btn btn-primary"
                        onclick="window.location.href='{{ route('direct-order.index') }}';">
                        Direct Order&nbsp;&nbsp; <i class="fa fa-shopping-basket"></i>
                    </button>
                </div>

            </div>
            <div class="col-md-3">
                <div class="search header_search self-menu">
                    <form action="{{ route('search.index') }}" method="GET" role="search">
                        <input type="search" class="search_input" required="required" placeholder="Search..." name="product">
                        <button type="submit" id="search_button" class="search_button">
                            <i class="fa fa-search"></i>
                            <!-- <img src="images/magnifying-glass.svg" alt=""> -->
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="search header_search self-menu text-center">
                    <button class="btn btn-primary"
                        onclick="window.location.href='{{ route('user.scrap-sell') }}';">
                        Sell your scrap&nbsp;&nbsp; <i class="fa fa-shopping-basket"></i>
                    </button>
                </div>

            </div>

            <div class="col-md-2 col-5 self-menu cart text-left">
                <a href="{{ route('cart.index') }}">
                    <p>My Cart</p>
                    <i class="fa fa-shopping-cart"></i>
                    <div class="cart_num_container">
                        <div class="cart_num_inner">
                            <div class="cart_num">
                                @if (\Cart::getTotalQuantity() > 0)
                                    {{ \Cart::getTotalQuantity() }}
                                @else
                                    0
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</header>
@include('Frontend.partials.Nav.main-menu')
