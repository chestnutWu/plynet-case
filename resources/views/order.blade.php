@extends('layouts.layout')
@section('toolbar')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">訂單查詢</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a><span class="glyphicon glyphicon-edit"></span> 編輯訂單</a></li>
            <li>         
                <!-- Rounded switch -->
                <label class="switch">
                    <input type="checkbox" id="edit-checkbox">
                    <span class="slider round"></span>
                </label>
            </li>
        </ul>
        @include('components.toolbarComponent')
      </div>
</nav>
@endsection
@section('content')
<table class="table table-striped table-hover col-md-12">
    <thead>
        <tr class="info">
            <th>訂單標號</th>
            <th>顧客姓名</th> 
            <th>顧客地址</th>
            <th>連絡電話</th>
            <th>顧客信箱</th> 
            <th>訂購日期</th>
            <th hidden="true">截止日期</th>
            <th>訂單狀態</th>
            <th>項目</th>
            <th>數量</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Orders as $Order)
        <tr id="{{$Order->id}}">
            <td class="order_number">{{$Order->order_number}}</td>
            <td class="name">{{$Order->name}}</td>
            <td class="address">{{$Order->address}}</td>
            <td class="tel">{{$Order->tel}}</td>
            <td class="email">{{$Order->email}}</td>
            <td class="created_at">{{$Order->created_at}}</td>
            <td class="ended_at" hidden="true">{{$Order->ended_at}}</td>
            <form method="post" enctype="multipart/form-data">
                {{method_field('PUT')}}
                <td class="status">
                    <select name="status" class="selectpicker" data-width="auto" id="{{$Order->id}}" disabled>
                        <option value="尚未繳費" data-icon="glyphicon glyphicon-remove" {{$Order->status=='尚未繳費'?'selected':''}}>尚未繳費</option>
                        <option value="已付款" data-icon="glyphicon glyphicon-check" {{$Order->status=='已付款'?'selected':''}}>已付款</option>
                        <option value="已出貨" data-icon="glyphicon glyphicon-share" {{$Order->status=='已出貨'?'selected':''}}>已出貨</option>
                    </select>
                </td>
                <!--CSRF欄位-->{{csrf_field()}}
            </form>
            <td class="item">{{$Order->item}}</td>
            <td class="amount">{{$Order->amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--分頁頁數按鈕-->
<center>{{$Orders->links()}}</center>
@endsection
@section('page-script')
<script type="text/javascript">
$(".selectpicker").change(function(){
    var id = this.id;
    var value = this.value;
    $('tr[id='+id+'] form').attr('action','/orders/'+id+'/update/'+value);
    $('tr[id='+id+'] form').submit();
});
$("#edit-checkbox").change(function(){
    if($(this).is(":checked")){
        //$('.selectpicker').removeProp('disabled');
        $('.selectpicker').prop("disabled", false);
        //$('.selectpicker').removeAttr("disabled");
        $('.selectpicker').selectpicker('refresh');
        console.log("hi");
    }else{
        $('.selectpicker').prop('disabled',true);
        $('.selectpicker').selectpicker('refresh');
        console.log("bye");
    }
});  
</script>
@endsection