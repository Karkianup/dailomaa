<div class="col-md-4">
    <p class="welcomeMsg">Hello, {{ $user->name }}</p>
    <a href="{{ url($segment . '/' . 'home') }}">
        <h4>Manage My Account</h4>
    </a>
    <div class="sub-options">
        <a href="{{ url($segment . '/' . 'profile') }}">
            <span>My Profile</span>
        </a>
        {{--  <span>Address book</span>
        <span>My payment Options</span>  --}}
    </div>
    <h4>My Orders</h4>
    <div class="sub-options">
        <a href="{{ url($segment . '/' . 'order') }}">
            <span>My order history</span>
        </a>
    </div>

    <h4>My Payments</h4>
    <div class="sub-options">
        <a href="{{ route('customer.payment.history') }}">
            <span>My payment history</span>
        </a>
    </div>

</div>
