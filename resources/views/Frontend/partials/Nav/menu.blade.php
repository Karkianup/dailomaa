<ul class="navbar-nav mr-auto">
    @foreach ($menu as $men)
        @if ($men->menu_items->count() <= 0)
            <li class="nav-item
    @if ($men->type == 'route') {
                {{ Route::is($men->url) ? 'active' : '' }}
                }
            @elseif($men->type == "none"){
                {{ Request::is($men->url) ? 'active' : '' }}
                }
            @elseif($men->type == "url"){
                {{ Request::is($men->url) ? 'active' : '' }}
                }
            @elseif($men->type == "page"){
                {{ Request::is($men->url) ? 'active' : '' }}
                }
            @elseif($men->type == "writing-category"){
                {{ Request::is('category' . '/' . $men->url) ? 'active' : '' }}
                }
            @elseif($men->type == "writing-type"){
                {{ Request::is('content' . '/' . $men->url) ? 'active' : '' }}
                } @endif ">
                <a class="nav-link 
            @if ($men->type == 'route') {
                    {{ Route::is($men->url) ? 'active' : '' }}
                    }
                @elseif($men->type == "none"){
                    {{ Request::is($men->url) ? 'active' : '' }}
                    }
                @elseif($men->type == "url"){
                    {{ Request::is($men->url) ? 'active' : '' }}
                    }
                @elseif($men->type == "page"){
                    {{ Request::is($men->url) ? 'active' : '' }}
                    }
                @elseif($men->type == "writing-category"){
                    {{ Request::is('category' . '/' . $men->url) ? 'active' : '' }}
                    }
                @elseif($men->type == "writing-type"){
                    {{ Request::is('content' . '/' . $men->url) ? 'active' : '' }}
                    } @endif
                    {{ Request::is($men->url) ? 'active' : '' }}
                    "aria-haspopup="true" aria-expanded="false"
                    @if ($men->type == 'route'){
                        href="{{ route($men->url) }}"
                        }
                    @elseif($men->type == "none"){
                        href="{{ url($men->url) }}"
                        }
                    @elseif($men->type == "url"){
                        href="{{ url($men->url) }}"
                        }
                    @elseif($men->type == "page"){
                        href="{{ url('page', $men->url) }}"
                        }
                    @elseif($men->type == "writing-category"){
                        href="{{ url('category', $men->url) }}"
                        }
                    @elseif($men->type == "writing-type"){
                        href="{{ url('content', $men->url) }}"
                        }
                    @endif
                    >
                    {{ $men->menu_title }}
                </a>
            </li>

        @endif
    @endforeach
</ul>


<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="">Home</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" href="">Pens
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="">Ball Pen</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">Jel Pen</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">HIe</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">Fountain pen</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">Achivement</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">Helping Hands</a>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link" href="">News &amp; Notices</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">Gallery</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">Contact</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" href="">Other
            Services
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="">Ambulance</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">Funds</a>
            <div class="dropdown-divider"></div>

        </div>
    </li>

</ul>