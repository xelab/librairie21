@extends('layouts.master')

@section('content')
    <hr>
    <input type="hidden" id="url-scraping" value="{{ route('books.scraping') }}">
    {!! Form::open(['url' => 'book', 'class' => 'form-horizontal', 'id' => 'newBook']) !!}
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('isbn', 'ISBN: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('isbn', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('publisher_id', 'Éditeur : ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('publisher_id', $publishers, null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon new-publisher"><a href="#pop-publisher-form" class="open-popup-link">+</a></span>
                    </div>
                </div>
            </div>
            <div class="form-group" style="display:none">
                {!! Form::label('collection_id', 'Collection: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('collection_id', [], null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon new-collection">+</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('authors', 'Auteurs: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('authors', [], null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                        <span class="input-group-addon new-author">+</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('price', 'Prix: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('price', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('released', 'Publié le: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::date('released', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('deposit', 'Dépôts: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('deposit', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('buy', 'Achats fermes: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('buy', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('distributor_id', 'Distributeur: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('distributor_id', $distributors, null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon new-distributor">+</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('title', 'Titre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('summary', 'Résumé: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('summary', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Créer', ['class' => 'btn btn-primary form-control']) !!}
                </div>    
            </div>
        </div>
    {!! Form::close() !!}

    <div id="pop-publisher-form" class="white-popup mfp-hide">
        <div>
            Popup content
        </div>
    </div>

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