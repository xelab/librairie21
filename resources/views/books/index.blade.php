@extends('layouts.master')

@section('content')
    <hr>
    <input type="hidden" id="url-scraping" value="{{ route('books.scraping') }}">
    <input type="hidden" id="url-collections" value="{{ route('publisher.collections') }}">
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
            <div class="form-group collection" style="display:none">
                {!! Form::label('collection_id', 'Collection: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('collection_id', [], null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon new-collection"><a href="#pop-collection-form" class="open-popup-link">+</a></span>
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
                        <span class="input-group-addon new-distributor"><a href="#pop-distributor-form" class="open-popup-link">+</a></span>
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
        <div class="panel panel-default">
            <div class="panel-heading">Nouvel éditeur</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'publisher', 'class' => 'form-horizontal', 'id' => 'newPublisher']) !!}
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Nom: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Tel: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('mail', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('mail', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Adresse: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('city', 'Ville: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('city', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('zip', 'Code Postal: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-3">
                                {!! Form::submit('Créer', ['class' => 'btn btn-primary form-control']) !!}
                            </div>    
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            
        </div>
    </div>

    <div id="pop-collection-form" class="white-popup mfp-hide">
        <div class="panel panel-default">
            <div class="panel-heading">Nouvelle collection</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'collection', 'class' => 'form-horizontal', 'id' => 'newCollection']) !!}
                    <input type="hidden" name="publisher_id" id="collection_publisher">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Nom: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-3">
                                {!! Form::submit('Créer', ['class' => 'btn btn-primary form-control']) !!}
                            </div>    
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            
        </div>
    </div>

    <div id="pop-distributor-form" class="white-popup mfp-hide">
        <div class="panel panel-default">
            <div class="panel-heading">Nouveau distributeur</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'distributor', 'class' => 'form-horizontal', 'id' => 'newDistributor']) !!}
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Nom: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Tel: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('mail', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('mail', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Adresse: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('city', 'Ville: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('city', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('zip', 'Code Postal: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-3">
                                {!! Form::submit('Créer', ['class' => 'btn btn-primary form-control']) !!}
                            </div>    
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            
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
            $('#newPublisher').ajaxForm({success: addAndHidePublisherForm, dataType: 'json', resetForm: true});
            $('#newCollection').ajaxForm({success: addAndHideCollectionForm, dataType: 'json', resetForm: true});
            $('#newDistributor').ajaxForm({success: addAndHideDistributorForm, dataType: 'json', resetForm: true});
        });
    </script>
@endpush