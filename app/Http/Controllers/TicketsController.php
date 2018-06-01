<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DataEntity\Ticket;
use Validator;
use DB;
use Session;
use DateTime;

class TicketsController extends Controller
{
    //驗證規則
    private $rules = 
    [
        'region'=>[
            'required',
            'max:10'
        ],
        'topic'=>[
            'required',
            'max:25'
        ],
        'started_at'=>[
            'required',
        ],
        'ended_at'=>[
            'required',
            'after:started_at'
        ],
        'depart_date'=>[
            'required',
            'after:ended_at'
        ],
        'return_date'=>[
            'required',
            'after:depart_date'
        ],
        'sales_instruction'=>[
            'required',
        ],
        'sales_tel'=>[
            'required',
        ],
        'price'=>[
            'required',
            'integer'
        ],
        'content'=>[
            'required'
        ]
    ];
    //顯示「特價清倉」
    public function ticketsPageList(){
        $row_per_page = 10;
        $TicketPaginate = Ticket::OrderBy('created_at','desc')->paginate($row_per_page);;
        $binding = ['Tickets'=>$TicketPaginate];
        return view('tickets',$binding);
    }
    //建立「特價清倉」
    public function ticketsCreate(){
        $input = request()->all();//接收表單資料
        $validator = Validator::make($input,$this->rules);
        if($validator->fails()){
            Session::flash('create_error',true);
            return redirect('/tickets')->withErrors($validator)->withInput();
        }
        $input = $this->createTicketNumber($input);//產生機票編號
        $input = $this->judgeSelectedContent($input);//判斷內文選項
        Ticket::create($input);//新增「特價清倉」資料
        return redirect('/tickets');
    }
    
    public function ticketsBatchCreate(){
        $output = implode(",",request()->all());
        $binding = ['test'=>$output];
        return redirect('/',$binding);
    }
    //刪除「特價清倉」
    public function ticketsDelete($ticket_id){
        $Ticket = Ticket::find($ticket_id);
        $Ticket->delete();
    }
    //更新「特價清倉」
    public function ticketsUpdate($ticket_id){
        $Ticket = Ticket::findOrFail($ticket_id);
        $input = request()->all();
        $validator = Validator::make($input,$this->rules);
        if($validator->fails()){
            Session::flash('update_error',true);
            session()->put('update_id',$ticket_id);
            return redirect('/tickets')->withErrors($validator)->withInput();
        }
        $input = $this->judgeSelectedContent($input);
        $Ticket->update($input);
        return redirect('/tickets');
    }
    /*self define function*/
    //自動產生機票單號
    public function createTicketNumber($input){
        $last_ticket = Ticket::OrderBy('created_at','desc')->first();
        $nowDate = date("Ymd");
        if(!$last_ticket){ //資料庫中沒有機票資料
            $input['ticket_number'] = $nowDate."001";
        }else{
            $last_ticket_date = substr(str_replace("-","",$last_ticket->created_at),0,8);
            if((int)$nowDate>(int)$last_ticket_date){//新的一天
                $input['ticket_number'] = $nowDate."001";
            }else{
                $input['ticket_number'] = (string)(floatval($last_ticket->ticket_number)+1);
            }
        }
        return $input;
    }
    public function judgeSelectedContent($input){
        if($input['content'] == '無內文'){
            $input['hypertext'] = null;
            $input['editor_input'] = null;
        }else if($input['content'] == '超連結內文'){
            $input['editor_input'] = null;
        }else{//如輸入內容
            $input['hypertext'] = null;
        }
        return $input;
    }
    /**/
}