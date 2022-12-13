<div class="card category selected-data">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Category</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="custom-select" id="" name="category_id">
                <option selected value="">Select Category</option>
                @forelse($category as $cat)
                <option value="{{$cat->id}}">
                    {{$cat->name}}
                </option>
                @empty
                <option disabled selected>No Category</option>
                @endforelse
            </select>
        </div>
    </div>
</div>