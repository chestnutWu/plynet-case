@extends('layouts.layout')
@section('toolbar')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">出去走走</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#" data-toggle="modal" data-target="#create_travel_modal"><span class="glyphicon glyphicon-plus"></span> 新增景點</a></li>
            <li><a target="_blank" rel="noopener noreferrer" href="https://code.essoduke.org/gmap/"><span class="glyphicon glyphicon-transfer"></span> 地址經緯度轉換</a></li>
        </ul>
        @include('components.toolbar')
    </div>
</nav>
@endsection
@section('content')
    @include('components.travel.createModal',['modal_id'=>'create_travel_modal'])
    @include('components.travel.updateModal',['modal_id'=>'update_travel_modal'])
    @include('components.travel.deleteModal',['modal_id'=>'delete_travel_modal'])
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th id="region">區域</th>
            <th id="name">景點</th>
            <th id="classification">分類</th>
            <th id="address">地址</th>
            <th id="longitude">經度</th>
            <th id="latitude">緯度</th>
            <th id="phone_number">連絡電話</th>
            <th id="sales_tel">售票專線</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($Travels as $TravelRow)
        <tr id="{{$TravelRow->id}}">
            <td class="region">{{$TravelRow->region}}</td>
            <td class="name">{{$TravelRow->name}}</td>
            <td class="classification">{{$TravelRow->classification}}</td>
            <td class="address">{{$TravelRow->address}}</td>
            <td class="longitude">{{$TravelRow->longitude}}</td>
            <td class="latitude">{{$TravelRow->latitude}}</td>
            <td class="phone_number">{{$TravelRow->phone_number}}</td>
            <td class="sales_tel">{{$TravelRow->sales_tel}}</td>
            <!--hidden td-->
            <td class="content" hidden="true">{{$TravelRow->content}}</td>
            <td class="hypertext" hidden="true">{{$TravelRow->hypertext}}</td>
            <td class="editor_input" hidden="true">{{$TravelRow->editor_input}}</td>
            <td>
                <button type="button" class="btn btn-danger delete_record_id" id="{{$TravelRow->id}}" data-toggle="modal" data-target="#delete_travel_modal">刪除</button>
                <button type="button" class="btn btn-warning update_record_id" id="{{$TravelRow->id}}" data-toggle="modal" data-target="#update_travel_modal">編輯</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--分頁頁數按鈕-->
<center>{{$Travels->links()}}</center>
@endsection

@section('page-script')

<!--display validation error messages--> 
@include('components.validationErrorMessage',['createModal'=>'create_travel_modal','updateModal'=>'update_travel_modal','updateRoute'=>'travels'])

<script type="text/javascript">
    CKEDITOR.replace('create_editor');
    CKEDITOR.replace('update_editor');
    // initalize info row column to columns[]
    var columns = [];
    $('tr[class="info"]:nth-child(1) th').each(function(){columns.push(this.id);});
    // console.log(columns);
    // handle delete button
    $(".deleteBtn").click({route: "travels"},ajaxDeleteFunction);
    // handle update button
    $('#update_travel_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ //if caused by update button click
            // get data from the table
            var prefix_selector = "tr[id="+idClicked+"]";
            var region = $(prefix_selector+" td[class='region']").text();
            var name = $(prefix_selector+" td[class='name']").text();
            var classification = $(prefix_selector+" td[class='classification']").text();
            var address = $(prefix_selector+" td[class='address']").text();
            var longitude = $(prefix_selector+" td[class='longitude']").text();
            var latitude = $(prefix_selector+" td[class='latitude']").text();
            var phone_number = $(prefix_selector+" td[class='phone_number']").text();
            var sales_tel = $(prefix_selector+" td[class='sales_tel']").text();
            var content = $(prefix_selector+" td[class='content']").text();
            var hypertext = $(prefix_selector+" td[class='hypertext']").text();
            var editor_input = $(prefix_selector+" td[class='editor_input']").text();
            // fill the edit modal
            var modal = $(this);
            modal.find('form').attr('action','/travels/'+idClicked+'/update');
            modal.find('input[name="name"]').val(name);
            modal.find('input[name="region"]').val(region);
            modal.find('input[name="classification"]').val(classification);
            modal.find('input[name="address"]').val(address);
            modal.find('input[name="longitude"]').val(longitude);
            modal.find('input[name="latitude"]').val(latitude);
            modal.find('input[name="phone_number"]').val(phone_number);
            modal.find('input[name="sales_tel"]').val(sales_tel);
            modal.find(':radio[name="content"][value='+content+']').prop('checked',true);
            toggleContentView(content);
            modal.find('input[name="hypertext"]').val(hypertext);
            CKEDITOR.instances['update_editor'].setData(editor_input);
            modal.find('.update-error-message').empty();
        }
    })
    // clean content in create modal
    $('#create_travel_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            for(var i=0;i<columns.length-1;i++){
                modal.find('input[name='+columns[i]+']').val("");
            }
//            modal.find('input[name="name"]').val("");
//            modal.find('input[name="region"]').val("");
//            modal.find('input[name="classification"]').val("");
//            modal.find('input[name="address"]').val("");
//            modal.find('input[name="longitude"]').val("");
//            modal.find('input[name="latitude"]').val("");
//            modal.find('input[name="phone_number"]').val("");
//            modal.find('input[name="sales_tel"]').val("");
            modal.find(':radio[name="content"]').prop('checked',false);
            modal.find('input[name="hypertext"]').val("");
            modal.find('.create-error-message').empty();
            CKEDITOR.instances['create_editor'].setData("");
            toggleContentView("");
        }
    })
</script>
@endsection