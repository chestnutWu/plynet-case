<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataEntity\Information;
use Image;
use Validator;
use Session;

class InformationController extends Controller
{
    //驗證規則
    private $rules = 
    [
        'title'=>[
            'required',
            'max:255'
        ],
        'picture'=>[
            'required',
            'file',
            'image',
            'max:10240'//10MB
        ],
        'introduction'=>[
            'required',
            'max:2000'
        ],
        'content'=>[
            'required'
        ]
    ];
    //顯示「旅遊資訊」資料
    public function informationPageList(){
        $row_per_page = 10;
        $InfomationPaginate = Information::OrderBy('created_at','desc')->paginate($row_per_page);
        $binding = ['Infomation'=>$InfomationPaginate];
        return view('travel_info',$binding);
    }
     //建立「旅遊資訊」
    public function informationCreate(){
        $input = request()->all();
        $validator = Validator::make($input,$this->rules);
        if($validator->fails()){
            Session::flash('create_error',true);
            return redirect('/information')->withErrors($validator)->withInput();
        }
        $input = $this->pictureProcess($input);//照片處理
        $input = $this->judgeSelectedContent($input);//判斷內文選項
        Information::create($input);
        return redirect('/information');
    }
    //更新「旅遊資訊」
    public function informationUpdate($information_id){
        $TheInformation = Information::findOrFail($information_id);
        $input = request()->all();
        $update_rules = array_except($this->rules,['picture']);
        $update_rules = array_add($update_rules,'picture',['file','image','max:10240']);
        $validator = Validator::make($input,$update_rules);
        if($validator->fails()){
            Session::flash('update_error',true);
            session()->put('update_id',$item_id);
            return redirect('/information')->withErrors($validator)->withInput();
        }
        if(request()->hasFile('picture')){$input = $this->pictureProcess($input);}//照片處理
        $input = $this->judgeSelectedContent($input);//判斷內文選項
        $TheInformation->update($input);
        return redirect('/information');
    }
    //刪除「旅遊資訊」
    public function informationDelete($information_id){
        $Information = Information::find($information_id);
        $Information->delete();
    }
    /*self define function*/
    public function pictureProcess($input){
        $picture = $input['picture'];
        $file_extension = $picture->getClientOriginalExtension();
        $file_name = uniqid().'.'.$file_extension;
        $file_relative_path = 'images/Items/'.$file_name;
        $file_path = public_path($file_relative_path);
        $image = Image::make($picture)->fit(300,150)->save($file_path);
        $input['picture'] = $file_relative_path;
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
