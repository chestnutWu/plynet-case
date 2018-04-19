<!-- layout.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--import bootstrap-select-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
        <!--build csrf token for ajax-->
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
    <body>
        <div class="container">
            <div class="row jumbotron">
                <header class="col-md-offset-3 col-md-6"><h1>飛遊網後台管理</h1></header>
            </div>
            <div class="row">
                <div class="toolbar col-md-offset-2 col-md-10">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#create_modal">新增</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">匯入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">匯出</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">重新整理</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="list-group col-md-2">
                    <a href="#" class="list-group-item list-group-item-action">最新消息</a>
                    <a href="#" class="list-group-item list-group-item-action">特價清倉</a>
                    <a href="#" class="list-group-item list-group-item-action">旅遊必備</a>
                    <a href="#" class="list-group-item list-group-item-action">旅遊資訊</a>
                    <a href="#" class="list-group-item list-group-item-action">出去走走</a>
                    <a href="#" class="list-group-item list-group-item-action">購物測試</a>
                </div>
                <div class="info-table col-md-10">
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
        <!--import text editor-->
        <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
        @yield('page-script')
    </body>
</html>