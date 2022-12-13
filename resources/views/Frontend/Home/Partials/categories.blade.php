<div class="col-md-4">
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action headCat">
            <i class="fa fa-bars"></i>&nbsp;&nbsp; <h4 style="display:inline-block">Browse Categories
            </h4>
        </a>
        @foreach($subCategories as $subCategory)
        <a href="{{url('category', $subCategory->slug)}}" class="list-group-item list-group-item-action">{{$subCategory->name}}</a>
        @endforeach
    </div>
</div>