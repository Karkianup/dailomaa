<?php
$segment2 = ucfirst(Request::segment(2));
$segment3 = ucfirst(Request::segment(3));
$segment4 = ucfirst(Request::segment(4));

?>

@if ($segment3)
<h4 class="card-title">
    {{$breadcrum = $segment2 .'/' . $segment3}}
</h4>
@else
<h4 class="card-title">
    {{$breadcrum = $segment2}}
</h4>
@endif