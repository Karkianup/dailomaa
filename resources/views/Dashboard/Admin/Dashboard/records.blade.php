<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-list"></i>

                </div>
                <p class="card-category">Categories</p>
                <h3 class="card-title">{{$categories}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-list"></i>

                </div>
                <p class="card-category">Sub Categories</p>
                <h3 class="card-title">{{$subCategories}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-cubes"></i>

                </div>
                <p class="card-category">Brands</p>
                <h3 class="card-title">{{$brands}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                   <i class="far fa-money-bill-alt"></i>

                </div>
                <p class="card-category">Orders Revenue</p>
                <h3 class="card-title">1,200,000</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                 <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Products</p>
                <h3 class="card-title">{{$products}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                 <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Orders</p>
                <h3 class="card-title">{{$orders}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                <p class="card-category">Admins</p>
                <h3 class="card-title">{{ App\Admin::count() }}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <p class="card-category">Retailers</p>
                <h3 class="card-title">{{ App\Retailer::count() }}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <p class="card-category">Customers</p>
                <h3 class="card-title">{{ App\User::count() }}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Total
                </div>
            </div>
        </div>
    </div>

</div>
