@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> <!-- Transactions -->
            <a class="btn btn-success pull-right" href="{{ route('transactions.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <form action="/transactions/report" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group col-xs-4">
                {!! Form::select('account_id', $accounts, old("account_id"), ['id' => 'account_id', 'class'=>'form-control form-control-custom']) !!}
            </div>
            <div class="form-group col-xs-4">
                {!! Form::select('due_month', Config::get('constants.MONTHS'), date('n'), ['class'=>'form-control form-control-custom']) !!}
            </div>
            <div class="form-group col-xs-2">
                {!! Form::select('due_year', Config::get('constants.YEARS'), date('Y'), ['class'=>'form-control form-control-custom']) !!}
            </div>
            <div class="form-group col-xs-2">
                <input type="submit" class="btn btn-primary" name="transactionButton" value="Search"/>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($transactions && $transactions->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>AMOUNT</th>
                            <th>ACCOUNT</th>
                            <th>ACCOUNTTO</th>
                            <th>CATEGORY</th>
                            <th>SUBCATEGORY</th>
                            <!-- <th>TYPE</th> -->
                            <th>VENDOR</th>
                            <th>DUE_MONTH</th>
                            <th>DUE_YEAR</th>
                            <!-- <th>NOTE</th> -->
                            <th>OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                            <tr>                                
                                <td>
                                    <strong>Total</strong>
                                </td>
                                <td>
                                    <strong><span class="total_amount"></span></strong>
                                </td>
                                <td colspan="8"></td>
                            </tr>

                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ date("d/m/Y", strtotime($transaction->date)) }}</td>
                                <td class="amount_to_sum">{{ number_format((($transaction->type_id == 3) ? $transaction->amount *-1 : $transaction->amount), 2, ',', '.') }}</td>
                                <td>{{ $transaction->account->account or '' }}</td>
                                <td>{{ $transaction->accountto->account or '' }}</td> 
                                <td>{{ $transaction->category->category or '' }}</td>
                                <td>{{ $transaction->subcategory->subcategory or '' }}</td>
                                <!-- <td>{{ $transaction->type->type }}</td> -->
                                <td>{{ $transaction->vendor->vendor or '' }}</td>
                                <td>{{ $transaction->due_month }}</td>
                                <td>{{ $transaction->due_year }}</td>
                                <!-- <td>{{ $transaction->note }}</td> -->
                                <td>
                                    <a class="btn btn-warning" href="{{ route('transactions.edit', $transaction->id) }}"><i class="glyphicon glyphicon-edit" alt="Edit"></i></a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash" alt="Delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            @else
                <!-- <h3 class="text-center alert alert-info">Empty!</h3> -->
            @endif

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>

<div id="chart_div2"></div>


        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(document).ready(function($) {
            var t = 0; 
            $('.amount_to_sum').each(function(){ t += parseFloat($(this).text().replace('.','').replace(',','.')); }); 
            $('.total_amount').text(parseFloat(t).toFixed(2));
        });
    </script>

    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar', 'line']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

          var data = google.visualization.arrayToDataTable([
            ['City', '2010 Population', {role: 'style'}, {role: 'annotation'}],
            ['New York City, NY', 8175000, '#58a068', 's'],
            ['Los Angeles, CA', 3792000, '#7c2722', 'd'],
            ['Chicago, IL', 2695000, '#d1c566', 'f'],
            ['Houston, TX', 2099000, '#297d9c', 'g'],
            ['Philadelphia, PA', 1526000, '#c1d0f5', 'j']
          ]);

          var options = {
            title: 'Population of Largest U.S. Cities',
            chartArea: {width: '60%'},
            bar: {groupWidth: "80%"},
            height: 500,
            hAxis: {
              title: 'Total Population',
              minValue: 0
            },
            vAxis: {
              title: 'City'
            }
          };

          var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

          chart.draw(data, options);
        }



        google.charts.setOnLoadCallback(drawLineColors);

        function drawLineColors() {
          var data = new google.visualization.DataTable();
          data.addColumn('number', 'X');
          data.addColumn('number', 'Dogs');
          data.addColumn('number', 'Cats');

          data.addRows([
            [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
            [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
            [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
            [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
            [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
            [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
            [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53]
          ]);

          var options = {
            hAxis: {
              title: 'Time'
            },
            vAxis: {
              title: 'Popularity'
            },
            colors: ['#a52714', '#097138']
          };

          var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
          chart.draw(data, options);
        }
     
    </script>
@endsection