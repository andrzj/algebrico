@extends('layout')
@section('header')
<div class="page-header">
        <h1>Bookmarks / Show #{{$bookmark->id}}</h1>
        <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('bookmarks.edit', $bookmark->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                     <label for="account_id">ACCOUNT_ID</label>
                     <p class="form-control-static">{{$bookmark->account_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="category_id">CATEGORY_ID</label>
                     <p class="form-control-static">{{$bookmark->category_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="subcategory_id">SUBCATEGORY_ID</label>
                     <p class="form-control-static">{{$bookmark->subcategory_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="type_id">TYPE_ID</label>
                     <p class="form-control-static">{{$bookmark->type_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="vendor_id">VENDOR_ID</label>
                     <p class="form-control-static">{{$bookmark->vendor_id}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('bookmarks.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection