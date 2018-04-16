@extends('layouts.layout')
@section('title',$title)

@section('content')
    @include('components.createModal',['modal_id'=>'create_modal'])
    @include('components.editModal',['modal_id'=>'edit_modal'])
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
            <td>
                <button type="button" class="btn btn-danger delete_record_id" id="{{$NewsRow->id}}" data-toggle="modal" data-target="#delete_modal">刪除</button>
            </td>
            <td>
                <button type="button" class="btn btn-warning update_record_id" id="{{$NewsRow->id}}" data-toggle="modal" data-target="#edit_modal">編輯</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('page-script')
<script type="text/javascript">
    var idClicked;
    // handle delete button
    $(".delete_record_id").click(function(event){idClicked = event.target.id;});
    $(".deleteBtn").click(ajaxDeleteFunction);
    function ajaxDeleteFunction(event){
        $.ajax(
        {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/latestNews/"+idClicked+"/delete",
            type: 'DELETE',
            success: function (){
                console.log("Delete Works");
                window.location.replace("http://localhost:8000/latestNews");
                console.log(window.location.href);
            },
            error:function(){
                console.log("Delete failed");
            }
        });
    }
    // handle update button
    $(".update_record_id").click(function(event){idClicked = event.target.id;});
    // fill the edit modal
    $('#edit_modal').on('show.bs.modal', function (event) {
        if(event.relatedTarget){ //if caused by update button
            var prefix_selector = "tr[id="+idClicked+"]";
            var title = $(prefix_selector+" td[class='title']").text();
            var classification = $(prefix_selector+" td[class='classification']").text();
            var image = $(prefix_selector+" td[class='picture'] img").attr('src');
            var introduction = $(prefix_selector+" td[class='introduction']").text();
            var ended_at = $(prefix_selector+" td[class='ended_at']").text();
            var content = $(prefix_selector+" td[class='content']").text();
        
            var modal = $(this);
            modal.find('form').attr('action','/latestNews/'+idClicked+'/update');
            modal.find('#title').val(title);
            modal.find('.selectpicker').selectpicker('val',classification);
            modal.find('#image').attr('src',image);
            modal.find('#introduction').text(introduction);
            modal.find('#end_date').val(ended_at);
            modal.find('#content').text(content);
        }
    })
    
    // validation error display
    @if(Session::has('create_error') AND count($errors))
        $('#create_modal').modal({show:true});
        @foreach($errors->all() as $err)
            $('#create_modal .create-error-message').append('{{$err}}<br>');
        @endforeach
    @endif
    @if(Session::has('update_error') AND count($errors))
        idClicked = '{{Session::get('update_id')}}';
        console.log(idClicked);
        $('#edit_modal').modal({show:true});
        $('#edit_modal form').attr('action','/latestNews/'+idClicked+'/update');
        @foreach($errors->all() as $err)
            $('#edit_modal .edit-error-message').append('{{$err}}<br>');
        @endforeach
    @endif
</script>
@endsection