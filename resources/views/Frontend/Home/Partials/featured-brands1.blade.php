<div id="carouselExampleControls_a" class="carousel slide" data-ride="carousel" data-interval="9000">

    <div class="carousel-inner">
        @php $c = 0 @endphp
        @foreach ($advertisements1 as $advertisement)
            @php $c++; @endphp
            <div class="carousel-item {{ $c == 1 ? 'active' : '' }}">
                <a href="{{ $advertisement->link }}">
                    <img class="d-block w-100" src="{{ asset('Asset/Uploads/advertisements1/' . $advertisement->url) }}"
                        alt="First slide" style="height: 29vh;">
                </a>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls_a" data-slide="prev">
        {{-- <span class="carousel-control-prev-icon"></span> --}}
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls_a" data-slide="next">
        {{-- <span class="carousel-control-next-icon"></span> --}}
    </a>

</div>
