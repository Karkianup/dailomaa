<div class="user">
    @php
    // $lUser = "";

    if($segment1 == "admin"){

    $user = Auth::guard('admin')->user();
    }
    elseif ($segment1 == "retailer")
    {
    $user = Auth::guard('retailer')->user();

    }
    else{
    $user = Auth::user();
    }
    @endphp

    <div class="photo">
        <img class="image" src="{{ !empty($user->image) ? asset('Asset/Uploads/Users/'.$user->image):
                            url('Asset/Uploads/Static/profile.png')}}" alt="">
    </div>
    <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
            <span>
                {{$user->name}}
                <b class="caret"></b>
            </span>
        </a>
        <div class="collapse" id="collapseExample">
            <ul class="nav">
                <li class="nav-item {{ Request::is([$segment1.'/'.'profile']) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url($segment1,'profile')}}">
                        <span class="sidebar-mini"> MP </span>
                        <span class="sidebar-normal"> My Profile </span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is([$segment1.'/'.'change-password']) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url($segment1.'/'.'change-password')}}">
                        <span class="sidebar-mini"> MP </span>
                        <span class="sidebar-normal"> Change Password </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>