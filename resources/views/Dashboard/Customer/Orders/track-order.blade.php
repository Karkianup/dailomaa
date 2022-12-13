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
                        Orders
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="mybody mt-3">
        <div class="container">
            <div class="row">
                {{--  @include('Dashboard.Customer.Partials.side-nav')  --}}
                <div class="col-md-12 profile-manage ">
                    <h2 class="pb-3">My Orders</h2>
                    <div class=" mb-5">
                        <div class="order-det">
                            <h5>Recent Orders</h5>
                            <table class="table" id="trackOrderTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Placed On</th>
                                        <th scope="col">Items</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tableOrders as $order)
                                        @foreach ($order->order_products as $products)
                                            <tr>
                                                <td>{{ $order->order_details['random_id'] }}</th>
                                                <td>{{ $order->order_details['ordered_date'] }}</td>

                                                <td>
                                                    {{ $products['product_name'] }}
                                                </td>
                                                <td>
                                                    {{ $products['quantity'] }}
                                                </td>
                                                <td>
                                                    Rs. {{ $products['price'] }}
                                                </td>
                                                <td>
                                                    Rs. {{ $products['price'] * $products['quantity'] }}
                                                </td>
                                                <td>
                                                    @if ($order['status'] == 1)
                                                        <span class="badge-primary">Successfully ordered</span>
                                                    @elseif($order['status'] == 2)
                                                        <span class="badge-danger">order canceled</span>
                                                    @elseif($order['status'] == 3)
                                                        <span class="badge-info"> order delivered</span>
                                                    @elseif($order['status'] == 3)
                                                        <span class="badge-dark"> order out for delivery</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <br>

                        @if (count($orders))
                            <a class="btn btn-primary" href="{{ route('export.order') }}" style="margin-left:90%">Export to
                                excel</a>
                        @endif
                    </div>
                    {{ $orders->links() }}


                </div>

            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        $('#trackOrderTable').DataTable();
    </script>
@endsection
