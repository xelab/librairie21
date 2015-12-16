@extends('layouts.master')

@section('content')

    <h1>Distributor</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Address</th><th>City</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $distributor->id }}</td> <td> {{ $distributor->name }} </td><td> {{ $distributor->address }} </td><td> {{ $distributor->city }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection