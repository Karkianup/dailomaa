<div class="card-body ">
    <div>
        <label for="menu_category_name"> Menu Category Title *</label>
        <input type="text" class="form-control"
            value="{{ old('menu_category_name', $menuCategory->menu_category_name) }}" name="menu_category_name"
            id="menu_category_name">
    </div>
</div>
