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
        @include('components.toolbarComponent')
    </div>
</nav>
@endsection
@section('content')
    @include('components.createTicketsModal',['modal_id'=>'create_tickets_modal'])
    @include('components.updateTicketsModal',['modal_id'=>'update_tickets_modal'])
    @include('components.deleteTicketsModal',['modal_id'=>'delete_tickets_modal'])
    @include('components.createBatchTicketsModal',['modal_id'=>'create_batch_tickets_modal'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th>機票單號</th>
            <th>地區</th> 
            <th>促銷主題</th>
            <th>起始顯示日期</th>
            <th>截止顯示日期</th>
            <th>航班出發日期</th>
            <th>航班回程日期</th>
            <th>售票說明</th>
            <th>訂票專線</th>
            <th>票價</th>
            <th>內容</th>
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
            <td class="content">{{$Ticket->content}}</td>
            <!--hidden td-->
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
            // get data from the table
            var prefix_selector = "tr[id="+idClicked+"]";
            var region = $(prefix_selector+" td[class='region']").text();
            var topic = $(prefix_selector+" td[class='topic']").text();
            var started_at = $(prefix_selector+" td[class='started_at']").text();
            var ended_at = $(prefix_selector+" td[class='ended_at']").text();
            var depart_date = $(prefix_selector+" td[class='depart_date']").text();
            var return_date = $(prefix_selector+" td[class='return_date']").text();
            var sales_instruction = $(prefix_selector+" td[class='sales_instruction']").text();
            var sales_tel = $(prefix_selector+" td[class='sales_tel']").text();
            var price = $(prefix_selector+" td[class='price']").text();
            var content = $(prefix_selector+" td[class='content']").text();
            var hypertext = $(prefix_selector+" td[class='hypertext']").text();
            var editor_input = $(prefix_selector+" td[class='editor_input']").text();
            // fill the edit modal
            var modal = $(this);
            modal.find('form').attr('action','/tickets/'+idClicked+'/update');
            modal.find('input[name="region"]').val(region);
            modal.find('input[name="topic"]').val(topic);
            modal.find('input[name="depart_date"]').val(depart_date);
            modal.find('input[name="return_date"]').val(return_date);
            modal.find('input[name="started_at"]').val(started_at);
            modal.find('input[name="ended_at"]').val(ended_at);
            modal.find('input[name="sales_instruction"]').val(sales_instruction);
            modal.find('input[name="sales_tel"]').val(sales_tel);
            modal.find('input[name="price"]').val(price);
            modal.find(':radio[name="content"][value='+content+']').prop('checked',true);
            toggleContentView(content);
            modal.find('input[name="hypertext"]').val(hypertext);
            CKEDITOR.instances['update_editor'].setData(editor_input);
            modal.find('.update-error-message').empty();
        }
    })
    // clean content in create modal
    $('#create_tickets_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            modal.find('input[name="region"]').val("");
            modal.find('input[name="topic"]').val("");
            modal.find('input[name="started_at"]').val("");
            modal.find('input[name="ended_at"]').val("");
            modal.find('input[name="depart_date"]').val("");
            modal.find('input[name="return_date"]').val("");
            modal.find('input[name="sales_instruction"]').val("");
            modal.find('input[name="sales_tel"]').val("");
            modal.find('input[name="price"]').val("");
            modal.find(':radio[name="content"]').prop('checked',false);
            modal.find('input[name="hypertext"]').val("");
            CKEDITOR.instances['create_editor'].setData("");
            modal.find('.create-error-message').empty();
            toggleContentView("");
        }
    })
</script>
@endsection