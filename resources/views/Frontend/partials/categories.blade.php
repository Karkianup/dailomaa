<div class="col-xs-6 col-md-3">
    <h6>Categories</h6>
    <ul class="footer-links">
        @foreach ($subCategories as $subCategory)
            <li>
                <a href="{{url('category', $subCategory->slug)}}">
                    {{$subCategory->name}}
                </a>
            </li>
        @endforeach
    </ul>
</div>
