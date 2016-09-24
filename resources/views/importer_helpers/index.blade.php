@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> ImporterHelpers
            <a class="btn btn-success pull-right" href="{{ route('importer_helpers.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($importer_helpers->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DESCRIPTION</th>
                            <th>CATEGORY_ID</th>
                            <th>SUBCATEGORY_ID</th>
                            <th>VENDOR_ID</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($importer_helpers as $importer_helper)
                            <tr>
                                <td>{{$importer_helper->id}}</td>
                                <td>{{$importer_helper->description}}</td>
                                <td>{{$importer_helper->category_id}}</td>
                                <td>{{$importer_helper->subcategory_id}}</td>
                                <td>{{$importer_helper->vendor_id}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('importer_helpers.show', $importer_helper->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('importer_helpers.edit', $importer_helper->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('importer_helpers.destroy', $importer_helper->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $importer_helpers->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection