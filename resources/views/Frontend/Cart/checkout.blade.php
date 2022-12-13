@extends('Frontend.layouts.master')
@section('content')
    <!-- banner -->
    <div class="nav-info mb-5">
        <div class="container">
            <div class="flex-col flex-grow medium-text-center">
                <nav
                    class="breadcrumbs flex-row flex-row-center heading-font checkout-breadcrumbs text-center strong h4 uppercase">
                    <a href="" class="hide-for-small ">
                        <span class="breadcrumb-step hide-for-small">1</span> Shopping Cart </a>
                    <span class="divider hide-for-small">
                        <fa class="fa fa-angle-right"></i>
                    </span>
                    <a href="" class="current">
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

            <form role="form" action="{{ route('checkout.payment.esewa.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
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

                    <div class="col-md-7">
                        <h4>BILLING DETAILS</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Full Name</label>
                                    <input type="hidden" name="user_id" value="{{ $user->random_id }}">
                                    <input type="text" class="form-control" name="name" readonly
                                        value="{{ $user->name }}" id="formGroupExampleInput" placeholder="Your Name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput2">Address</label>
                            <textarea class="form-control" name="address" cols="30" placeholder="Address" rows="5">{{ old('address', $user->address) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Email</label>
                                    <input type="text" class="form-control" readonly name="email"
                                        value="{{ $user->email }}" id="formGroupExampleInput"
                                        placeholder="yourname@example.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Contact Number</label>
                                    <input type="string" class="form-control" name="contact_no"
                                        value="{{ $user->contact_no }}" id="formGroupExampleInput"
                                        placeholder="Your Contact number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 cart-total">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-right">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartCollection as $cartData)
                                    <tr>
                                        <td class="text-secondary text-weight-light">
                                            {{ $cartData->name }} x
                                            <input type="hidden" name="product_id[]" value="{{ $cartData->id }}">
                                            <input type="hidden" name="quantity" value="{{ $cartData->quantity }}">
                                            <input type="hidden" name="image"
                                                value="{{ $cartData->attributes->image }}">
                                            <span class="c_Inumber">{{ $cartData->quantity }}</span>
                                        </td>
                                        <td class="text-right">
                                            Rs. {{ $cartData->price }} x {{ $cartData->quantity }}
                                        </td>


                                    </tr>
                                @endforeach
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="text-right">Rs. {{ \Cart::getTotal() }}</td>
                                </tr>

                                <tr>
                                    <td>Total Amount</td>
                                    <td class="text-right">
                                        Rs. {{ \Cart::getTotal() }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="wc-proceed-to-checkout">
                            {{--  <button type="submit" class="user-manage-btn">Proceed To Pay</button>  --}}
                        </div>
                        <div class="content pb-4 col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger col-md-12">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4>Select Payment Method : </h4>
                            <div class="program-logos d-flex justify-content-between" id="paymentOptions">
                                @if (count($paymentMethods))
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <div class="cancer">
                                            <span class="radio">
                                                <label>
                                                    <input type="radio" name="payment_method"
                                                        value="{{ $paymentMethod->slug }}" />
                                                    {{ $paymentMethod->title }}


                                                </label>
                                            </span>
                                        </div>
                                    @endforeach
                                    <span class="radio"><label><input type="radio">Credit </label> </span>
                                @else
                                    No payment method has been added
                                @endif

                            </div>
                        </div>
                        @include('Frontend.Payment-Methods.esewa')
                        @include('Frontend.Payment-Methods.cash-on-delivery')
                        @include('Frontend.Payment-Methods.fonepay')
                        @include('Frontend.Payment-Methods.cellpay')
                        {{--  @if ($errors->any())
                            <div class="alert alert-danger col-md-12">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-7 epay">
                                <h4>Select Payment Method</h4>

                                <div class="row">
                                    <div id="paymentOptions" class="col-md-12">
                                        @if (count($paymentMethods))
                                            <ul>
                                                @foreach ($paymentMethods as $paymentMethod)
                                                    <li>
                                                        <span class="radio">
                                                            <label>
                                                                <input type="radio" name="payment_method"
                                                                    value="{{ $paymentMethod->slug }}" />
                                                                <img class="payment-img"
                                                                    src="{{ asset('Asset/Uploads/Payment-Methods/' . $paymentMethod->image) }}"
                                                                    alt="payment">

                                                            </label>
                                                        </span>

                                                    </li>
                                                @endforeach
                                            </ul>
                                                                               <span class="radio"><label><input type="radio">Credit </label> </span>

                                        @else
                                            <ul>
                                                No payment method has been added
                                            </ul>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            @include('Frontend.Payment-Methods.esewa')
                            @include('Frontend.Payment-Methods.cash-on-delivery')
                            @include('Frontend.Payment-Methods.fonepay')
                            @include('Frontend.Payment-Methods.cellpay')
                        </div>  --}}
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- main body -->
@endsection
