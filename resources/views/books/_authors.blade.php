<div id="pop-author-form" class="white-popup mfp-hide">
    <div class="panel panel-default">
        <div class="panel-heading">Nouvel-le auteur-e</div>
        <div class="panel-body">
            {!! Form::open(['url' => 'author', 'class' => 'form-horizontal', 'id' => 'newAuthor']) !!}
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