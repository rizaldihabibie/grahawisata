@extends('layouts.MasterLogin')
@section('content')
        <div class="login-box animated fadeInDown">
            <div class="login-body">
                    <div class="login-title">Welcome, <strong> {{$FormTitle}} </strong></div>
                 <form method="POST" action="{{ url('do_login') }}">
                        {{ csrf_field() }}
                    <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required/>
                    </div>

                    <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required/>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <div class="pull-left">
                    &copy; themeforest
                </div>
                <div class="pull-right">
                    <a href="#">About</a> |
                    <a href="#">Contact Us</a>
                </div>
            </div>
        </div>
@stop


@section('supportjs')
	
@stop