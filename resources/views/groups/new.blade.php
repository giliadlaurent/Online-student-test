@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash')
        @include('shared.validation-errors')

        <br>
       <div class="panel panel-default">
           <div class="panel-heading">
               <h3 class="panel-title">@lang('language.group')</h3>
           </div>
           <div class="panel-body">
                 @if(auth()->user()->isAdministrator())
        <form method="POST" action="{{ action('GroupController@newGroup') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required maxlength="255" placeholder="Name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
             <a href="/admin" type="submit" class="btn btn-danger pull-right">back</a>
        </form>

        @endif
           </div>
       </div>
    </div>
</div>


@stop