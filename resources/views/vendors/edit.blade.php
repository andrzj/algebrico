@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Vendors / Edit #{{$vendor->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('vendor')) has-error @endif">
                       <label for="vendor-field">Vendor</label>
                    <input type="text" id="vendor-field" name="vendor" class="form-control" value="{{ $vendor->vendor }}"/>
                       @if($errors->has("vendor"))
                        <span class="help-block">{{ $errors->first("vendor") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('vendors.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection