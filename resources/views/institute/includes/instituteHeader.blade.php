@if(auth::user()->userType == 1)
<div id="navtop"></div>
<nav class="navbar mainNavbar navbar-toggleable-lg navbar-light bg-faded  fixed-top"style="background-image:url('{{ URL::to('/') }}/pp/newlogo-min.png');    background-repeat: no-repeat;
    padding-left:0px;
    background-size: 65px;
background-position-x: 8px;
background-position-y: 7px;">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ route('main') }}"style="padding-left:80px;">SWA3ED</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-user" aria-hidden="true"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Timeline</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('findVolunteers')}}"><i class="fa fa-users" aria-hidden="true"></i> Find Volunteers</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="{{route('makeEvent')}}" style="color: #f1ae3a;">Create Event</a>
      </li>

    </ul>
    <div class="form-inline my-2 my-lg-0 nav-right">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
          <form action="{{route('search')}}" method="get" >
            <input type="text" name="search" id="HeaderSearch" class="HeaderSearch form-control" placeholder="&#xF002;" style="font-family:Arial, FontAwesome">
            <button type="submit" style="display: none;"></button>
          </form>

          </li>
      <li class="nav-item ">
       @if (Auth::guest())

        <a class="nav-link" href="{{ route('login') }}">Login <span class="sr-only"></span></a>
 @else
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-nav" role="menu">
                                  <li><a class="dropdown-item" href="{{ route('home') }}">Your Profile</a></li>
                                  <li><a class="dropdown-item" href="{{ route('followers') }}">Followers</a></li>
                                  <li><a class="dropdown-item" href="{{ route('following') }}">Following</a></li>
                                  <li><a class="dropdown-item" href="{{ route('makeEvent') }}">Make Event</a></li>
                                  <li><a class="dropdown-item" href="{{ route('findVolunteers') }}">Find Volunteers</a></li>
                                    <div class="dropdown-divider"></div>

                                    <li class="logout-dropdown-item">
                                        <a class="dropdown-item text-danger"  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                          <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
      </li>


      </ul>
    </div>
  </div>
</nav>
@endif
