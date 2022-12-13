<div class="card-avatar">
    <a href="#pablo">
        <img class="img" src="{{ !empty($profile->image) ? asset('Asset/Uploads/Users/'.$profile->image):
        url('images/Static/profile.png')}}" alt="{{$profile->name}}}">
    </a>
</div>