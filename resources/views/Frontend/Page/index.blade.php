@extends('Frontend.layouts.master')
@section('content')
    <div class="nav-info mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <nav class="breadcrumbs">
                        <a href="{{ route('home') }}">home</a>
                        <span class="divider">/</span>
                        <a href="#">Page</a>
                        <span class="divider">/</span>
                        {{ $page->title }}
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <div class="single_page">
        <p>{!! $page->content !!}</p>
    </div>
@endsection
