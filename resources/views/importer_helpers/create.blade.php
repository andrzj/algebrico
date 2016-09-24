@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> ImporterHelpers / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('importer_helpers.store') }}" method="POST" onsubmit="confirmComboValue()">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group @if($errors->has('description')) has-error @endif">
                    <label for="description-field">Description</label>
                    <input type="text" id="description-field" name="description" class="form-control" value="{{ old("description") }}"/>
                    @if($errors->has("description"))
                    <span class="help-block">{{ $errors->first("description") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('category_id')) has-error @endif">
                    <label class="sr-only" for="category_id-field">Category</label>
                    <div class="">
                      {!! Form::select('category_id', $categories, old("category_id"), ['id' => 'category_id', 'class'=>'form-control form-control-custom']) !!}
                    </div>
                    @if($errors->has("category_id"))
                    <span class="help-block">{{ $errors->first("category_id") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('subcategory_id')) has-error @endif">
                    <label class="sr-only" for="subcategory_id-field">Subcategory</label>
                    <div class="">
                      {!! Form::select('subcategory_id', ['',''], '', ['id' => 'subcategory_id', 'class'=>'form-control form-control-custom']) !!}
                    </div>
                    @if($errors->has("subcategory_id"))
                    <span class="help-block">{{ $errors->first("subcategory_id") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('vendor_id')) has-error @endif">
                    <label class="sr-only col-xs-4" for="vendor_id-field">Vendor</label>
                    <div class="">
                      <div id="vendor_id" class="form-control form-control-custom"></div>
                    </div>
                    @if($errors->has("vendor_id"))
                    <span class="help-block">{{ $errors->first("vendor_id") }}</span>
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('importer_helpers.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
      $(document).ready(function($){
        $('#category_id').val("2").change()

        myCombo = new dhtmlXCombo("vendor_id", "vendor_id");
        myCombo.enableFilteringMode("between");
        myCombo.setSkin("dhx_web");
        myCombo.load("{!!addslashes("{options:".$vendors."}")!!}", function(){});
        myCombo.attachEvent("onChange", function(value, text){
          $.getJSON('/api/vendorCatSub', { 'id': value }, 
          function(data) {
            if(data.c){
              $('#category_id').val(data.c);
              loadSubcategories($('#category_id'), ((data.s == '') ? 'undefined' : data.s));            
            }
          });
        });
      });

      function confirmComboValue(){
           myCombo.confirmValue();
       }
     </script>
@endsection