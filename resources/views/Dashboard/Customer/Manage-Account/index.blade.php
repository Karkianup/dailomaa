@extends('Frontend.layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <?php $segment = Request::segment(1); ?>
    <!-- banner -->
    <div class="nav-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                        Account
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
                    <h2 class="pb-3">Manage My Account</h2>
                    <div class="row mb-5">
                        <div class="col-md-5">
                            <div class="bg-gray user-profile">
                                <h5>Personal Profile
                                <p>{{ $user->name }}</p>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="bg-gray user-profile">
                                <h5>Address Book
                                <p class="addr-name">{{ $user->name }}</p>
                                <span>
                                    {{ $user->address }}</span><br>
                                <span>(+977) {{ $user->contact_no }}</span>

                            </div>
                        </div>
                    </div>
                    {{--  <div class="order-det">
                        <h5>Recent Orders</h5>
                        @if (count($orders))
                            <a class="btn btn-primary" href="{{ route('export.order') }}">Export to excel</a>
                        @endif <br><br>
                        <table class="table" id="orderTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Placed On</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_details['random_id'] }}</th>
                                        <td>{{ $order->order_details['ordered_date'] }}</td>
                                        <td>
                                            @foreach ($order->order_products as $products)
                                                <p>
                                                    {{ $products['product_name'] }}
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>Rs. {{ $order->order_details['total_amount'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  --}}

                </div>

            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <script>
        $('#orderTable').DataTable();
    </script>
@endsection
