<div class="form-goup row">
    <label class="col-sm-2 col-form-label-lg">內文選擇:</label>
    <div class="col-sm-10">
        <div class="form-check form-check-inline">
            <input class="form-check-input no-content" type="radio" name="content" value="無內文"  {{(old('content') == "無內文")?'checked':''}}>
            <label class="form-check-label">無內文</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input hypertext-content" type="radio" name="content" value="超連結內文" {{(old('content') == "超連結內文")?'checked':''}}>
            <label class="form-check-label">超連結內文</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input input-content" type="radio" name="content" value="如以下輸入" {{(old('content') == "如以下輸入")?'checked':''}}>
            <label class="form-check-label">如以下輸入</label>
        </div>
    </div>
</div>
<div class="form-goup row">
    <div class="hyper-link-field" hidden="true">
        <label class="col-sm-2 col-form-label-lg">超連結:</label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <input type="text" class="form-control" name="hypertext" value="{{old('hypertext')}}" placeholder="http://">
            </div>
        </div>
    </div>
    <div class="content-field" hidden="true">
        <label class="col-sm-2 col-form-label-lg">輸入內容:</label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <textarea id="{{$editor}}" name="editor_input" class="form-control">{{Input::old('editor_input')}}</textarea>
            </div>
        </div>
    </div>
</div>