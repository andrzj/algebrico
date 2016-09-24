@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Bookmarks
            <a class="btn btn-success pull-right" href="{{ route('bookmarks.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
        @if (session('message')) <p class="alert alert-success">{{ session('message') }}</p>@endif
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($bookmarks->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ACCOUNT</th>
                            <th>CATEGORY</th>
                            <th>SUBCATEGORY</th>
                            <th>TYPE</th>
                            <th>VENDOR</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookmarks as $bookmark)
                            <tr>
                                <td>{{ $bookmark->id }}</td>
                                <td>{{ $bookmark->account->account or '' }}</td>
                                <td>{{ $bookmark->category->category or '' }}</td>
                                <td>{{ $bookmark->subcategory->subcategory or '' }}</td>
                                <td>{{ $bookmark->type->type or '' }}</td>
                                <td>{{ $bookmark->vendor->vendor or '' }}</td>
                                <td class="text-right">
                                    <!-- <a class="btn btn-xs btn-primary" href="{{ route('bookmarks.show', $bookmark->id) }}"><i class="glyphicon glyphicon-eye-open" alt="View"></i></a> -->
                                    <!-- <a class="btn btn-warning" href="{{ route('bookmarks.edit', $bookmark->id) }}"><i class="glyphicon glyphicon-edit" alt="Edit"></i></a> -->
                                    <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash" alt="Delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $bookmarks->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection