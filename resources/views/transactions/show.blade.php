@extends('layout')
@section('header')
<div class="page-header">
        <h1>Transactions / Show #{{$transaction->id}}</h1>
        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('transactions.edit', $transaction->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                     <label for="amount">AMOUNT</label>
                     <p class="form-control-static">{{$transaction->amount}}</p>
                </div>
                    <div class="form-group">
                     <label for="account_id">ACCOUNT_ID</label>
                     <p class="form-control-static">{{$transaction->account_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="accountto_id">ACCOUNTTO_ID</label>
                     <p class="form-control-static">{{$transaction->accountto_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="category_id">CATEGORY_ID</label>
                     <p class="form-control-static">{{$transaction->category_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="subcategory_id">SUBCATEGORY_ID</label>
                     <p class="form-control-static">{{$transaction->subcategory_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="type_id">TYPE_ID</label>
                     <p class="form-control-static">{{$transaction->type_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="vendor_id">VENDOR_ID</label>
                     <p class="form-control-static">{{$transaction->vendor_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="date">DATE</label>
                     <p class="form-control-static">{{$transaction->date}}</p>
                </div>
                    <div class="form-group">
                     <label for="due_month">DUE_MONTH</label>
                     <p class="form-control-static">{{$transaction->due_month}}</p>
                </div>
                    <div class="form-group">
                     <label for="due_year">DUE_YEAR</label>
                     <p class="form-control-static">{{$transaction->due_year}}</p>
                </div>
                    <div class="form-group">
                     <label for="note">NOTE</label>
                     <p class="form-control-static">{{$transaction->note}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('transactions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection