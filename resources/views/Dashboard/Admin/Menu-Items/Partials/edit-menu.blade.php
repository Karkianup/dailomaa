<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">folder_shared</i>
        </div>
        <h4 class="card-title">Parent</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="custom-select" id="" name="menu_id">
                @forelse($menu as $data)
                <option value="{{$data->id}}" {{$data->id == $menuItem->menu_id ? 'selected' : ''}}>
                    {{$data->menu_title}}</option>
                @empty
                <option disabled selected>No Parent</option>
                @endforelse
            </select>
        </div>
    </div>
</div>