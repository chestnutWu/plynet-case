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

        <footer></footer>
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
            var columns = [];
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
                // initalize info row column obj({key : value}) to columns[]
                $('tr[class="info"]:nth-child(1) th').each(function(){
                    if(this.id){
                        var obj = {};
                        var key = this.id;
                        var value = this.getAttribute("data-column-type");
                        obj[key] = value;
                        columns.push(obj);  
                    }
                });
            });
            // ajax delete
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
            // radio toggle view
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
            // fill update modal with parameter="update";clean create modal with parameter="create"
            function initializeModal(modal,type){
                var prefix_selector = "tr[id="+idClicked+"]";
                for(var i=0;i<columns.length;i++){
                    var column_name = Object.keys(columns[i])[0];
                    var column_type = columns[i][column_name];
                    var column_value = "";
                    switch(column_type){
                        case 'text':
                            if(type === 'update'){
                                column_value = $(prefix_selector+" td[class="+column_name+"]").text();
                            }
                            modal.find('input[name='+column_name+']').val(column_value);
                            break;
                        case 'selectpicker':
                            if(type === 'update'){
                                column_value = $(prefix_selector+" td[class="+column_name+"]").text();
                            }else{
                                column_value = '最新消息';
                            }
                            modal.find('select[name='+column_name+']').selectpicker('val',column_value);
                            break;
                        case 'textarea':
                            if(type === 'update'){
                                column_value = $(prefix_selector+" td[class="+column_name+"]").text();
                            }
                            modal.find('textarea[name='+column_name+']').val(column_value);
                            break;
                        case 'radio':
                            if(type === 'update'){
                                column_value = $(prefix_selector+" td[class="+column_name+"]").text();
                            }else{
                                column_value = '無內文';
                            }
                            modal.find('input[name='+column_name+'][value='+column_value+']').prop('checked',true);
                            toggleContentView(column_value);
                            break;
                        case 'CKEDITOR':
                            if(type === 'update'){
                                column_value = $(prefix_selector+" td[class="+column_name+"]").text();
                                CKEDITOR.instances['update_editor'].setData(column_value);
                            }else{
                                CKEDITOR.instances['create_editor'].setData(column_value);
                            }
                            break;
                        case 'image':
                            if(type === 'update'){
                               column_value = $(prefix_selector+" td[class="+column_name+"] img").attr('src'); 
                            }
                            modal.find('input[name="picture"]').val("");
                            modal.find('.image').attr('src',column_value);
                            break;
                    }
                }
                if(type === 'update'){
                    modal.find('.update-error-message').empty();
                }else{
                    modal.find('.create-error-message').empty();
                }
            }
        </script>
        @yield('page-script')
    </body>
</html>