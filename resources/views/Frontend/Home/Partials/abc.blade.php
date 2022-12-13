<section class="item-detail">
    <div class="container-fluid">
        <h2>ABC</h2>
        {{-- <div class="product-det">
            <div class="row">
                @foreach ($newProducts as $newProduct)
                    <div class="col-2 col-sm-2 col-md-2">
                        <div class="indi-prod">
                            <div class="product-img">
                                <a href="{{ route('product-details', $newProduct->slug) }}">
                                    <img src="{{ asset('Asset/Uploads/Products/' . $newProduct->main_image) }}">
                                </a>
                            </div>
                            <div class="pro-detail">
                                <span class="p-tag">{{ $newProduct->brand->name }}</span>
                                <span class="abt-pro">
                                    <a href="{{ route('product-details', $newProduct->slug) }}">
                                        {{ $newProduct->name }}
                                    </a>
                                </span>
                                <span class="p-rate">
                                    @if ($newProduct->sale_price)
                                        <del>NRS {{ $newProduct->regular_price }}</del>
                                        NRS {{ $newProduct->sale_price }}
                                    @else
                                        NRS {{ $newProduct->regular_price }}
                                    @endif
                                </span>
                                <a href="{{ route('product-details', $newProduct->slug) }}">
                                    <span class="p-view text-center">

                                        View Details

                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div> --}}
        {{-- commented by anup --}}
        {{-- <div class="feature-catogory home-page-fc lazyload animated fadeIn">
            <div class="row">
                @foreach ($newProducts as $newProduct)
                    <div class="col-md-2 col-sm-6 cato-box text-center pb-2"style="background: #FFF;">
                        <div class=" agile_ecommerce_tab_left">
                            <div class="hs-wrapper">
                                <img src="{{ asset('Asset/Uploads/Products/' . $newProduct->main_image) }}" alt=" "
                                    width="100%" height="100%">
                                @if (!empty($newProduct->image))
                                    @foreach (json_decode($newProduct->image, true) as $image)
                                        <img src="{{ asset('Asset/Uploads/Products/' . $image) }}" width="100%"
                                            height="100%">
                                    @endforeach
                                @endif
                                <div class="hs_bottom">
                                    <div class="simpleCart_shelfItem" style="color: #FFF; text-align:center;">
                                        <strong>
                                            <h5>
                                                @if ($newProduct->sale_price)
                                                    NRS <del>{{ $newProduct->regular_price }}</del>
                                                    {{ $newProduct->sale_price }}
                                                @else
                                                    NRS {{ $newProduct->regular_price }}
                                                @endif
                                            </h5>
                                        </strong>
                                    </div>
                                    <ul style="margin-top:50px; margin-right:15%;">
                                        <li>
                                            <a href="{{ route('product-details', $newProduct->slug) }}"><span
                                                    class="fa fa-eye" aria-hidden="true"></span></a>
                                        </li>
                                        <li>
                                            <form class="cart mt-3" role="form"
                                                action="{{ route('index.cart.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="number" name="quantity" value="1" />
                                                <input type="hidden" id="id" name="id"
                                                    value="{{ $newProduct->id }}" />
                                                <button type="submit" class="AddtoCartbtn button alt"
                                                    style="background-color:white;padding:6px"><span
                                                        class="fa fa-shopping-cart" aria-hidden="true"></span></button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="f-category-name">{{ $newProduct->name }} <span class="offer-tag-main"></span></div>
                    </div>
                @endforeach
            </div>
        </div> --}}

        <div class="feature-catogory home-page-fc lazyload animated fadeIn">
            <div class="row">
                @foreach ($newProducts as $forYou)
                    <div class="col-md-2 col-sm-6 cato-box text-center pb-2"style="background: #FFF;">
                        <div class=" agile_ecommerce_tab_left">
                            <div class="hs-wrapper">
                                <img src="{{ asset('Asset/Uploads/Products/' . $forYou->main_image) }}" alt=" "
                                    width="100%" height="100%">
                                    @if($forYou->image)
                                  @foreach (json_decode($forYou->image, true) as $forYo)
                                    <img src="{{ asset('Asset/Uploads/Products/' . $forYo) }}" width="100%"
                                        height="100%">
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="f-category-name">{{ $forYou->name }} <span class="offer-tag-main"></span>
                        </div>
                       <hr>
                        <ul style=" display:flex; justify-content:space-between; margin-left: -41px;">
                            <li style="padding: 6px;">
                                <a href="{{ route('product-details', $forYou->slug) }}" style="border-color: rgba(0, 0, 0, 0.05);background-color:white;"><span
                                        class="fa fa-eye" aria-hidden="true"></span>
                                </a>
                            </li>
                            <div class="">
                                <div class="simpleCart_shelfItem" style="color: #000; text-align:center;">
                                    <strong>
                                        <h5>
                                        <b>
                                            @if ($forYou->sale_price)
                                                NRS<del> {{ $forYou->regular_price }}</del>
                                                 <span style="color: #f30404;"> {{ $forYou->sale_price }}</span>
                                            @else
                                                NRS {{ $forYou->regular_price }}
                                            @endif
                                        </b>
                                        <h5>
                                    </strong>
                                </div>

                            </div>
                            <li>
                                <form class="cart" role="form"
                                    action="{{ route('index.cart.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="number" name="quantity" value="1" />
                                    <input type="hidden" id="id" name="id"
                                        value="{{ $forYou->id }}" />
                                    <button type="submit" class="AddtoCartbtn button alt"
                                        style="background-color:white;padding:6px;border:none"><span
                                            class="fa fa-shopping-cart" aria-hidden="true"></span></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="" style="float: right;">
            <a href="{{ route('new.arrival.product') }}"> <button type="button" class="btn">
                    View All <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </button></a>
        </div>
    </div>
</section>
