@extends('layout')

@section('header')
    <div class="page-header" style="margin-top: 15px;">
        <!-- <h1><i class="glyphicon glyphicon-edit"></i> Transactions / Edit #{{$transaction->id}}</h1> -->
    </div>
    @if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" onsubmit="confirmComboValue()">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                  <div class="form-group @if($errors->has('type_id')) has-error @endif" style="text-align: center">
                     <!-- <label for="type_id-field">Type</label> -->
                      <div class="alert alert-sm alert-danger col-xs-4">
                        {!! Form::radio('type_id', 1, true, ['class'=>'type_id']) !!} <i class="glyphicon glyphicon-arrow-up"></i>
                      </div>
                      <div class="alert alert-sm alert-success col-xs-4">                        
                        {!! Form::radio('type_id', 2, false, ['class'=>'type_id']) !!} <i class="glyphicon glyphicon-arrow-down"></i>
                      </div>
                      <div class="alert alert-sm alert-info col-xs-4">
                        {!! Form::radio('type_id', 3, false, ['class'=>'type_id']) !!} <i class="glyphicon glyphicon-random"></i>
                      </div>
                     
                     <!-- <input type="text" id="type_id-field" name="type_id" class="form-control form-control-custom" value="{{ old("type_id") }}"/> -->
                     @if($errors->has("type_id"))
                      <span class="help-block">{{ $errors->first("type_id") }}</span>
                     @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-xs-6 @if($errors->has('date')) has-error @endif">
                     <label for="date-field" class="sr-only">Date</label>
                     <input type="text" id="date-field" name="date" class="form-control form-control-custom" value="{{ date("d/m/Y", strtotime($transaction->date)) }}" placeholder="Date"/>
                     @if($errors->has("date"))
                      <span class="help-block">{{ $errors->first("date") }}</span>
                     @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('amount')) has-error @endif">
                     <label for="amount-field" class="sr-only">Amount</label>
                     <input type="text" id="amount-field" name="amount" class="form-control form-control-custom" value="@if($transaction->amount < 0) {{number_format($transaction->amount * -1, 2)}} @else {{$transaction->amount}} @endif" placeholder="Amount"/>
                     @if($errors->has("amount"))
                      <span class="help-block">{{ $errors->first("amount") }}</span>
                     @endif
                  </div>
                </div>

                <div class="row category-dv">
                  <div class="form-group col-xs-6 @if($errors->has('category_id')) has-error @endif">
                    <label class="sr-only" for="category_id-field">Category</label>
                    <div class="">
                      {!! Form::select('category_id', $categories, $transaction->category_id, ['id' => 'category_id', 'class'=>'form-control form-control-custom']) !!}
                    </div>
                    <!-- <input type="text" id="category_id-field" name="category_id" class="form-control form-control-custom" value="{{ old("category_id") }}"/> -->
                    @if($errors->has("category_id"))
                    <span class="help-block">{{ $errors->first("category_id") }}</span>
                    @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('subcategory_id')) has-error @endif">
                    <label class="sr-only" for="subcategory_id-field">Subcategory</label>
                    <div class="">
                      {!! Form::select('subcategory_id', ['',''], '', ['id' => 'subcategory_id', 'class'=>'form-control form-control-custom']) !!} <!-- , $subcategories->prepend(''), old("subcategory_id") -->
                    </div>
                    <!-- <input type="text" id="subcategory_id-field" name="subcategory_id" class="form-control form-control-custom" value="{{ old("subcategory_id") }}"/> -->
                    @if($errors->has("subcategory_id"))
                    <span class="help-block">{{ $errors->first("subcategory_id") }}</span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-xs-6 @if($errors->has('account_id')) has-error @endif">
                    <label class="col-xs-4 sr-only" for="account_id-field">Account</label>
                    <div class="">
                      {!! Form::select('account_id', $accounts, $transaction->account_id, ['id' => 'account_id', 'class'=>'form-control form-control-custom']) !!}
                    </div>
                    <!-- <input type="text" id="account_id-field" name="account_id" class="form-control form-control-custom" value="{{ old("account_id") }}"/> -->
                    @if($errors->has("account_id"))
                    <span class="help-block">{{ $errors->first("account_id") }}</span>
                    @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('accountto_id')) has-error @endif" id="accountto-dv">
                    <label class="col-xs-4 sr-only" for="accountto_id-field">Account to</label>
                    <div class="">
                      {!! Form::select('accountto_id', $accounts, $transaction->accountto_id, ['id' => 'accountto_id', 'class'=>'form-control form-control-custom']) !!}
                    </div>
                    <!-- <input type="text" id="accountto_id-field" name="accountto_id" class="form-control form-control-custom" value="{{ old("accountto_id") }}"/> -->
                    @if($errors->has("accountto_id"))
                    <span class="help-block">{{ $errors->first("accountto_id") }}</span>
                    @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('vendor_id')) has-error @endif" id="vendor-dv">
                    <label class="col-xs-4 sr-only" for="vendor_id-field">Vendor</label>
                    <div class="">
                      <div id="vendor_id" class="form-control form-control-custom"></div>
                      <!-- {!! Form::select('vendor_id', $vendors, $transaction->vendor_id) !!} -->
                    </div>
                    <!-- <input type="text" id="vendor_id-field" name="vendor_id" class="form-control form-control-custom" value="{{ old("vendor_id") }}"/> -->
                    @if($errors->has("vendor_id"))
                    <span class="help-block">{{ $errors->first("vendor_id") }}</span>
                    @endif
                  </div>
                </div>

                <div class="row" id="due">
                  <div class="form-group col-xs-6 @if($errors->has('due_month')) has-error @endif">
                    <label for="due_month-field" class="sr-only">Due month</label>
                    {!! Form::select('due_month', Config::get('constants.MONTHS'), $transaction->due_month, ['class'=>'form-control form-control-custom', 'id'=>'due_month-field']) !!}
                    <!-- <input type="text" id="due_month-field" name="due_month" class="form-control form-control-custom" value="{{ old("due_month") }}"/> -->
                    @if($errors->has("due_month"))
                    <span class="help-block">{{ $errors->first("due_month") }}</span>
                    @endif
                  </div>
                  <div class="form-group col-xs-6 @if($errors->has('due_year')) has-error @endif">
                    <label for="due_year-field" class="sr-only">Due year</label>
                    {!! Form::select('due_year', Config::get('constants.YEARS'), $transaction->due_year, ['class'=>'form-control form-control-custom', 'id'=>'due_year-field']) !!}
                    <!-- <input type="text" id="due_year-field" name="due_year" class="form-control form-control-custom" value="{{ old("due_year") }}"/> -->
                    @if($errors->has("due_year"))
                    <span class="help-block">{{ $errors->first("due_year") }}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group @if($errors->has('note')) has-error @endif">
                   <label for="note-field" class="sr-only">Note</label>
                   <textarea class="form-control form-control-custom" id="note-field" rows="3" name="note" placeholder="Note">{{ $transaction->note }}</textarea>
                   @if($errors->has("note"))
                    <span class="help-block">{{ $errors->first("note") }}</span>
                   @endif
                </div>

                <div class="well well-sm">
                    <input type="submit" class="btn btn-primary" name="transactionButton" value="Save"/>
                    <input type="submit" class="btn btn-warning" name="bookmarkButton" value="Save as Bookmark"/>
                    <a class="btn btn-link pull-right" href="{{ route('transactions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
      $(document).ready(function($){
        // load subcategories and select the value from database
        var subcat_id = '{{$transaction->subcategory_id}}';
        loadSubcategories($('#category_id'), ((subcat_id == '') ? 'undefined' : subcat_id));
        // select value from database
        $('.type_id[value={{$transaction->type_id}}]').prop('checked', true);
        if('{{$transaction->type_id}}' == 3){
          $('.type_id[value=1]').attr('disabled', 'disabled');
          $('.type_id[value=2]').attr('disabled', 'disabled');
        } else {
          $('.type_id[value=3]').attr('disabled', 'disabled')
        }
        // 
        verifyTransfer($('.type_id:checked'));
        // aplies mask on field with value loaded
        $('#amount-field').maskMoney('mask');

        myCombo = new dhtmlXCombo("vendor_id", "vendor_id", 160);
        myCombo.enableFilteringMode("between");
        myCombo.setSkin("dhx_web");
        myCombo.load("{!! addslashes("{options:".$vendors."}") !!}", function(){
          myCombo.setComboValue({!!$transaction->vendor_id!!});
        });
        myCombo.attachEvent("onChange", function(value, text){
          $.getJSON('/api/vendorCatSub', { 'id': value }, 
          function(data) {
            if(data.c){
              $('#category_id').val(data.c);
              loadSubcategories($('#category_id'), ((data.s == '') ? 'undefined' : data.s));            
            }
          });
        });

        // Input date change event
        $('#date-field').change(function() {
          
          var m = parseInt($(this).val().split('/')[1]);
          $('#due_month-field').val((m == 12) ? 01 : m + 1);
          var y = parseInt($(this).val().split('/')[2]);
          $('#due_year-field').val((m == 12) ? y + 1 : y);
        });

      });
 
      function confirmComboValue(){
           myCombo.confirmValue();
       }
    </script>
@endsection