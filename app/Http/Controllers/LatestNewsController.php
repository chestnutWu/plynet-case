<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DataEntity\LatestNews;
use Image;
use Validator;
use Session;

class LatestNewsController extends Controller
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
        'ended_at'=>[
            'required',
            'date',
            'after:today'
        ]
    ];
    //顯示「最新消息」資料
    public function latestNewsPageList()
    {
        //撈取「最新消息」資料
        $News = LatestNews::all();
        $binding = ['title'=>'管理平台',
                    'News'=>$News];
        return view('latestNews',$binding);
    }
    //新增「最新消息」
    public function latestNewsCreate(){
        //接收表單資料
        $input = request()->all();
        $validator = Validator::make($input,$this->rules);
        if($validator->fails()){
            Session::flash('create_error',true);
            return redirect('/latestNews')->withErrors($validator)->withInput();
        }
        //儲存照片
        $picture = $input['picture'];
        $file_extension = $picture->getClientOriginalExtension();
        $file_name = uniqid().'.'.$file_extension;
        $file_relative_path = 'images/News/'.$file_name;
        $file_path = public_path($file_relative_path);
        $image = Image::make($picture)->fit(300,150)->save($file_path);
        $input['picture'] = $file_relative_path;
        //判斷內文選項
        if($input['content'] == '無內文'){
            $input['hypertext'] = null;
            $input['editor_input'] = null;
        }else if($input['content'] == '超連結內文'){
            $input['editor_input'] = null;
        }else{//如輸入內容
            $input['hypertext'] = null;
        }
        //新增「最新消息」資料
        $LatestNews = LatestNews::create($input);
        return redirect('/latestNews');
    }
    //更新「最新消息」
    public function latestNewsUpdate($news_id){
        $LatestNews = LatestNews::findOrFail($news_id);
        $input = request()->all();
        $update_rules = array_except($this->rules,['picture']);
        $update_rules = array_add($update_rules,'picture',['file','image','max:10240']);
        $validator = Validator::make($input,$update_rules);
        if($validator->fails()){
            Session::flash('update_error',true);
            session()->put('update_id',$news_id);
            return redirect('/latestNews')->withErrors($validator)->withInput();
        }
        if(request()->hasFile('picture')){
            $picture = $input['picture'];
            $file_extension = $picture->getClientOriginalExtension();
            $file_name = uniqid().'.'.$file_extension;
            $file_relative_path = 'images/News/'.$file_name;
            $file_path = public_path($file_relative_path);
            $image = Image::make($picture)->fit(300,150)->save($file_path);
            $input['picture'] = $file_relative_path;
        }
        //判斷內文選項
        if($input['content'] == '無內文'){
            $input['hypertext'] = null;
            $input['editor_input'] = null;
        }else if($input['content'] == '超連結內文'){
            $input['editor_input'] = null;
        }else{//如輸入內容
            $input['hypertext'] = null;
        }
        $LatestNews->update($input);
        return redirect('/latestNews');
    }
    //刪除「最新消息」
    public function latestNewsDelete($news_id){
        $News = LatestNews::find($news_id);
        $News->delete();
    }
}