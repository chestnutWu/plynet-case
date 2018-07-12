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
            <th id="region" data-column-type="text">區域</th>
            <th id="name" data-column-type="text">景點</th>
            <th id="classification" data-column-type="text">分類</th>
            <th id="address" data-column-type="text">地址</th>
            <th id="longitude" data-column-type="text">經度</th>
            <th id="latitude" data-column-type="text">緯度</th>
            <th id="phone_number" data-column-type="text">連絡電話</th>
            <th id="sales_tel" data-column-type="text">售票專線</th>
            <th id="content" data-column-type="radio" hidden="true">內文</th>
            <th id="hypertext" data-column-type="text" hidden="true">超連結</th>
            <th id="editor_input" data-column-type="CKEDITOR" hidden="true">編輯器</th>
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
    // handle delete button
    $(".deleteBtn").click({route: "travels"},ajaxDeleteFunction);
    // handle update button
    $('#update_travel_modal').on('show.bs.modal', function(event){
        if(event.relatedTarget){ // if caused by update button click
            var modal = $(this);
            modal.find('form').attr('action','/travels/'+idClicked+'/update');
            initializeModal(modal,'update');
        }
    })
    // clean content in create modal
    $('#create_travel_modal').on('show.bs.modal',function(event){
        if(event.relatedTarget){ // if caused by create button click
            var modal = $(this);
            initializeModal(modal,'create');
        }
    })
</script>
@endsection