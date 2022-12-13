<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<style>

    /* Add Zoom Animation */
    .animate_a {
   -webkit-animation: animatezoom 0.6s;
   animation: animatezoom 0.6s;

 }
  @-webkit-keyframes animatezoom_a {
   from {
     -webkit-transform: scale(0);
   }
   to {
     -webkit-transform: scale(1);
   }
 }

 @keyframes  animatezoom_a {
   from {
     transform: scale(0);
   }
   to {
     transform: scale(1);
   }
 }
 .modal-body{
     background:url(https://dailomaa.com/Asset/Uploads/Products/5fe75b7375490-500x500.jpg);

     background-size: 100% 100% ;

     background-repeat: no-repeat ;
     object-fit: cover ;
   height: 55vh;
   /* width: 400px; */
 }
 .modal-body p{
    color: #fff;
 }
 /* @media (min-width:270px) and (max-width: 580px) {
     .animate_a {
   width: 35%;
 }
} */



</style>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

    <ul class="carousel-indicators">
        @php $c = 0; @endphp
        @foreach ($banners as $banner)
            @php $c++ @endphp
            <li data-target="#demo" data-slide-to="0" class="{{ $c == 1 ? 'active' : '' }}"></li>
        @endforeach
    </ul>
    <div class="carousel-inner">
        @php $c = 0 @endphp
        @foreach ($banners as $banner)
            @php $c++; @endphp
            <div class="carousel-item {{ $c == 1 ? 'active' : '' }}">
            <a href="{{ $banner->url }}" target="_blank">
                <img class="d-block w-100" src="{{ asset($banner->banner_image) }}" alt="First slide">
            </a>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls" data-slide="prev">
      <i class="fa fa-chevron-circle-left" aria-hidden="true" style="font-size: 44px;"></i>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" data-slide="next">
      <i class="fa fa-chevron-circle-right" aria-hidden="true" style="font-size: 44px;"></i>
    </a>

    {{-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

        <span class="sr-only">Next</span>
    </a> --}}
</div>
