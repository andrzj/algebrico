@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> <!-- Transactions -->
        </h1>
        @if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection

@section('content')
    {!! Form::open(array('url'=>'/importer/process','method'=>'POST', 'files'=>true)) !!}
    <div class="row">
        <!-- <form action="/importer/process" method="POST"> -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-xs-6 col-md-4">
            {!! Form::select('account_id', $accounts, old("account_id"), ['id' => 'account_id', 'class'=>'form-control form-control-custom']) !!}
        </div>
        <div class="form-group col-xs-6 col-md-2">
            <div class="input-group">
               <span class="input-group-addon">{!! Form::checkbox('is_credit_card', 'false', false, ['id' => 'is_credit_card', 'class'=>'']) !!}</span>
               <span class="form-control form-control-custom">Cart&atilde;o de cr&eacute;dito</span>
            </div>
        </div>
        <div class="form-group col-xs-6 col-md-4 form-hide-cc">
            {!! Form::select('due_month', Config::get('constants.MONTHS'), date('n'), ['class'=>'form-control form-control-custom']) !!}
        </div>
        <div class="form-group col-xs-6 col-md-2 form-hide-cc">
            {!! Form::select('due_year', Config::get('constants.YEARS'), date('Y'), ['class'=>'form-control form-control-custom']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12">
            {!! Form::label('Extrato') !!}
            {!! Form::file('file', null) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-2">
            <input type="submit" class="btn btn-primary" name="processButton" value="Process" />
        </div>
        <!-- </form> -->
    </div>
    {!! Form::close() !!}
@endsection

@section('footer')
    <script>
        $(document).ready(function($){

            $('#is_credit_card').change(function() {
                $('.form-hide-cc').toggle();
                if ($('.form-hide-cc').is(':hidden')){
                    $(this).val('false');
                }
                else{
                    $(this).val('true');
                }
                
            });

        });
     </script>
@endsection