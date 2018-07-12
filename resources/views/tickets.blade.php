@extends('layouts.layout')
@section('toolbar')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">特價清倉</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#" data-toggle="modal" data-target="#create_tickets_modal"><span class="glyphicon glyphicon-plus"></span> 新增特價機票</a></li>
            <li><a href="#" data-toggle="modal" data-target="#create_batch_tickets_modal"><span class="glyphicon glyphicon-plus"></span> 批量新增特價機票</a></li>
        </ul>
        @include('components.toolbar')
    </div>
</nav>
@endsection
@section('content')
    @include('components.ticket.createModal',['modal_id'=>'create_tickets_modal',
    'modal_title'=>'建立「特價機票」'],'modal_route'=>'tickets','modal_folder'=>'tickets')
    @include('components.ticket.updateModal',['modal_id'=>'update_tickets_modal'])
    @include('components.ticket.deleteModal',['modal_id'=>'delete_tickets_modal'])
    @include('components.ticket.createBatchModal',['modal_id'=>'create_batch_tickets_modal'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th id="ticket_number" data-column-type="text">機票單號</th>
            <th id="region" data-column-type="text">地區</th> 
            <th id="topic" data-column-type="text">促銷主題</th>
            <th id="started_at" data-column-type="text">起始顯示日期</th>
            <th id="ended_at" data-column-type="text">截止顯示日期</th>
            <th id="depart_date" data-column-type="text">航班出發日期</th>
            <th id="return_date" data-column-type="text">航班回程日期</th>
            <th id="sales_instruction" data-column-type="text">售票說明</th>
            <th id="sales_tel" data-column-type="text">訂票專線</th>
            <th id="price" data-column-type="text">票價</th>
            <th id="content" data-column-type="radio" hidden="true">內文</th>
            <th id="hypertext" data-column-type="text" hidden="true">超連結</th>
            <th id="editor_input" data-column-type="CKEDITOR" hidden="true">編輯器</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($Tickets as $Ticket)
        <tr id="{{$Ticket->id}}">
            <td class="ticket_number">{{$Ticket->ticket_number}}</td>
            <td class="region">{{$Ticket->region}}</td>
            <td class="topic">{{$Ticket->topic}}</td>
            <td class="started_at">{{$Ticket->started_at}}</td>
            <td class="ended_at">{{$Ticket->ended_at}}</td>
            <td class="depart_date">{{$Ticket->depart_date}}</td>
            <td class="return_date">{{$Ticket->return_date}}</td>
            <td class="sales_instruction">{{$Ticket->sales_instruction}}</td>
            <td class="sales_tel">{{$Ticket->sales_tel}}</td>
            <td class="price">{{$Ticket->price}}</td>
            <!--hidden td-->
            <td class="content" hidden="true">{{$Ticket->content}}</td>
            <td class="hypertext" hidden="true">{{$Ticket->hypertext}}</td>
            <td class="editor_input" hidden="true">{{$Ticket->editor_input}}</td>
            <td>
                <button type="button" class="btn btn-danger delete_record_id" id="{{$Ticket->id}}" data-toggle="modal" data-target="#delete_tickets_modal">刪除</button>
                <button type="button" class="btn btn-warning update_record_id" id="{{$Ticket->id}}" data-toggle="modal" data-target="#update_tickets_modal">編輯</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--分頁頁數按鈕-->
<center>{{$Tickets->links()}}</center>
@endsection

@section('page-script')
<!--display validation error messages--> 
@include('components.validationErrorMessage',['createModal'=>'create_tickets_modal','updateModal'=>'update_tickets_modal','updateRoute'=>'tickets'])

<!--import batch create form js-->
<script src="{{ URL::asset('js/batch-create-form.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace('create_editor');
    CKEDITOR.replace('update_editor');
    CKEDITOR.replace('create_batch_editor');
    // handle delete button
    $(".deleteBtn").click({route: "tickets"},ajaxDeleteFunction);
    // handle update button
    $('#update_tickets_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ //if caused by update button click
            var modal = $(this);
            modal.find('form').attr('action','/tickets/'+idClicked+'/update');
            initializeModal(modal,'update');
        }
    })
    // clean content in create modal
    $('#create_tickets_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            initializeModal(modal,'create');
        }
    })
</script>
@endsection