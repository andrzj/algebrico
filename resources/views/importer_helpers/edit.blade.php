@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> ImporterHelpers / Edit #{{$importer_helper->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('importer_helpers.update', $importer_helper->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group @if($errors->has('description')) has-error @endif">
                    <label for="description-field">Description</label>
                    <input type="text" id="description-field" name="description" class="form-control" value="{{ $importer_helper->description }}"/>
                    @if($errors->has("description"))
                    <span class="help-block">{{ $errors->first("description") }}</span>
                    @endif
                </div>
<div class="form-group @if($errors->has('category_id')) has-error @endif">
    <label for="category_id-field">Category_id</label>
    <input type="text" id="category_id-field" name="category_id" class="form-control" value="{{ $importer_helper->category_id }}"/>
    @if($errors->has("category_id"))
    <span class="help-block">{{ $errors->first("category_id") }}</span>
    @endif
</div>
<div class="form-group @if($errors->has('subcategory_id')) has-error @endif">
    <label for="subcategory_id-field">Subcategory_id</label>
    <input type="text" id="subcategory_id-field" name="subcategory_id" class="form-control" value="{{ $importer_helper->subcategory_id }}"/>
    @if($errors->has("subcategory_id"))
    <span class="help-block">{{ $errors->first("subcategory_id") }}</span>
    @endif
</div>
<div class="form-group @if($errors->has('vendor_id')) has-error @endif">
    <label for="vendor_id-field">Vendor_id</label>
    <input type="text" id="vendor_id-field" name="vendor_id" class="form-control" value="{{ $importer_helper->vendor_id }}"/>
    @if($errors->has("vendor_id"))
    <span class="help-block">{{ $errors->first("vendor_id") }}</span>
    @endif
</div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('importer_helpers.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection