@extends('layouts.layout')
@section('title',$title)

@section('content')
    @include('components.createModal',['modal_id'=>'create_modal'])
    @include('components.updateModal',['modal_id'=>'update_modal'])
    @include('components.deleteModal',['modal_id'=>'delete_modal'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th>標題</th>
            <th>分類</th> 
            <th>小圖</th>
            <th>簡介</th>
            <th>發布日期</th> 
            <th>截止日期</th>
            <th>內文</th>
        </tr>
    </thead>
    <tbody>
        @foreach($News as $NewsRow)
        <tr id="{{$NewsRow->id}}">
            <td class="title">{{$NewsRow->title}}</td>
            <td class="classification">{{$NewsRow->classification}}</td>
            <td class="picture"><img src="{{$NewsRow->picture or '\images\News\default.jpg'}}"></td>
            <td class="introduction">{{$NewsRow->introduction}}</td>
            <td class="created_at">{{$NewsRow->created_at}}</td>
            <td class="ended_at">{{$NewsRow->ended_at}}</td>
            <td class="content">{{$NewsRow->content}}</td>
            <!--hidden td-->
            <td class="hypertext" hidden="true">{{$NewsRow->hypertext}}</td>
            <td class="editor_input" hidden="true">{{$NewsRow->editor_input}}</td>
            <td>
                <button type="button" class="btn btn-danger delete_record_id" id="{{$NewsRow->id}}" data-toggle="modal" data-target="#delete_modal">刪除</button>
            </td>
            <td>
                <button type="button" class="btn btn-warning update_record_id" id="{{$NewsRow->id}}" data-toggle="modal" data-target="#update_modal">編輯</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('page-script')
<script type="text/javascript">
    CKEDITOR.replace('create_editor');
    CKEDITOR.replace('update_editor');
    $(document).ready(function(){
        //fixed the input problem using html editor in modal
        $.fn.modal.Constructor.prototype.enforceFocus = function(){
            var $modalElement = this.$element;
            $(document).on('focusin.modal', function(e){
                var $parent = $(e.target.parentNode);
                if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length &&
                    !$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {$modalElement.focus()}
            })
        }
    });
    // handle delete button
    var idClicked;
    $(".delete_record_id").click(function(event){idClicked = event.target.id;});
    $(".deleteBtn").click(ajaxDeleteFunction);
    function ajaxDeleteFunction(event){
        $.ajax(
        {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/latestNews/"+idClicked+"/delete",
            type: 'DELETE',
            success: function (){
                window.location.replace("http://localhost:8000/latestNews");
            },
            error:function(){
                alert("Delete function failed");
            }
        });
    }
    // handle update button
    $(".update_record_id").click(function(event){idClicked = event.target.id;});
    $('#update_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ //if caused by update button click
            // get data from the table
            var prefix_selector = "tr[id="+idClicked+"]";
            var title = $(prefix_selector+" td[class='title']").text();
            var classification = $(prefix_selector+" td[class='classification']").text();
            var image = $(prefix_selector+" td[class='picture'] img").attr('src');
            var introduction = $(prefix_selector+" td[class='introduction']").text();
            var ended_at = $(prefix_selector+" td[class='ended_at']").text();
            var content = $(prefix_selector+" td[class='content']").text();
            var hypertext = $(prefix_selector+" td[class='hypertext']").text();
            var editor_input = $(prefix_selector+" td[class='editor_input']").text();
            // fill the edit modal
            var modal = $(this);
            modal.find('form').attr('action','/latestNews/'+idClicked+'/update');
            modal.find('input[name="title"]').val(title);
            modal.find('select[name="classification"]').selectpicker('val',classification);
            modal.find('.image').attr('src',image);
            modal.find('textarea[name="introduction"]').text(introduction);
            modal.find('input[name="ended_at"]').val(ended_at);
            modal.find(':radio[name="content"][value='+content+']').prop('checked',true);
            toggleContentView(content);
            modal.find('input[name="hypertext"]').val(hypertext);
            CKEDITOR.instances['update_editor'].setData(editor_input);
            modal.find('.update-error-message').empty();
        }
    })
    // clean content in create modal
    $('#create_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            modal.find('input[name="title"]').val("");
            modal.find('.selectpicker').selectpicker('val',"最新消息");
            modal.find('input[name="picture"]').val("");
            modal.find('.image').attr('src',"");
            modal.find('textarea[name="introduction"]').text("");
            modal.find('input[name="ended_at"]').val("");
            modal.find(':radio[name="content"]').prop('checked',false);
            modal.find('input[name="hypertext"]').val("");
            CKEDITOR.instances['create_editor'].setData("");
            modal.find('.create-error-message').empty();
            toggleContentView("");
        }
    })
    // display changed image
    $('input[type="file"]').change(function(){
        var fileInput = this;
        if(fileInput.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('.image').attr('src',e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    });
    // display validation error messages 
    @if(Session::has('create_error') AND count($errors))
        $('#create_modal').modal({show:true});
        var content = $(':radio[name="content"]:checked').val();
        toggleContentView(content);
        @foreach($errors->all() as $err)
            $('#create_modal .create-error-message').append('{{$err}}<br>');
        @endforeach
    @endif
    @if(Session::has('update_error') AND count($errors))
        idClicked = '{{Session::get('update_id')}}';
        $('#update_modal').modal({show:true});
        $('#update_modal form').attr('action','/latestNews/'+idClicked+'/update');
        var content = $(':radio[name="content"]:checked').val();
        toggleContentView(content);
        @foreach($errors->all() as $err)
            $('#update_modal .update-error-message').append('{{$err}}<br>');
        @endforeach
    @endif
    // radio button onchanged event
    $('input[name="content"]').on('change',function(){toggleContentView(this.value);})
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
</script>
@endsection