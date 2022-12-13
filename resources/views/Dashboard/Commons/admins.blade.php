<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Admins</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="custom-select" id="" name="is_admin">
                <option selected value="">Select Admin</option>
                <option value="0">Not an Admin</option>
                @forelse($admins as $admin)
                <option value="{{$admin->id}}">{{$admin->name}}</option>
                @empty
                <option disabled selected>No admin</option>
                @endforelse
            </select>
        </div>
    </div>
</div>