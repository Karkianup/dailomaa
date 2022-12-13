@extends('Frontend.layouts.master')
@section('content')
<div class="nav-info mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <nav class="breadcrumbs">
                    <a href="{{ route('home') }}">home</a>
                    <span class="divider">/</span>
                   Scrap Sell
                </nav>
            </div>

        </div>
    </div>
</div>
<section class="item-body mb-5">
    <div class="container">
                    @if(Session('message'))
                        <div class="alert alert-success">{{ Session('message') }}</div>
                    @endif
        <form role="form" action="{{route('user.scrap-sell.store')}}" method="POST" enctype="multipart/form-data">
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
            <div class="col-md-12">
                <div class="product-summary">
                    <input type="hidden" name="type" value="Scrap Sell">
                        <div class="form-group">
                            <input type="hidden" name="name" value=" {{ auth()->user()->name }}" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Your Name" required>
                          </div>
                          <div class="form-group">
                            <input type="hidden" name="contact_number" value=" {{ auth()->user()->contact_no }}" class="form-control" id="contact_number" placeholder="Contact Number">
                          </div>
                          {{--  <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" id="address" placeholder="Address">
                          </div>  --}}
                          <div class="form-group">
                            <label for="pName">Describe your scrap</label>
                            <textarea class="form-control"  name="body" id="" cols="30" rows="10">{{ old('body') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit your request</button>
                </div>

            </div>
        </div>
    </form>

    </div>
</section>
@endsection
