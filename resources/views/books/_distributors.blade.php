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