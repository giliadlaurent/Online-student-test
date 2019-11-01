@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="row ">
       
       <div class="panel panel-default ">
           <div class="panel-body border ">
               <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 hidden-xs">
            <img src="{{asset('images/test.gif')}}" class="img-responsive" alt="Image">
        </div>
       
        <div class="col-sm-4 ">
               
            <div class="">

                  <br><br><br><br>
                  
                 <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                         <!-- <div class="panel panel-primary hidden-xs">
                             <div class="panel-heading">
                                 <h3 class="panel-title">Login To Tests</h3>
                             </div> -->
                            
                         </div>
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <h3 class="panel-title">
                                <span class="glyphicon glyphicon-globe" aria-hidden="true"> LoginTakeTest</span>
                            </h3>
                          </div>
                      </div>
                        <div class="panel panel-primary col-sm-12"><br>

                            <div class="panel-body sticky-top">
                           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label"></label>
                            
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus  placeholder="Eg-T/UDOM/2002/0111">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label"></label>

                                <input id="password" type="password" class="form-control" name="password" placeholder="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif <br>
                                 <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>
                        </div>

                        <div class="form-group sr-only">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group sr-only">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                                <a class="btn btn-link sr-only" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
           </div>
       </div>
       
    </div>
</div>
@endsection
