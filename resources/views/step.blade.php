@extends('layouts.app')
@section('title')
Swa3ed - Register
@endsection
 @section('content')
<div class="container " style="margin:100px auto; min-height:50vh">
    <div class="row " >

        <div class="col-lg-10 offset-md-1">
        @if(auth::user()->verified==0)

        <div class="alert alert-warning" role="alert" style="">
          <h4 class="alert-heading">We've sent you an email to <strong> {{ auth::user()->email}}!</strong> </h4>
          <p> Please check your inbox to verify your account.</p>
          <hr  style="background-color:#333">
          <p class="mb-0">
              <small>This may take up to 5 minutes.</small>
          </p>
        </div>

        @else
        @if(auth::user()->verified==1)

        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         <strong>Verified!</strong> You are good to go.
        </div>
            @endif

            <div class="card">
                <div class="card-block">
                    <form id="step" role="form" method="POST" action="{{ route('allRegister') }}">{{ csrf_field() }}
                      <div class="row">
                        <div class="col-12">
                          <h4 class="greencolor">Basic information</h4>
                          <hr />
                        </div>
                        {{--  --}}
                        <div class="  col-sm-12 col-md-6 form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="email" class=" form-control-label">First Name</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}"
                                required="required" />
                                @if ($errors->has('firstName'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('firstName') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{--  --}}
                        {{--  --}}
                        <div class="col-sm-12 col-md-6 form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label for="email" class="form-control-label">Last Name</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}"
                                required="required" />
                                @if ($errors->has('lastName'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('lastName') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{--  --}}{{--  --}}
                        <div class="col-sm-12 col-md-6 form-group{{ $errors->has('FirstNameInArabic') ? ' has-error' : '' }}">
                            <label for="email" class="form-control-label">First name in Arabic</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="FirstNameInArabic" value="{{ old('FirstNameInArabic') }}"
                                required="required" />
                                @if ($errors->has('FirstNameInArabic'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('FirstNameInArabic') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{--  --}}{{--  --}}
                        <div class="col-sm-12 col-md-6 form-group{{ $errors->has('LastNameInArabic') ? ' has-error' : '' }}">
                            <label for="email" class=" form-control-label">Last name in Arabic</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="LastNameInArabic" value="{{ old('LastNameInArabic') }}"
                                required="required" />
                                @if ($errors->has('LastNameInArabic'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('LastNameInArabic') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{--  --}}{{--  --}}
                        <div class="col-sm-12 col-md-6 form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                          <label for="name" class=" form-control-label">Country</label>
                          <div class="" >
                          <select name="country" class="form-control" onchange="yesnoCheck(this)">
                               @include('includes.countriesModal')
                        </select>
                        @if ($errors->has('country'))

                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('country') }}
                            </div>
                        @endif
                    </div>
                </div>
                {{--  --}}{{--  --}}
                <div id="palestineCity"  class="col-sm-12 col-md-6 form-group{{ $errors->has('cityName') ? ' has-error' : '' }}">
                    <label for="email" class=" form-control-label">City</label>
                    <div class="">
                        <select id="palC" name="cityName"  class="form-control">
                            @include('includes.citiesModal')
                        </select>
                        @if ($errors->has('cityName'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('cityName') }}
                            </div>
                        @endif
                    </div>
                </div>
                {{--  --}}{{--  --}}
                <div id="otherCity" style="display:none" class="col-sm-12 col-md-6 form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label for="email" class="form-control-label">City</label>
                    <div class="">
                        <input id="otherC" name="x"  type="text" class="form-control" value="{{ old('x') }}"
                         />
                        @if ($errors->has('x'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('x') }}
                            </div>
                        @endif
                    </div>
                </div>

@if(auth::user()->userType==0)

                {{--  --}}
                <div class="col-sm-12 col-md-6 form-group{{ $errors->has('dateOfBirth') ? ' has-error' : '' }}">
                    <label for="name" class=" form-control-label">Date of birth</label>
                    <div class="">
                        <input id="theDate" type="date" class="form-control" name="dateOfBirth"  min="" value="{{ old('dateOfBirth') }}" required="required"
                        />
                        @if ($errors->has('dateOfBirth'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('dateOfBirth') }}
                            </div>
                        @endif
                    </div>
                </div>

          <div class="col-sm-12 col-md-6 form-check form-check-inline">
            <label for="exampleInputEmail1">Gender</label><br />

            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male"  checked> Male
            </label>
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="female"> Female
            </label>

          </div>

                {{--  --}}

                {{--  --}}
              <div class="col-sm-12 col-md-6 form-group">
                    <label  class=" form-control-label" for="exampleSelect1">Current Work</label>
                <div class="">
                    <select name="currentWork" value="{{ old('currentWork') }}" class="form-control" id="exampleSelect1">
                    <option value="School Student">School Student</option>
                    <option value="University Student">University Student</option>
                    <option value="Governmental Employee">Governmental Employee</option>
                    <option value="Private sector Employee">Private sector Employee</option>
                    <option value="NGO Employee">NGO Employee</option>
                    <option value="Self-employed">Self-employed</option>
                    <option value="Business Owner">Business Owner</option>
                    <option value="Unemployed">Unemployed</option>
                    </select>
                </div>
                </div>
                {{--  --}}
                <div class="col-sm-12 col-md-6 form-group">
                    <label  class=" form-control-label" for="exampleSelect1">Educational level</label>
                <div class="">
                    <select name="educationalLevel" value="{{ old('educationalLevel') }}" class="form-control" id="exampleSelect1">
                    <option value="High School">High School</option>
                    <option value="BSc">BSc</option>
                    <option value="MSc">MSc</option>
                    <option value="Diploma">Diploma</option>
                    <option value="PhD">PhD</option>
                    </select>
                </div>
                </div>
                {{--  --}}
                <div class="col-sm-12 col-md-6 form-group">
                    <label  class=" form-control-label" for="exampleSelect1">Major Education Level</label>
                <div class="">
                    <select name="Major" value="{{ old('Major') }}" class="form-control" id="exampleSelect1">
                    <option value="BSc">IT</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Medicin">Medicine</option>
                    <option value="law">law</option>
                    <option value="Art">Art</option>
                    <option value="Business">Business</option>
                    <option value="Social Science">Social Science</option>
                    <option value="Litreture">Litreture</option>
                    <option value="etc..">etc..</option>
                    </select>
                </div>
                </div>
                {{--  --}}
                <div class="col-sm-12 col-md-6 form-group">
                    <label  class="form-control-label" for="exampleSelect1">Do you have volunteer Experience</label>
                <div class="">
                    <select name="preVoluntary" value="{{ old('preVoluntary') }}" class="form-control" id="vy" onchange="vyyesno(this)">
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
                    </select>
                </div>
                </div>
                {{--  --}}
                <div id="vyn" class="col-sm-12 col-md-6 form-group{{ $errors->has('voluntaryYears') ? ' has-error' : '' }}">
                    <label for="name" class="form-control-label">Voluntary Years</label>
                    <div class="">
                        <input id="name" type="text" class="form-control" name="voluntaryYears" value="{{ old('voluntaryYears') }}"
                       />
                        @if ($errors->has('voluntaryYears'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('voluntaryYears') }}
                            </div>
                        @endif
                    </div>
                </div>


            <div class="form-group col-sm-12 col-md-6 {{ $errors->has('mobileNumber') ? ' has-error' : '' }}">
                <label for="mobileNumber" class="form-control-label">Mobile Number</label>
                    <input id="mobileNumber" type="phone" class="form-control" name="mobileNumber" value="{{ old('mobileNumber') }}" required="required" />
                    @if ($errors->has('mobileNumber'))
                            <div class="alert alert-danger" role="alert">
                            <strong>Warning!</strong> {{ $errors->first('mobileNumber') }}
                         </div>
                    @endif
            </div>

@else


                        <div class="col-sm-12 col-md-6 form-check form-check-inline">
                        <label for="exampleInputEmail1">Place</label><br />
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="livingPlace" id="inlineRadio1" value="city" checked> City
                        </label>
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="livingPlace" id="inlineRadio1" value="camp"> Camp
                        </label>
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="livingPlace" id="inlineRadio1" value="village"> Village
                        </label>
                      </div>

                      <div class="col-sm-12 col-md-6 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="name" class=" form-control-label">Address</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="address" value="{{ old('address') }}"
                                required="required" />
                                @if ($errors->has('address'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('address') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 form-group{{ $errors->has('establishmentYear') ? ' has-error' : '' }}">
                    <label for="name" class=" form-control-label">Establishment Year</label>
                    <div class="">
                        <input id="theDate" type="date" class="form-control" name="establishmentYear"  min="" value="{{ old('establishmentYear') }}"
                        required="required" />
                        @if ($errors->has('establishmentYear'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('establishmentYear') }}
                            </div>
                        @endif
                    </div>
                </div>


                        <div class="col-sm-12 col-md-6 form-group{{ $errors->has('license') ? ' has-error' : '' }}">
                            <label for="email" class="form-control-label">The license number</label>
                            <div class="">
                                <input id="name" type="text" class="form-control" name="license" value="{{ old('license') }}"
                                required="required" />
                                @if ($errors->has('license'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Warning!</strong> {{ $errors->first('license') }}
                                    </div>

                                @endif
                            </div>
                        </div>

                        <div class="form-group col-sm-12 col-md-6 {{ $errors->has('mobileNumber') ? ' has-error' : '' }}">
                <label for="mobileNumber" class="form-control-label">Mobile Number</label>
                <div class="">
                    <input id="mobileNumber" type="phone" class="form-control" name="mobileNumber" value="{{ old('mobileNumber') }}" required="required" />
                    @if ($errors->has('mobileNumber'))
                            <div class="alert alert-danger" role="alert">
                            <strong>Warning!</strong> {{ $errors->first('mobileNumber') }}
                         </div>
                    @endif
                </div>
            </div>

@endif
              </div>

                {{--  --}}
                <div class="col-12" style="margin-top:20px;">
                  <h4 class="greencolor">Groups you would like to work with</h4>
                  <hr />
                </div>
                <br />
                        {{--  --}}
                        <div class="row">
                         @foreach($targets as $t)
                          <div class="form-check col-4">
                            <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                              <input name="targets[]" value="{{$t->id}}" type="checkbox" class="custom-control-input">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">{{$t->name}}</span>
                            </label>
                          </div>
                          @endforeach
                      </div>
                      @if ($errors->has('targets'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('targets') }}
                            </div>
                        @endif

                {{--  --}}
                <div class="col-12" style="margin-top:20px;">
                  <h4 class="greencolor">Intresets</h4>
                  <hr />
                </div>
                <br />
                        {{--  --}}
                        <div class="row">
                         @foreach($intrests as $i)
                          <div class="form-check col-4">
                            <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                              <input name="intrests[]" value="{{$i->id}}" type="checkbox" class="custom-control-input">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">{{$i->name}}</span>
                            </label>
                          </div>
                          @endforeach
                      </div>
                      @if ($errors->has('intrests'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong> {{ $errors->first('intrests') }}
                            </div>
                        @endif

                      <br />
                      <hr />
                      <br />

                        <div class="form-group">
                            <div class="col-md-3 offset-md-4 col-sm-12">
                                <button type="submit" class="btn btn-green btn-block">Register</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection

@section('scripts')

  <script type="text/javascript">

  function yesnoCheck(that) {
          if (that.value == "Palestine") {
              document.getElementById("palestineCity").style.display = "block";
              document.getElementById("otherCity").style.display = "none";
              $('#palC').attr('name', 'cityName');
              $('#otherC').attr('name', 'x');

          } else {
            document.getElementById("otherCity").style.display = "block";
            document.getElementById("palestineCity").style.display = "none";
            $('#otherC').attr('name', 'cityName');
            $('#palC').attr('name', 'x');

          }
      }
      function vyyesno(that) {
              if (that.value == "0") {
                  document.getElementById("vyn").style.display = "none";
              } else {
                document.getElementById("vyn").style.display = "block";
              }
          }
          </script>

 @endsection
