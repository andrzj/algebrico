@extends('layout')

@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-lock"></i> Login </h1>
</div>
@if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif
{!! HTML::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
@endsection
@section('content')
<div class="row">
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <div class="row">
            <div class="form-group col-xs-6">
                <label for="email-field" class="sr-only">E-mail</label>
                <input id="email-field" name="email" class="form-control" value="" placeholder="E-mail" type="email">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-6">
                <label for="password-field" class="sr-only">Password</label>
                <input id="password-field" name="password" class="form-control" value="" placeholder="Password" type="password">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-6">
                <input type="checkbox" name="remember"> Remember Me
            </div>
        </div>

        <div class="row col-xs-6">
            <button type="submit" class="btn btn-default">Login</button>
        </div>
    </form>
</div>
@endsection