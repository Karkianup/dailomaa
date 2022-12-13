@extends('Frontend.layouts.master')
@section('content')
    <?php $segment = Request::segment(1); ?>
    <!-- banner -->
    <div class="nav-info mb-5">
        <div class="container">
            <div class="flex-col flex-grow medium-text-center">
                <nav
                    class="breadcrumbs flex-row flex-row-center heading-font checkout-breadcrumbs text-center strong h4 uppercase">
                    <a href="" class="current">
                        <span class="breadcrumb-step hide-for-small">1</span> Shopping Cart </a>
                    <span class="divider hide-for-small">
                        <fa class="fa fa-angle-right"></i>
                    </span>
                    <a href="" class="hide-for-small">
                        <span class="breadcrumb-step hide-for-small">2</span> Checkout details </a>
                    <span class="divider hide-for-small">
                        <fa class="fa fa-angle-right"></i>
                    </span>
                    <a href="#" class="no-click hide-for-small">
                        <span class="breadcrumb-step hide-for-small">3</span> Order Complete </a>
                </nav>
            </div>
        </div>
    </div>
    <!-- main body -->
    <div class="cart-container">
        <div class="container">
            @if (session()->has('success_msg'))
                <div id="alertMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success_msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if (session()->has('alert_msg'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('alert_msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
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

            <div class="row">
                <div class="col-md-8">
                    @if (count($cartCollection) > 0)
                        <form action="{{ route('cart.clear') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-secondary btn-md">Clear Cart</button>
                        </form>
                    @endif
                    @if (\Cart::getTotalQuantity() > 0)
                        <h4>{{ \Cart::getTotalQuantity() }} Product(s) In Your Cart</h4><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartCollection as $item)
                                    <tr class="">

                                        <td class="product-thumbnail">
                                            <a href="">
                                                <img src="{{ asset($item->attributes->image) }}" width="90"
                                                    height="80">
                                            </a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a target="_blank" href="{{ url('product' . '/' . $item->attributes->slug) }}">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            Rs. {{ $item->price }}
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            {{ $item->quantity }}
                                        </td>
                                        {{-- <td class="product-quantity" data-title="Quantity">
                                            {{ $item->attributes->quantity }}
                                        </td> --}}
                                        <td class="product-subtotal" data-title="Total">
                                            Rs. {{ \Cart::get($item->id)->getPriceSum() }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="form-group row">
                                                    <input type="hidden" value="{{ $item->id }}" id="id"
                                                        name="id">
                                                    <input type="number" class="form-control form-control-sm"
                                                        value="{{ $item->quantity }}" id="quantity" name="quantity"
                                                        style="width: 70px; margin-right: 10px;">
                                                    <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i
                                                            class="fa fa-edit"></i></button>
                                                </div>
                                            </form>

                                        </td>

                                        <td>
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $item->id }}" id="id"
                                                    name="id">
                                                <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                @endforeach
                                </tr>

                                <tr>
                                    <td colspan="6" class="actions clear">
                                        <div class="continue-shopping pull-left text-left">
                                            <a class="button-continue-shopping button primary is-outline"
                                                href="{{ route('home') }}">
                                                ←&nbsp;Continue shopping </a>
                                        </div>
                                </tr>


                            </tbody>
                        </table>
                    @else
                        <h4>No Product(s) In Your Cart</h4><br>
                        <div class="continue-shopping pull-left text-left mb-3">
                            <a class="button-continue-shopping button primary is-outline" href="{{ route('home') }}">
                                ←&nbsp;Continue shopping </a>
                        </div>
                    @endif

                </div>
                @if (count($cartCollection) > 0)
                    <div class="col-md-4 cart-total">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">CART TOTALS</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="text-right"> Rs. {{ \Cart::getTotal() }}</td>

                                </tr>

                                <tr>
                                    <td>Total</td>
                                    <td class="text-right">Rs. {{ \Cart::getTotal() }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="wc-proceed-to-checkout">
                            <a href="{{ route('checkout-from-cart') }}"
                                class="checkout-button button alt wc-forward form-control text-center">
                                Proceed to checkout</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- main body -->
@endsection
