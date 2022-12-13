<table>
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Placed on</th>
            <th>Payment status</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total Price</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->order->random_id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    @if ($order->order->payment_status == 1)
                        payed
                    @else
                        payment pending
                    @endif
                </td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->price }}</td>
                <td>{{ $order->price * $order->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
