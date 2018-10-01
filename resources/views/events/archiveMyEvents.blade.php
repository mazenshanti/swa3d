@extends('layouts.master')
 @section('content')


<div class="container" style="margin:20px auto;min-height:600px">

<ul class="nav nav-tabs sw-nav-tabs " role="tablist" style="margin-bottom:30px;margin-top:40px;">
  <li class="nav-item col-4 col-lg-3  first-tab">
    <a class="nav-link "  href="{{route('myEvents')}}" >Up Coming Events    <span class="badge badge-default badge-pill">{{$Uevents->count()}}</span></a>
  </li>
  <li class="nav-item col-4 col-lg-3  second-tab">
    <a class="nav-link active" href="{{route('archiveMyEvents')}}" >My Archived Events    <span class="badge badge-default badge-pill">{{$Aevents->count()}}</span></a>
  </li>
  <li class="nav-item col-4 col-lg-3  third-tab ">
    <a class="nav-link " href="{{route('makeEvent')}}" >Create Event</a>
  </li>
</ul>


<div class="tab-content">


<?php $events = $Aevents; ?>
@include('includes.events')

</div>

@endsection
