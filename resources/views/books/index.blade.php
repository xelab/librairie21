@extends('layouts.master')

@section('content')
    <button onclick="$('#newBook').show();$(this).hide();$('#hideForm').show();" id="showNewForm" class="btn btn-primary">Ajouter une entrée</button>
    <button onclick="$('#newBook').hide();$('#showNewForm').show();$(this).hide();" class="btn btn-warning" id="hideForm" style="display: none">Masquer le formulaire</button>
    
    <div class="alert alert-success alert-dismissible hidden" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Ouvrage correctement ajouté.</strong>
    </div> 

    <input type="hidden" id="url-scraping" value="{{ route('books.scraping') }}">
    <input type="hidden" id="url-collections" value="{{ route('publisher.collections') }}">
    {!! Form::open(['url' => 'book', 'class' => 'form-horizontal', 'id' => 'newBook']) !!}
        <hr>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('isbn', 'ISBN: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('isbn', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Titre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    <small class="help-block"></small>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('publisher_id', 'Éditeur : ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('publisher_id', $publishers, null, ['class' => 'form-control']) !!}
                        <a class="input-group-addon new-publisher open-popup-link" href="#pop-publisher-form">+</a>
                    </div>
                </div>
            </div>
            <div class="form-group collection" style="display:none">
                {!! Form::label('collection_id', 'Collection: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('collection_id', [], null, ['class' => 'form-control']) !!}
                        <a class="input-group-addon new-collection open-popup-link" href="#pop-collection-form">+</a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('authors', 'Auteurs: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('authors', $authors, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                        <a class="input-group-addon new-author open-popup-link" href="#pop-author-form">+</a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('price', 'Prix: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::number('price', null, ['class' => 'form-control', 'step' => 'any', 'min' => '0']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('released', 'Publié le: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::date('released', null, ['class' => 'form-control']) !!}
                    <small class="help-block"></small>
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
                        <a class="input-group-addon new-distributor open-popup-link" href="#pop-distributor-form">+</a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('tags', 'Tags: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        {!! Form::select('tags', $tags, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                        <a class="input-group-addon new-tag open-popup-link" href="#pop-tag-form">+</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('url_picture', 'URL image: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('url_picture', null, ['class' => 'form-control']) !!}
                    <img id="picture" src="#" alt="">
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('summary', 'Résumé: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('summary', null, ['class' => 'form-control', 'rows' => 5]) !!}
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

    <div id="pop-tag-form" class="white-popup mfp-hide">
        <div class="panel panel-default">
            <div class="panel-heading">Nouveau tag</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'tag', 'class' => 'form-horizontal', 'id' => 'newTag']) !!}
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

    <div id="pop-author-form" class="white-popup mfp-hide">
        <div class="panel panel-default">
            <div class="panel-heading">Nouvel-le auteur-e</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'author', 'class' => 'form-horizontal', 'id' => 'newAuthor']) !!}
                    <div class="col-xs-12">
                        <div class="form-group">
                            {!! Form::label('lastname', 'Nom: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('firstname', 'Prénom: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
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

    <div class="row">
        <div class="col-xs-12">
            <hr>
            {!! $dataTable->table(['id' => 'books-table', 'class' => 'table table-striped']) !!}
        </div>
    </div>
    

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/books.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {
            
            $('#newBook').ajaxForm({success: addBook, error: showErrors, dataType: 'json', resetForm: true});
            $('#newPublisher').ajaxForm({success: addAndHidePublisherForm, dataType: 'json', resetForm: true});
            $('#newCollection').ajaxForm({success: addAndHideCollectionForm, dataType: 'json', resetForm: true});
            $('#newDistributor').ajaxForm({success: addAndHideDistributorForm, dataType: 'json', resetForm: true});
            $('#newAuthor').ajaxForm({success: addAndHideAuthorForm, dataType: 'json', resetForm: true});
            $('#newTag').ajaxForm({success: addAndHideTagForm, dataType: 'json', resetForm: true});
        });
    </script>
@endpush