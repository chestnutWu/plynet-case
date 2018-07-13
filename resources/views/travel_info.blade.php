@extends('layouts.layout')
@section('toolbar')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">旅遊資訊</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#" data-toggle="modal" data-target="#create_info_modal"><span class="glyphicon glyphicon-plus"></span> 新增旅遊資訊</a></li>
        </ul>
        @include('components.toolbar')
    </div>
</nav>
@endsection

@section('content')
    @include('components.modal.createModal',['modal_id'=>'create_info_modal',
    'modal_title'=>'建立「旅遊資訊」','create_route'=>'information','basic_info_folder'=>'travel_information'])
    @include('components.modal.updateModal',['modal_id'=>'update_info_modal',
    'modal_title'=>'更新「旅遊資訊」','basic_info_folder'=>'travel_information'])
    @include('components.modal.deleteModal',['modal_id'=>'delete_info_modal',
    'modal_title'=>'刪除「旅遊資訊」','confirm_message'=>'確定刪除此「旅遊資訊」?'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th id="title" data-column-type="text">標題</th>
            <th id="picture" data-column-type="image">圖片</th>
            <th id="introduction" data-column-type="textarea">簡介</th>
            <th id="created_at" data-column-type="text">發布日期</th>
            <!--hidden th-->
            <th id="content" data-column-type="radio" hidden="true">內文</th>
            <th id="hypertext" data-column-type="text" hidden="true">超連結</th>
            <th id="editor_input" data-column-type="CKEDITOR" hidden="true">編輯器</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($Infomation as $InfomationRow)
        <tr id="{{$InfomationRow->id}}">
            <td class="title">{{$InfomationRow->title}}</td>
            <td class="picture"><img src="{{$InfomationRow->picture or '\images\default.jpg'}}" ></td>
            <td class="introduction">{{$InfomationRow->introduction}}</td>
            <td class="created_at">{{$InfomationRow->created_at}}</td>
            <!--hidden td-->
            <td class="content" hidden="true">{{$InfomationRow->content}}</td>
            <td class="hypertext" hidden="true">{{$InfomationRow->hypertext}}</td>
            <td class="editor_input" hidden="true">{{$InfomationRow->editor_input}}</td>
            <td>
                <button type="button" class="btn btn-danger delete_record_id" id="{{$InfomationRow->id}}" data-toggle="modal" data-target="#delete_info_modal">刪除</button>
                <button type="button" class="btn btn-warning update_record_id" id="{{$InfomationRow->id}}" data-toggle="modal" data-target="#update_info_modal">編輯</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<center>{{$Infomation->links()}}</center>
@endsection

@section('page-script')
<!--display validation error messages--> 
@include('components.validationErrorMessage',['createModal'=>'create_info_modal','updateModal'=>'update_info_modal','updateRoute'=>'information'])

<script type="text/javascript">
    CKEDITOR.replace('create_editor');
    CKEDITOR.replace('update_editor');
    // handle delete button
    $(".deleteBtn").click({route: "information"},ajaxDeleteFunction);
    // update modal handler
    $('#update_info_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ // if caused by update button click
            var modal = $(this);
            modal.find('form').attr('action','/information/'+idClicked+'/update');
            initializeModal(modal,'update');// fill the update modal
        }
    })
    // create modal handler
    $('#create_info_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            initializeModal(modal,'create');// clean the create modal
        }
    })
    // image on change event
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