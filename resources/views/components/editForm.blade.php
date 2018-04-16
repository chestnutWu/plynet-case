<form method="post" enctype="multipart/form-data">
    {{method_field('PUT')}}
    <div class="row">
        <div class="form-group col-md-7">
            <label for="title" class="col-form-label">標題:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group col-md-3">
            <label for="classification" class="col-form-label">分類:</label><br>
            <select class="selectpicker" name="classification">
                <option value="最新消息" {{Input::old('classification')=='最新消息'?'selected':''}}>最新消息</option>
                <option value="旅遊必備" {{Input::old('classification')=='旅遊必備'?'selected':''}}>旅遊必備</option>
                <option value="旅遊資訊" {{Input::old('classification')=='旅遊資訊'?'selected':''}}>旅遊資訊</option>
                <option value="出去走走" {{Input::old('classification')=='出去走走'?'selected':''}}>出去走走</option>
                <option value="購物測試" {{Input::old('classification')=='購物測試'?'selected':''}}>購物測試</option>
                <option value="特價清倉" {{Input::old('classification')=='特價清倉'?'selected':''}}>特價清倉</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="picture" class="col-form-label">圖片:</label>
            <input type="file" name="picture" id="picture">
            <img id="image">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="ended_at" class="col-form-label">截止日期:</label>
            <input type="date" class="form-control" id="end_date" name="ended_at" value="{{old('ended_at')}}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="introduction" class="col-form-label">介紹:</label>
            <textarea class="form-control" id="introduction" name="introduction">{{Input::old('introduction')}}</textarea>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary updateBtn">儲存變更</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
    <!--CSRF欄位-->{{csrf_field()}}
</form>