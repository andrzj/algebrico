@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Accounts / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('accounts.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('account')) has-error @endif">
                       <label for="account-field">Account</label>
                    <input type="text" id="account-field" name="account" class="form-control" value="{{ old("account") }}"/>
                       @if($errors->has("account"))
                        <span class="help-block">{{ $errors->first("account") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('balance')) has-error @endif">
                       <label for="balance-field">Balance</label>
                    <input type="text" id="balance-field" name="balance" class="form-control" value="{{ old("balance") }}"/>
                       @if($errors->has("balance"))
                        <span class="help-block">{{ $errors->first("balance") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('accounts.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection