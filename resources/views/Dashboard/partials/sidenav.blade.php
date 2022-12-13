<div class="sidebar-wrapper">
    <?php $segment1 = Request::segment(1); ?>
    @include('Dashboard.partials.user-info')
    <ul class="nav">
        <li class="nav-item">

            <a class="nav-link" href="{{ $settings[0]['site_url'] }}" target="_blank">
                <i class="fas fa-globe"></i>
                <p> Visit Site </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'dashboard']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'dashboard') }}">
                <i class="fas fa-cogs"></i>
                <p> Dashboard </p>
            </a>
        </li>

        @if ($segment1 == 'admin' || $segment1 == 'retailer')
            <li class="nav-item {{ Request::is([$segment1 . '/' . 'brand*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'brand') }}">
                    <i class="fas fa-cube fa-fw"></i>
                    <p> Brand </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is([$segment1 . '/' . 'product*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'product') }}">
                    <i class="fas fa-user-edit"></i>
                    <p> Product </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'category*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'category') }}">
                    <i class="fas fa-list"></i>
                    <p> Category </p>
                </a>
            </li>
        @endif



        @if ($segment1 == 'admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#orders" aria-expanded="true">
                    <i class="fas fa-shopping-cart"></i>
                    <p> Orders
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="orders" style="">
                    <ul class="nav">
                        <li class="nav-item {{ Request::is([$segment1 . '/' . 'direct-order']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url(Request::segment(1), 'direct-order') }}">
                                <span class="sidebar-mini"> DO </span>
                                <span class="sidebar-normal">Direct </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is([$segment1 . '/' . 'pending-orders*']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url(Request::segment(1), 'pending-orders') }}">
                                <span class="sidebar-mini"> PO </span>
                                <span class="sidebar-normal">Pending </span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::is([$segment1 . '/' . 'cancelled-orders*']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url(Request::segment(1), 'cancelled-orders') }}">
                                <span class="sidebar-mini"> CO </span>
                                <span class="sidebar-normal">Cancelled </span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::is([$segment1 . '/' . 'out-for-delivery*']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url(Request::segment(1), 'out-for-delivery') }}">
                                <span class="sidebar-mini"> OFD </span>
                                <span class="sidebar-normal">Out For Delivery </span>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is([$segment1 . '/' . 'delivered-orders']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route(Request::segment(1) . '.' . 'delivered') }}">
                                <span class="sidebar-mini"> DD </span>
                                <span class="sidebar-normal">Delivered </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is([$segment1 . '/' . 'banner*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'banner') }}">
                    <i class="fas fa-images"></i>
                    <p> Banners </p>
                </a>
            </li>



            @can('is_super_admin')
                <li class="nav-item {{ Request::is([$segment1 . '/' . 'admin*']) ? 'active' : '' }}">

                    <a class="nav-link" href="{{ url(Request::segment(1), 'admin') }}">
                        <i class="fas fa-user-secret"></i>
                        <p> Admins </p>
                    </a>
                </li>
            @endcan

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'retailer*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'retailer') }}">
                    <i class="fas fa-users-cog"></i>
                    <p> Retailers </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'customer*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'customer') }}">
                    <i class="fas fa-users"></i>
                    <p> Customers </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'wholesaler*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'wholesaler') }}">
                    <i class="fas fa-users"></i>
                    <p> Wholesaler </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'page*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'page') }}">
                    <i class="far fa-file-alt"></i>
                    <p> Page </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'query']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'query') }}">
                    <i class="fas fa-question"></i>
                    <p> Query </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'ds*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('admin.advertisement.index') }}">
                    <i class="far fa-file-alt"></i>
                    <p> Advertisement </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'page*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('admin.advertisement1.index') }}">
                    <i class="far fa-file-alt"></i>
                    <p> Advertisement1 </p>
                </a>
            </li>

            <li class="nav-item {{ Request::is([$segment1 . '/' . 'page*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('admin.advertisement2.index') }}">
                    <i class="far fa-file-alt"></i>
                    <p> Section Advertisement </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is([$segment1 . '/' . 'page*']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('admin.map.edit') }}">
                    <i class="far fa-file-alt"></i>
                    <p> Map </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="true">
                    <i class="fas fa-cog"></i>
                    <p> Settings
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse" id="settings" style="">
                    <ul class="nav">
                        <li class="nav-item {{ Request::is([$segment1 . '/' . 'payment-method*']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url(Request::segment(1), 'payment-method') }}">
                                <span class="sidebar-mini"> PM </span>
                                <span class="sidebar-normal"> Payment Method </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is([$segment1 . '/' . 'site-settings*']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url(Request::segment(1), 'site-settings') }}">
                                <span class="sidebar-mini"> SS </span>
                                <span class="sidebar-normal"> Site Settings </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is([$segment1 . '/' . 'developer*']) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url(Request::segment(1), 'developer') }}">
                                <span class="sidebar-mini"> DS </span>
                                <span class="sidebar-normal"> Developer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item {{ Request::is([$segment1 . '/' . 'menu-category']) ? 'active' : '' }}">

                <a class="nav-link" href="{{ url(Request::segment(1), 'menu-category') }}">
                    <i class="fas fa-bars"></i>
                    <p> Menus </p>
                </a>
            </li>
        @endif

    </ul>
</div>
