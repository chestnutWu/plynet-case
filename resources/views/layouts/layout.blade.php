<!-- layout.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <title>飛遊網管理平台</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--import bootstrap-select-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
        <!--import toggle switch css-->
        <link rel="stylesheet" href="{{ URL::asset('css/toggle-switch.css') }}" />
        <!--import bootstrap dialog-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css"/>
        <!--import batch create form css-->
        <link rel="stylesheet" href="{{ URL::asset('css/batch-create-form.css') }}" />
        <!--import icon and material-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!--build csrf token for ajax-->
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
    <body>
        <div class="container">
            <div class="row jumbotron">
                <header class="col-md-offset-3 col-md-6"><h1>飛遊網後台管理</h1></header>
            </div>
            @yield('toolbar')
            <div class="row">
                <div class="info-table col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!--import bootstrap-select-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <!--bootstrap dialog-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script>
        <!--import html editor-->
        <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
        <!--import batch create form js-->
        <script src="{{ URL::asset('js/batch-create-form.js') }}"></script>
        @yield('page-script')
    </body>
</html>