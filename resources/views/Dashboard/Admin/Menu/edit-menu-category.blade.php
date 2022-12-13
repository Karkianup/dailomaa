<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">folder_shared</i>
        </div>
        <h4 class="card-title">Parent</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="custom-select" id="" name="menu_category_id">
                @forelse($menuCategory as $mCategory)
                <option value="{{$mCategory->id}}" {{$mCategory->id == $menu->menu_category_id ? 'selected' : ''}}>
                    {{$mCategory->menu_category_name}}</option>
                @empty
                <option disabled selected>No staff</option>
                @endforelse
            </select>
        </div>
    </div>
</div>