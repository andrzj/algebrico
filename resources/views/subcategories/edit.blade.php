@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Subcategories / Edit #{{$subcategory->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('category_id')) has-error @endif">
                    <label for="category_id-field">Category</label>
                    {!! Form::select('category_id', $categories, $subcategory->category_id, ['id' => 'category_id-field', 'class'=>'form-control']) !!}
                    <!-- <input type="text" id="category_id-field" name="category_id" class="form-control" value="{{ $subcategory->category_id }}"/> -->
                   @if($errors->has("category_id"))
                    <span class="help-block">{{ $errors->first("category_id") }}</span>
                   @endif
                </div>
                <div class="form-group @if($errors->has('subcategory')) has-error @endif">
                    <label for="subcategory-field">Subcategory</label>
                    <input type="text" id="subcategory-field" name="subcategory" class="form-control" value="{{ $subcategory->subcategory }}"/>
                       @if($errors->has("subcategory"))
                        <span class="help-block">{{ $errors->first("subcategory") }}</span>
                       @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('subcategories.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection