@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> <!-- Transactions -->
            <a class="btn btn-success pull-right" href="{{ route('transactions.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
            <a class="btn btn-warning pull-right" href="/transactions/report"><i class="glyphicon glyphicon-stats"></i> Report</a>
        </h1>
        @if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif
    </div>
@endsection

@section('content')
    @include('error')
    
    <div class="row">
        <div class="col-md-12">
            @if($transactions->count())
                <div class="div-striped">
                    <?php $prev_date = null; ?>
                    @foreach($transactions as $transaction)                            
                            <?php
                                $dt = ($transaction->date == $prev_date) ? '' : $transaction->date;
                                echo ($dt != '') ? '<p class="subtitle-inverted"><strong>&nbsp;'.date("d/m/Y", strtotime($dt)).'</strong></p>' : null;
                                $prev_date = $transaction->date;
                            ?>                            
                            <div class="clearfix">
                                @if($transaction->type_id != 3)
                                    <div class="pull-left col-xs-5">
                                        <small class="label label-{{($transaction->type_id == 1) ? 'warning' : 'primary' }}">{{ $transaction->category->category or '' }}</small>
                                        <div style="margin-top: 5px" class="alert alert-custom alert-{{($transaction->type_id == 1) ? 'warning' : 'info' }}" role="alert">
                                            {{ $transaction->subcategory->subcategory or '' }}
                                        </div>
                                    </div>
                                    <div class="pull-left col-xs-5">
                                        <strong class="pull-right @if($transaction->amount < 0) red @else blue @endif">{{ number_format($transaction->amount, 2, ',', '.') }}</strong><br>
                                        <small class="label label-default"><em>{{ $transaction->account->account or '' }}</em></small><br>
                                        <strong><small>{{ $transaction->vendor->vendor or '' }}</small></strong>
                                    </div>
                                @else
                                    <div class="pull-left col-xs-7">
                                        <div class="alert alert-custom alert-success pull-left" role="alert">
                                            {{ $transaction->account->account or '' }}
                                        </div>
                                        <div class="alert alert-custom alert-success pull-left" role="alert">
                                            {{ $transaction->accountto->account or '' }}
                                        </div>
                                    </div>
                                    <div class="pull-left col-xs-3 text-right"><strong class="blue">{{ number_format($transaction->amount, 2, ',', '.') }}</strong></div>
                                @endif
                                <div class="pull-left col-xs-2">
                                    <a class="btn btn-warning" href="{{ route('transactions.edit', $transaction->id) }}"><i class="glyphicon glyphicon-edit" alt="Edit"></i></a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash" alt="Delete"></i></button>
                                    </form>
                                </div>
                            </div>                       
                    @endforeach
                </div>
                {!! $transactions->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection