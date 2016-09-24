@extends('layout')
@section('header')
<div class="page-header">
        <h1>ImporterHelpers / Show #{{$importer_helper->id}}</h1>
        <form action="{{ route('importer_helpers.destroy', $importer_helper->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('importer_helpers.edit', $importer_helper->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                     <label for="description">DESCRIPTION</label>
                     <p class="form-control-static">{{$importer_helper->description}}</p>
                </div>
                    <div class="form-group">
                     <label for="category_id">CATEGORY_ID</label>
                     <p class="form-control-static">{{$importer_helper->category_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="category_id">CATEGORY_ID</label>
                     <p class="form-control-static">{{$importer_helper->category_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="subcategory_id">SUBCATEGORY_ID</label>
                     <p class="form-control-static">{{$importer_helper->subcategory_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="subcategory_id">SUBCATEGORY_ID</label>
                     <p class="form-control-static">{{$importer_helper->subcategory_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="vendor_id">VENDOR_ID</label>
                     <p class="form-control-static">{{$importer_helper->vendor_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="vendor_id">VENDOR_ID</label>
                     <p class="form-control-static">{{$importer_helper->vendor_id}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('importer_helpers.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection