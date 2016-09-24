@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Vendors
            <a class="btn btn-success pull-right" href="{{ route('vendors.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
        @if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($vendors->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>VENDOR</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($vendors as $vendor)
                            <tr>
                                <td>{{$vendor->id}}</td>
                                <td>{{$vendor->vendor}}</td>
                                <td class="text-right">
                                    <!-- <a class="btn btn-xs btn-primary" href="{{ route('vendors.show', $vendor->id) }}"><i class="glyphicon glyphicon-eye-open" alt="View"></i></a> -->
                                    <a class="btn btn-warning" href="{{ route('vendors.edit', $vendor->id) }}"><i class="glyphicon glyphicon-edit" alt="Edit"></i></a>
                                    <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash" alt="Delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $vendors->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection