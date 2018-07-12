@extends('layouts.layout')
@section('toolbar')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">旅遊必備</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#" data-toggle="modal" data-target="#create_items_modal"><span class="glyphicon glyphicon-plus"></span> 新增旅遊必備</a></li>
        </ul>
        @include('components.toolbar')
    </div>
</nav>
@endsection

@section('content')
    @include('components.travel_items.createModal',['modal_id'=>'create_items_modal'])
    @include('components.travel_items.updateModal',['modal_id'=>'update_items_modal'])
    @include('components.travel_items.deleteModal',['modal_id'=>'delete_items_modal'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th id="title" data-column-type="text">標題</th>
            <th id="picture" data-column-type="image">圖片</th>
            <th id="introduction" data-column-type="textarea">簡介</th>
            <th id="created_at" data-column-type="text">發布日期</th>
            <th id="content" data-column-type="radio" hidden="true">內文</th>
            <th id="hypertext" data-column-type="text" hidden="true">超連結</th>
            <th id="editor_input" data-column-type="CKEDITOR" hidden="true">編輯器</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($Items as $ItemRow)
        <tr id="{{$ItemRow->id}}">
            <td class="title">{{$ItemRow->title}}</td>
            <td class="picture"><img src="{{$ItemRow->picture or '\images\default.jpg'}}"></td>
            <td class="introduction">{{$ItemRow->introduction}}</td>
            <td class="created_at">{{$ItemRow->created_at}}</td>
            <!--hidden td-->
            <td class="content" hidden="true">{{$ItemRow->content}}</td>
            <td class="hypertext" hidden="true">{{$ItemRow->hypertext}}</td>
            <td class="editor_input" hidden="true">{{$ItemRow->editor_input}}</td>
            <td>
                <button type="button" class="btn btn-danger delete_record_id" id="{{$ItemRow->id}}" data-toggle="modal" data-target="#delete_items_modal">刪除</button>
                <button type="button" class="btn btn-warning update_record_id" id="{{$ItemRow->id}}" data-toggle="modal" data-target="#update_items_modal">編輯</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--分頁頁數按鈕-->
<center>{{$Items->links()}}</center>
@endsection

@section('page-script')
<!--display validation error messages--> 
@include('components.validationErrorMessage',['createModal'=>'create_items_modal','updateModal'=>'update_items_modal','updateRoute'=>'items'])

<script type="text/javascript">
    CKEDITOR.replace('create_editor');
    CKEDITOR.replace('update_editor');
    // handle delete button
    $(".deleteBtn").click({route: "items"},ajaxDeleteFunction);
    // handle update button
    $('#update_items_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ //if caused by update button click
            var modal = $(this);
            modal.find('form').attr('action','/items/'+idClicked+'/update');
            initializeModal(modal,'update');
        }
    })
    // clean content in create modal
    $('#create_items_modal').on('show.bs.modal',function(event){
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