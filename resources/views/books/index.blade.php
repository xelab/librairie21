@extends('layouts.master')

@section('content')

    {!! Form::open(['url' => 'book', 'class' => 'form-horizontal', 'id' => 'newBook']) !!}
    
        <div class="form-group">
            {!! Form::label('isbn', 'Isbn: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('isbn', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('collection_id', 'Collection Id: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('collection_id', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('publisher_id', 'Publisher Id: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('publisher_id', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('price', 'Price: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('price', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('released', 'Released: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::date('released', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('title', 'Title: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('summary', 'Summary: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::textarea('summary', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('deposit', 'Deposit: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('deposit', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('buy', 'Buy: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('buy', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('distributor_id', 'Distributor Id: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('distributor_id', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>    
        </div>
    {!! Form::close() !!}

    <div class="table">
        <table class="table table-striped" id="books-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>ISBN</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/books.js') }}"></script>
    <script>
        $(function() {
            $('#books-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables.data') !!}",
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'isbn', name: 'isbn' }
                ]
            });
            $('#newBook').ajaxForm();
        });
    </script>
@endpush