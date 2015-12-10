@extends('layouts.master')

@section('content')

    <h1>Book</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Isbn</th><th>Collection Id</th><th>Publisher Id</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $book->id }}</td> <td> {{ $book->isbn }} </td><td> {{ $book->collection_id }} </td><td> {{ $book->publisher_id }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection