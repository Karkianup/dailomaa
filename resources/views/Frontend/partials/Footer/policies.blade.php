<div class="col-md-2 col-sm-2 col-4">
    <h5 class="footer-text">Policies</h5>
    <ul>
        @foreach ($menu as $men)

            <a @if ($men->type == 'route') {
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
@elseif($men->type == "category"){
                href="{{ url('category', $men->url) }}"
            }
@elseif($men->type == "sub-category"){
                href="{{ url('content', $men->url) }}"
            } @endif>

                <li class="footer-text">
                    {{ $men->menu_title }}
                </li>

            </a>

        @endforeach
    </ul>
</div>
