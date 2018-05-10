<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataEntity\Order;

class OrdersController extends Controller
{
    public function ordersPageList(){
        $row_per_page = 10;
        $OrdersPaginate = Order::OrderBy('created_at','desc')->paginate($row_per_page);
        $binding = ['Orders'=>$OrdersPaginate];
        return view('order',$binding);
    }
    public function orderUpdate($order_id,$status){
        Order::where('id',$order_id)->update(array('status'=>$status));
        return redirect('/orders');
    }
}