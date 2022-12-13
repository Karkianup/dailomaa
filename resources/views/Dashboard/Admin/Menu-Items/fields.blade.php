<div class="card ">
    <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
            <h4 class="card-title">Details</h4>
        </div>
    </div>
    <div class="card-body ">
        <div class="row">
            <div
                class="col-md-6 none route url page category sub-category selected-data">
                <div>
                    <label for="menu_item_title"> Menu Item Title *</label>
                    <input type="text" class="form-control" value="{{ old('menu_item_title', $menuItem->menu_item_title) }}"
                        name="menu_item_title" id="menu_item_title">
                </div>
            </div>
            <div class="col-md-6 none route url selected-data">
                <div>
                    <label for="url"> Url *</label>
                    <input type="text" class="form-control" value="{{ old('url', $menuItem->url) }}" name="url" id="url">
                </div>
            </div>
        </div>
    </div>
</div>
