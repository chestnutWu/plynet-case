@extends('layouts.layout')
@section('toolbar')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">旅遊必備</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#" data-toggle="modal" data-target="#create_news_modal"><span class="glyphicon glyphicon-plus"></span> 新增旅遊必備</a></li>
        </ul>
        @include('components.toolbar')
    </div>
</nav>
@endsection

@section('content')
    @include('components.travel_items.createModal',['modal_id'=>'create_travel_items_modal'])
    @include('components.travel_items.updateModal',['modal_id'=>'update_travel_items_modal'])
    @include('components.travel_items.deleteModal',['modal_id'=>'delete_travel_items_modal'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th id="title">標題</th>
            <th>分類</th> 
            <th>小圖</th>
            <th>簡介</th>
            <th id="created_at">發布日期</th> 
            <th id="ended_at">截止顯示日期</th>
            <th></th>
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
            <!--hidden td-->
            <td class="content" hidden="true">{{$NewsRow->content}}</td>
            <td class="hypertext" hidden="true">{{$NewsRow->hypertext}}</td>
            <td class="editor_input" hidden="true">{{$NewsRow->editor_input}}</td>
            <td>
                <button type="button" class="btn btn-danger delete_record_id" id="{{$NewsRow->id}}" data-toggle="modal" data-target="#delete_news_modal">刪除</button>
                <button type="button" class="btn btn-warning update_record_id" id="{{$NewsRow->id}}" data-toggle="modal" data-target="#update_news_modal">編輯</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--分頁頁數按鈕-->
<center>{{$News->links()}}</center>
@endsection

@section('page-script')
<!--display validation error messages--> 
@include('components.validationErrorMessage',['createModal'=>'create_news_modal','updateModal'=>'update_news_modal','updateRoute'=>'news'])

<script type="text/javascript">
    CKEDITOR.replace('create_editor');
    CKEDITOR.replace('update_editor');
    // initalize info row column to columns[]
    var columns = [];
    $('tr[class="info"]:nth-child(1) th').each(function(){
        if(this.id){
            columns.push(this.id);
        }
    });
    // handle delete button
    $(".deleteBtn").click({route: "news"},ajaxDeleteFunction);
    // handle update button
    $('#update_news_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ //if caused by update button click
            var prefix_selector = "tr[id="+idClicked+"]";
            var modal = $(this);
            modal.find('form').attr('action','/news/'+idClicked+'/update');
            fillUpdateModal(modal);
            // fill different type from input[name=?]
            var image = $(prefix_selector+" td[class='picture'] img").attr('src');
            modal.find('.image').attr('src',image);
            var classification = $(prefix_selector+" td[class='classification']").text();
            modal.find('select[name="classification"]').selectpicker('val',classification);
            var introduction = $(prefix_selector+" td[class='introduction']").text();
            modal.find('textarea[name="introduction"]').text(introduction);
        }
    })
    // clean content in create modal
    $('#create_news_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            cleanCreateModal(modal);
            // clear different type from input[name=?]
            modal.find('.selectpicker').selectpicker('val',"最新消息");
            modal.find('input[name="picture"]').val("");
            modal.find('.image').attr('src',"");
            modal.find('textarea[name="introduction"]').val("");
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
</script>
@endsection