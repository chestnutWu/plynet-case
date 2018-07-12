@extends('layouts.layout')
@section('toolbar')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">最新消息</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#" data-toggle="modal" data-target="#create_news_modal"><span class="glyphicon glyphicon-plus"></span> 新增消息</a></li>
        </ul>
        @include('components.toolbar')
    </div>
</nav>
@endsection

@section('content')
    @include('components.news.createModal',['modal_id'=>'create_news_modal'])
    @include('components.news.updateModal',['modal_id'=>'update_news_modal'])
    @include('components.news.deleteModal',['modal_id'=>'delete_news_modal'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th id="title" data-column-type="text">標題</th>
            <th id="classification" data-column-type="selectpicker">分類</th> 
            <th id="picture" data-column-type="image">圖片</th>
            <th id="introduction" data-column-type="textarea">簡介</th>
            <th id="created_at" data-column-type="text">發布日期</th> 
            <th id="ended_at" data-column-type="text">截止顯示日期</th>
            <th id="content" data-column-type="radio" hidden="true">內文</th>
            <th id="hypertext" data-column-type="text" hidden="true">超連結</th>
            <th id="editor_input" data-column-type="CKEDITOR" hidden="true">編輯器</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($News as $NewsRow)
        <tr id="{{$NewsRow->id}}">
            <td class="title">{{$NewsRow->title}}</td>
            <td class="classification">{{$NewsRow->classification}}</td>
            <td class="picture"><img src="{{$NewsRow->picture or '\images\default.jpg'}}"></td>
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
    // handle delete button
    $(".deleteBtn").click({route: "news"},ajaxDeleteFunction);
    // handle update button
    $('#update_news_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ //if caused by update button click
            var modal = $(this);
            modal.find('form').attr('action','/news/'+idClicked+'/update');
            initializeModal(modal,'update');
        }
    })
    // clean content in create modal
    $('#create_news_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            initializeModal(modal,'create');
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