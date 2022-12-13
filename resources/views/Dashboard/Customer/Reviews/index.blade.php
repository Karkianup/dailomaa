@extends('Frontend.layouts.master')
@section('content')
    <?php $segment = Request::segment(1); ?>
    <!-- banner -->
    <div class="nav-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>Art Kit</h3>
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                        Reviews
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <section class="mybody mt-3">
        <div class="container">
            <div class="row">
                @include('Dashboard.Customer.Partials.side-nav')
                <div class="col-md-8 profile-manage ">
                    <h2 class="pb-3">My Reviews</h2>
                    <div class=" mb-5">

                        <div class="orders">
                            @foreach ($reviews as $review)
                                <div class="order item-review">
                                    <h6>
                                        Reviewed on {{ $review->created_at->format('F j, Y') }}
                                    </h6>
                                    <div class="order-item review">
                                        <div class="my-item">
                                            <div class="item-pic" data-spm="detail_image"><a href="#"><img
                                                        src="{{ asset('Asset/Uploads/Products/' . $review->product->main_image) }}"></a>
                                            </div>
                                            <div class="item-main item-main-mini">
                                                <div>
                                                    <div class="text title item-title" data-spm="details_title">
                                                        {{ $review->product->name }}
                                                    </div>
                                                    <p class="text desc"></p>
                                                    <p class="text desc bold"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-reviews-group-header">
                                            <span>
                                                {{ $review->message }}
                                            </span>
                                        </div>
                                        {{-- <div class="my-reviews-group-header">
                                            <span>Sold by
                                                <div class="review-seller">
                                                    <a href="" class="review-seller-name">Crystal Beauty</a>
                                                </div>
                                            </span>
                                        </div> --}}

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </section>

@endsection
