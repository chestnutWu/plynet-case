<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DataEntity\News;
use Image;
use Validator;
use Session;
use DB;

class NewsController extends Controller
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
        ],
        'content'=>[
            'required'
        ]
    ];
    //顯示「最新消息」資料
    public function newsPageList()
    {
        //撈取「最新消息」資料
        $row_per_page = 10;
        $NewsPaginate = News::OrderBy('created_at','desc')->paginate($row_per_page);;
        //$Orders = DB::connection('remotemysql')->table('orders')->get();
        $binding = ['News'=>$NewsPaginate];
        return view('news',$binding);
    }
    //新增「最新消息」
    public function newsCreate(){
        //接收表單資料
        $input = request()->all();
        $validator = Validator::make($input,$this->rules);
        if($validator->fails()){
            Session::flash('create_error',true);
            return redirect('/news')->withErrors($validator)->withInput();
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
        $LatestNews = News::create($input);
        return redirect('/news');
    }
    //更新「最新消息」
    public function newsUpdate($news_id){
        $LatestNews = News::findOrFail($news_id);
        $input = request()->all();
        $update_rules = array_except($this->rules,['picture']);
        $update_rules = array_add($update_rules,'picture',['file','image','max:10240']);
        $validator = Validator::make($input,$update_rules);
        if($validator->fails()){
            Session::flash('update_error',true);
            session()->put('update_id',$news_id);
            return redirect('/news')->withErrors($validator)->withInput();
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
        return redirect('/news');
    }
    //刪除「最新消息」
    public function newsDelete($news_id){
        $News = News::find($news_id);
        $News->delete();
    }
}