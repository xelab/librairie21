<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Librairie</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/magnificPopup/magnific-popup.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/librairie.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-2 well">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation" class="{!! Request::is('book*')? 'active' : '' !!}"><a href="{!! url('book') !!}">Stock</a></li>
                    </ul>
                </div>
                <div class="col-xs-10">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/magnificPopup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/dataTables/dataTables.min.js') }}"></script>
        <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>