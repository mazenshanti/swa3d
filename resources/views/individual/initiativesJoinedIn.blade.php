
@extends('individual/layouts.profileMaster')

@section('content')
<div class="container-fluid" style="margin:120px auto">
    <div class="row">
      @include('individual/includes.sidebar')

           <div class="col-sm-12  col-md-8  col-lg-9" style="color: #333">
          <h1>My Initiatives</h1>
          <hr>

        <div class="row justify-content-around">
           @foreach ($myInitiatives as $myInitiative)
               <div class="card col-5 mb-4">
                   <div class="card-block">
                       <div class="row">
                           <div class="col-6">
                               <a href="#">
                                 <img class="img-fluid rounded all-news-img" src="{{ URL::to('/') }}/pp/{{$myInitiative->picture}}" alt="">
                             </a>
                         </div>
                         <div class="col-6">
                           <h5 class="card-title greencolor"><a href="{{route('profile',$myInitiative->requested_id)}}">{{$myInitiative->name}}</a></h5>
                           <p class="card-text line-clamp"><a href="{{route('messenger',$myInitiative->email)}}">{{$myInitiative->email}}</a></p>
                       </div>
                   </div>
               </div>
           </div>
           @endforeach
         </div>
    </div>
  </div>
</div>
@endsection
