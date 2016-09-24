@extends('layout')

@section('header')
    <div class="page-header" style="margin-top: 15px;">
        <!-- <h1><i class="glyphicon glyphicon-plus"></i>Create </h1> -->
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12 center-block-transaction">

            <form action="{{ route('transactions.store') }}" method="POST" onsubmit="confirmComboValue()">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                  <div class="form-group @if($errors->has('type_id')) has-error @endif" style="text-align: center">
                     <!-- <label for="type_id-field">Type</label> -->
                      <div class="alert alert-sm alert-danger col-xs-4">
                        {!! Form::radio('type_id', 1, true, ['class'=>'type_id']) !!} <i class="glyphicon glyphicon-arrow-up"></i>
                      </div>
                      <div class="alert alert-sm alert-success col-xs-4">                        
                        {!! Form::radio('type_id', 2, old("type_id"), ['class'=>'type_id']) !!} <i class="glyphicon glyphicon-arrow-down"></i>
                      </div>
                      <div class="alert alert-sm alert-info col-xs-4">
                        {!! Form::radio('type_id', 3, old("type_id"), ['class'=>'type_id']) !!} <i class="glyphicon glyphicon-random"></i>
                      </div>
                     
                     <!-- <input type=text id="type_id-field" name="type_id" class="form-control form-control-custom" value="{{ old("type_id") }}"/> -->
                     @if($errors->has("type_id"))
                      <span class="help-block">{{ $errors->first("type_id") }}</span>
                     @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-xs-6 @if($errors->has('date')) has-error @endif">
                     <label for="date-field" class="sr-only">Date</label>
                     <input type="text" id="date-field" name="date" class="form-control form-control-custom" value="{{ date('d/m/Y') }}" placeholder="Date"/>
                     @if($errors->has("date"))
                      <span class="help-block">{{ $errors->first("date") }}</span>
                     @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('amount')) has-error @endif">
                     <label for="amount-field" class="sr-only">Amount</label>
                     <input type="text" id="amount-field" name="amount" class="form-control form-control-custom" value="{{ old("amount") }}" placeholder="Amount"/>
                     @if($errors->has("amount"))
                      <span class="help-block">{{ $errors->first("amount") }}</span>
                     @endif
                  </div>
                </div>

                <div class="row category-dv">
                  <div class="form-group col-xs-6 @if($errors->has('category_id')) has-error @endif">
                    <label class="sr-only" for="category_id-field">Category</label>
                    <div class="">
                      {!! Form::select('category_id', $categories, old("category_id"), ['id' => 'category_id', 'class'=>'form-control form-control-custom']) !!}
                    </div>
                    <!-- <input type=text id="category_id-field" name="category_id" class="form-control form-control-custom" value="{{ old("category_id") }}"/> -->
                    @if($errors->has("category_id"))
                    <span class="help-block">{{ $errors->first("category_id") }}</span>
                    @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('subcategory_id')) has-error @endif">
                    <label class="sr-only" for="subcategory_id-field">Subcategory</label>
                    <div class="">
                      {!! Form::select('subcategory_id', ['',''], '', ['id' => 'subcategory_id', 'class'=>'form-control form-control-custom']) !!} <!-- , $subcategories->prepend(''), old("subcategory_id") -->
                    </div>
                    <!-- <input type=text id="subcategory_id-field" name="subcategory_id" class="form-control form-control-custom" value="{{ old("subcategory_id") }}"/> -->
                    @if($errors->has("subcategory_id"))
                    <span class="help-block">{{ $errors->first("subcategory_id") }}</span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-xs-6 @if($errors->has('account_id')) has-error @endif">
                    <label class="sr-only col-xs-4" for="account_id-field">Account</label>
                    <div style="padding-right: 13px;" class="row">
                      <div class="col-xs-12" style="padding: 0px 2px 0px 15px;">
                        {!! Form::select('account_id', $accounts, old("account_id"), ['id' => 'account_id', 'class'=>'form-control form-control-custom']) !!}
                      </div>
                      <div class="col-xs-3" style="padding: 0px 0px 0px 2px;">
                        {!! Form::select('allotment', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12], 1, ['id' => 'allotment', 'class'=>'form-control form-control-custom']) !!}
                      </div>
                    </div>
                    <!-- <input type=text id="account_id-field" name="account_id" class="form-control form-control-custom" value="{{ old("account_id") }}"/> -->
                    @if($errors->has("account_id"))
                    <span class="help-block">{{ $errors->first("account_id") }}</span>
                    @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('accountto_id')) has-error @endif" id="accountto-dv">
                    <label class="sr-only col-xs-4" for="accountto_id-field">Account to</label>
                    <div class="">
                      {!! Form::select('accountto_id', $accounts, old("accountto_id"), ['id' => 'accountto_id', 'class'=>'form-control form-control-custom']) !!}
                    </div>
                    <!-- <input type=text id="accountto_id-field" name="accountto_id" class="form-control form-control-custom" value="{{ old("accountto_id") }}"/> -->
                    @if($errors->has("accountto_id"))
                    <span class="help-block">{{ $errors->first("accountto_id") }}</span>
                    @endif
                  </div>

                  <div class="form-group col-xs-6 @if($errors->has('vendor_id')) has-error @endif" id="vendor-dv">
                    <label class="sr-only col-xs-4" for="vendor_id-field">Vendor</label>
                    <div class="">
                      <div id="vendor_id" class="form-control form-control-custom"></div>
                      <!-- {!! Form::select('vendor_id', $vendors, old("vendor_id")) !!} -->
                    </div>
                    <!-- <input type=text id="vendor_id-field" name="vendor_id" class="form-control form-control-custom" value="{{ old("vendor_id") }}"/> -->
                    @if($errors->has("vendor_id"))
                    <span class="help-block">{{ $errors->first("vendor_id") }}</span>
                    @endif
                  </div>
                </div>

                <div class="row" id="due">
                  <div class="form-group col-xs-6 @if($errors->has('due_month')) has-error @endif">
                    <label for="due_month-field" class="sr-only">Due month</label>
                    {!! Form::select('due_month', Config::get('constants.MONTHS'), date('m'), ['class'=>'form-control form-control-custom', 'id'=>'due_month-field']) !!}
                    <!-- <input type=text id="due_month-field" name="due_month" class="form-control form-control-custom" value="{{ old("due_month") }}"/> -->
                    @if($errors->has("due_month"))
                    <span class="help-block">{{ $errors->first("due_month") }}</span>
                    @endif
                  </div>
                  <div class="form-group col-xs-6 @if($errors->has('due_year')) has-error @endif">
                    <label for="due_year-field" class="sr-only">Due year</label>
                    {!! Form::select('due_year', Config::get('constants.YEARS'), date('Y'), ['class'=>'form-control form-control-custom', 'id'=>'due_year-field']) !!}
                    <!-- <input type=text id="due_year-field" name="due_year" class="form-control form-control-custom" value="{{ old("due_year") }}"/> -->
                    @if($errors->has("due_year"))
                    <span class="help-block">{{ $errors->first("due_year") }}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group @if($errors->has('note')) has-error @endif">
                   <label class="sr-only" for="note-field">Note</label>
                   <textarea class="form-control form-control-custom" id="note-field" rows="3" name="note" placeholder="Note">{{ old("note") }}</textarea>
                   @if($errors->has("note"))
                    <span class="help-block">{{ $errors->first("note") }}</span>
                   @endif
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                      <a role="button" href="#collapseBm" class="collapsed" data-toggle="collapse" aria-controls="collapseBm" aria-expanded="false">Bookmarks</a>
                    </h3>
                  </div>
                  <div class="panel-body panel-collapse collapse" id="collapseBm" aria-expanded="false" role="tabpanel">
                      @foreach($bookmarks as $bookmark)
                      <a class="bm-buttom" href="#">
                        <div class="alert alert-custom alert-info pull-left" role="alert">
                          <small class="pull-left">{{ $bookmark->vendor->vendor or '' }}</small>
                          <p class="pull-right" style="margin-left: 7px;">
                            <?php
                                switch ($bookmark->type_id) {
                                  case '1':
                                    echo '<i class="glyphicon glyphicon-arrow-up"></i>';
                                    break;
                                  
                                  case '2':
                                    echo '<i class="glyphicon glyphicon-arrow-down"></i>';
                                    break;

                                  case '3':
                                    echo '<i class="glyphicon glyphicon-random"></i>';
                                    break;
                                }
                            ?>
                          </p>
                          <div class="clearfix"></div>
                          <p class="text-center"><small><strong>{{ $bookmark->category->category or '' }}</strong></small></p>
                          <small>{{ $bookmark->subcategory->subcategory or '' }}</small><br>
                          <small><em>{{ $bookmark->account->account or '' }}</em></small>
                          @if($bookmark->accountto_id)
                            <small><em>{{ " &nbsp;>> ". $bookmark->accountto->account }}</em></small>
                          @endif                          
                          <input type="hidden" class="bm" value="{{ $bookmark }}">
                        </div>
                      </a>
                      @endforeach
                  </div>
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('transactions.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
      $(document).ready(function($){
        verifyType($('.type_id:checked'));
        verifyTransfer($('.type_id:checked'));

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

        // Bookmark buttom event
        $('.bm-buttom').click(function(e){
          e.preventDefault();
          var jsonData = JSON.parse($(this).children(0).children('.bm').val());
          myCombo.setComboValue(jsonData.vendor_id);
          $('#amount-field').val((jsonData.amount < 0) ? (jsonData.amount * -1).toFixed(2) : jsonData.amount).focus();
          $('.type_id[value='+ jsonData.type_id +']').prop('checked', true);
          $('#account_id').val(jsonData.account_id);
          $('#accountto_id').val(jsonData.accountto_id);
          $('#category_id').val(jsonData.category_id);
          var subcat_id = jsonData.subcategory_id;
          loadSubcategories($('#category_id'), ((subcat_id == '') ? 'undefined' : subcat_id));
          $('#note-field').val(jsonData.note);

          verifyTransfer($('.type_id:checked'));
          verifyAccount();

          $('.panel-title a').click();
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