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
                    <label for="menu_title"> Menu Title *</label>
                    <input type="text" class="form-control" value="{{ old('menu_title', $menu->menu_title) }}"
                        name="menu_title" id="menu_title">
                </div>
            </div>
            <div class="col-md-6 none route url selected-data">
                <div>
                    <label for="url"> Url *</label>
                    <input type="text" class="form-control" value="{{ old('url', $menu->url) }}" name="url" id="url">
                </div>
            </div>
        </div>
    </div>
</div>
