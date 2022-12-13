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
                    <a href="" class="no-click hide-for-small">
                        <span class="breadcrumb-step hide-for-small">2</span> Checkout details </a>
                    <span class="divider hide-for-small">
                        <fa class="fa fa-angle-right"></i>
                    </span>
                    <a href="#" class="current">
                        <span class="breadcrumb-step hide-for-small">3</span> Order Complete </a>
                </nav>
            </div>
        </div>
    </div>
    <!-- main body -->
    <div class="cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>THANK YOU</h4>
                   
                </div>
               
            </div>
        </div>
    </div>
    <!-- main body -->

@endsection
