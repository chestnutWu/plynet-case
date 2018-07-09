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
        <!--import common script-->
        <script>
            var idClicked;
            $(document).ready(function(){
                // fixed the input problem using html editor in modal
                $.fn.modal.Constructor.prototype.enforceFocus = function(){
                    var $modalElement = this.$element;
                    $(document).on('focusin.modal', function(e){
                        var $parent = $(e.target.parentNode);
                        if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length &&
                            !$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {$modalElement.focus()}
                    })
                }
                // regist event handler
                $(".delete_record_id").click(function(event){idClicked = event.target.id;});
                $(".update_record_id").click(function(event){idClicked = event.target.id;});
                $('input[name="content"]').on('change',function(){toggleContentView(this.value);})
            });
            // delete ajax function
            function ajaxDeleteFunction(event){
                var route = event.data.route;
                $.ajax(
                {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "/"+route+"/"+idClicked+"/delete",
                    type: 'DELETE',
                    success: function (){
                        window.location.href = '../'+route;
                    },
                    error:function(){
                        alert("Delete failed");
                    }
                });
            }
            // change view corresponding to radio button
            function toggleContentView(condition){
                if(condition == '超連結內文'){
                    $('.hyper-link-field').show();
                    $('.content-field').hide();
                }
                else if(condition == '如以下輸入'){
                    $('.hyper-link-field').hide();
                    $('.content-field').show();
                }else{// 無內文 or 沒選擇 radio button 
                    $('.hyper-link-field').hide();
                    $('.content-field').hide();
                }
            }
            // clear modal content
            function clearModal(){
                
            }
        </script>
        @yield('page-script')
    </body>
</html>