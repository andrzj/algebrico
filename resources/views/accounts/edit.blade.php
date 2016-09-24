@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Accounts / Edit >> {{$account->account}}</h1>
    </div>
    @if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('accounts.update', $account->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('account')) has-error @endif">
                       <label for="account-field">Account</label>
                    <input type="text" id="account-field" name="account" class="form-control" value="{{ $account->account }}"/>
                       @if($errors->has("account"))
                        <span class="help-block">{{ $errors->first("account") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('balance')) has-error @endif">
                       <label for="balance-field">Balance</label>
                    <input type="text" id="balance-field" name="balance" class="form-control" value="{{ $account->balance }}"/>
                       @if($errors->has("balance"))
                        <span class="help-block">{{ $errors->first("balance") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <input type="submit" class="btn btn-primary" name="saveButton" value="Save"/>
                    <input type="submit" class="btn btn-warning" name="recalculateButton" value="Recalculate balance"/>
                    <a class="btn btn-link pull-right" href="{{ route('accounts.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection