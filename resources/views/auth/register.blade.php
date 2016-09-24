@extends('layout')

@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-pencil"></i> Register </h1>
</div>
@if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif
{!! HTML::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
@endsection
@section('content')
<div class="row">
    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}
        <div class="row">
            <div class="form-group col-xs-6">
                <label for="name-field" class="sr-only">Name</label>
                <input id="name-field" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name" type="text">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-6">
                <label for="email-field" class="sr-only">E-mail</label>
                <input id="email-field" name="email" class="form-control" value="{{ old('email') }}" placeholder="E-mail" type="email">
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
                <label for="password-field" class="sr-only">Confirm Password</label>
                <input id="password-field" name="password_confirmation" class="form-control" value="" placeholder="Confirm Password" type="password">
            </div>
        </div>

        <div class="row col-xs-6">
            <button type="submit" class="btn btn-default">Register</button>
        </div>
    </form>
</div>
@endsection