@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Bookmarks / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('bookmarks.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('account_id')) has-error @endif">
                       <label for="account_id-field">Account_id</label>
                    <input type="text" id="account_id-field" name="account_id" class="form-control" value="{{ old("account_id") }}"/>
                       @if($errors->has("account_id"))
                        <span class="help-block">{{ $errors->first("account_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('category_id')) has-error @endif">
                       <label for="category_id-field">Category_id</label>
                    <input type="text" id="category_id-field" name="category_id" class="form-control" value="{{ old("category_id") }}"/>
                       @if($errors->has("category_id"))
                        <span class="help-block">{{ $errors->first("category_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('subcategory_id')) has-error @endif">
                       <label for="subcategory_id-field">Subcategory_id</label>
                    <input type="text" id="subcategory_id-field" name="subcategory_id" class="form-control" value="{{ old("subcategory_id") }}"/>
                       @if($errors->has("subcategory_id"))
                        <span class="help-block">{{ $errors->first("subcategory_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('type_id')) has-error @endif">
                       <label for="type_id-field">Type_id</label>
                    <input type="text" id="type_id-field" name="type_id" class="form-control" value="{{ old("type_id") }}"/>
                       @if($errors->has("type_id"))
                        <span class="help-block">{{ $errors->first("type_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('vendor_id')) has-error @endif">
                       <label for="vendor_id-field">Vendor_id</label>
                    <input type="text" id="vendor_id-field" name="vendor_id" class="form-control" value="{{ old("vendor_id") }}"/>
                       @if($errors->has("vendor_id"))
                        <span class="help-block">{{ $errors->first("vendor_id") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('bookmarks.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection