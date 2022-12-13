<div class="col-xs-6 col-md-3">
    <h6>Quick Links</h6>
    <ul class="footer-links">
        @foreach ($menu as $men)
            @if ($men->menu_items->count() <= 0)
                <li>
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
                    @elseif($men->type == "writing-category"){
                            href="{{ url('category', $men->url) }}"
                            }
                    @elseif($men->type == "writing-type"){
                            href="{{ url('content', $men->url) }}"
                            } @endif>
                        {{ $men->menu_title }}
                    </a>
                </li>

            @endif
        @endforeach
    </ul>
</div>
