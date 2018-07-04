<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataEntity\Travel;
use Validator;
use Session;

class TravelsController extends Controller
{
    //驗證規則
    private $rules = 
    [
        'name'=>[
            'required',
            'max:20'
        ],
        'region'=>[
            'required',
            'max:20'
        ],
        'address'=>[
            'required',
            'max:30'
        ],
        'icon'=>[
            'required',
        ],
        'classification'=>[
            'required',
            'max:20'
        ],
        'longitude'=>[
            'required',
            'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'
        ],
        'latitude'=>[
            'required',
            'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'
        ],
        'phone_number'=>[
            'required',
        ],
        'sales_tel'=>[
            'required',
        ],
        'content'=>[
            'required'
        ]
    ];
    //顯示「出去走走」資料
    public function travelsPageList(){
        $row_per_page = 10;
        $TravelsPaginate = Travel::OrderBy('created_at','desc')->paginate($row_per_page);
        $binding = ['Travels'=>$TravelsPaginate];
        return view('travels',$binding);
    }
    //建立「出去走走」
    public function travelCreate(){
        $input = request()->all();
        $validator = Validator::make($input,$this->rules);
        if($validator->fails()){
            Session::flash('create_error',true);
            return redirect('/travels')->withErrors($validator)->withInput();
        }
        $input = $this->judgeSelectedContent($input);//判斷內文選項
        Travel::create($input);//新增「特價清倉」資料
        return redirect('/travels');
    }
    //更新「出去走走」
    public function travelUpdate($travel_id){
        $Travel = Travel::findOrFail($travel_id);
        $input = request()->all();
        $validator = Validator::make($input,$this->rules);
        if($validator->fails()){
            Session::flash('update_error',true);
            session()->put('update_id',$travel_id);
            return redirect('/travels')->withErrors($validator)->withInput();
        }
        $input = $this->judgeSelectedContent($input);
        $Travel->update($input);
        return redirect('/travels');
    }
    
    //刪除「出去走走」
    public function travelDelete($travel_id){
        $Travel = Travel::find($travel_id);
        $Travel->delete();
    }
    
    /*self define function*/
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