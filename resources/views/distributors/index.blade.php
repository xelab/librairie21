@extends('layouts.master')

@section('content')

    <h1>Distributors <a href="{{ url('/distributor/create') }}" class="btn btn-primary pull-right btn-sm">Add New Distributor</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>SL.</th><th>Name</th><th>Address</th><th>City</th><th>Actions</th>
                </tr>
            </thead>                
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($distributors as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/distributor', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->address }}</td><td>{{ $item->city }}</td>
                    <td><a href="{{ url('/distributor/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a> / {!! Form::open(['method'=>'delete','action'=>['DistributorController@destroy',$item->id], 'style' => 'display:inline']) !!}<button type="submit" class="btn btn-danger btn-xs">Delete</button>{!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection