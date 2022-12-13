<div class="col-md-3 col-sm-6 col-12 pt-3 pb-3">
    <h5> About Dailoma</h5>
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

                <li class="pb-1">
                    {{ $men->menu_title }}
                </li>

            </a>

        @endforeach
    </ul>
</div>
