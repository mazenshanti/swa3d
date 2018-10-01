<?php $userType = Auth::user()->userType; ?>

@if($userType == 0)
  @extends('individual/layouts.profileMaster')
  @section('content')
  <div class="container-fluid" style="margin:120px auto">
      <div class="row">
            @include('individual/includes.sidebar')

@elseif($userType == 1)
  @extends('institute/layouts.profileMaster')
  @section('content')
  <div class="container-fluid" style="margin:120px auto">
      <div class="row">
            @include('institute/includes.sidebar')

@elseif($userType == 3)
  @extends('initiative/layouts.profileMaster')
  @section('content')
  <div class="container-fluid" style="margin:120px auto">
      <div class="row">
            @include('initiative/includes.sidebar')
@endif


	         <div class="col-sm-12  col-md-8  col-lg-9" style="color: #333">
          <h1>Following</h1>
          <hr>

        <div class="row justify-content-around">
           @foreach ($following as $followi)
               <div class="card col-5 mb-4">
                   <div class="card-block">
                       <div class="row">
                           <div class="col-6">
                               <a href="#">
                                 <img class="img-fluid rounded all-news-img" src="{{ URL::to('/') }}/pp/{{$followi->picture}}" alt="">
                             </a>
                         </div>
                         <div class="col-6">
                           <h5 class="card-title greencolor"><a href="{{route('profile',$followi->requested_id)}}">{{$followi->name}}</a></h5>
                           <p class="card-text line-clamp"><a href="{{route('messenger',$followi->email)}}">{{$followi->email}}</a></p>
                           <a class='btn btn-danger'  href="{{route('unfollow',$followi->id)}}">Unfollow</a>
                       </div>
                   </div>
               </div>
           </div>
           @endforeach
         </div>
    </div>
  </div>
</div>

@endsection('content')
