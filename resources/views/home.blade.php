@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    {{Auth::guest()}} </br>
                    {{Auth::check()}} </br>
                     <label> username as &nbsp; </label>{{ Auth::user()->username}}</br>
                     <label> privilege as &nbsp;  </label>{{ Auth::user()->privilege}}</br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
