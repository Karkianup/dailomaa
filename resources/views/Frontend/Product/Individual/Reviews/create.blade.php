<div class="add-review">
    <h4>add a review</h4>
    <form role="form" action="{{ route('review') }}" method="POST"
        enctype="multipart/form-data">
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
        <section class='rating-widget'>

            <!-- Rating Stars Box -->
            <div class='rating-stars'>
                <ul id='stars'>
                    <li class='star' title='Poor' data-value='1'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Fair' data-value='2'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Good' data-value='3'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Excellent' data-value='4'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='WOW!!!' data-value='5'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                </ul>
            </div>
        </section>
        <textarea name="message" required=""></textarea>
        <input type="hidden" name="user_id" value="{{Auth::user()->random_id}}">
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <input type="submit">
    </form>
</div>
