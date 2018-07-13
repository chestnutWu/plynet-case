<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">區域:</label><br>
        <input type="text" class="form-control" name="region" value="{{old('region')}}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">景點:</label>
        <input type="text" class="form-control" name="name" value="{{old('name')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-5">
        <label for="classification" class="col-form-label">分類:</label><br>
        <select class="selectpicker" name="classification">
            <option value="車站" {{Input::old('classification')=='車站'?'selected':''}}>車站</option>
            <option value="機場" {{Input::old('classification')=='機場'?'selected':''}}>機場</option>
            <option value="景點" {{Input::old('classification')=='景點'?'selected':''}}>景點</option>
            <option value="美食(區)" {{Input::old('classification')=='美食(區)'?'selected':''}}>美食(區)</option>
            <option value="場館" {{Input::old('classification')=='場館'?'selected':''}}>場館</option>
            <option value="購物區/商城" {{Input::old('classification')=='購物區/商城'?'selected':''}}>購物區/商城</option>
            <option value="溫泉" {{Input::old('classification')=='溫泉'?'selected':''}}>溫泉</option>
            <option value="遊樂園區" {{Input::old('classification')=='遊樂園區'?'selected':''}}>遊樂園區</option>
            <option value="住宿" {{Input::old('classification')=='住宿'?'selected':''}}>住宿</option>
            <option value="體驗學習" {{Input::old('classification')=='體驗學習'?'selected':''}}>體驗學習</option>
            <option value="其他" {{Input::old('classification')=='其他'?'selected':''}}>其他</option>
        </select>
    </div>
    <div class="form-group col-md-7">
        <label class="col-form-label">地址:</label>
        <input type="text" class="form-control" name="address" value="{{old('address')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">經度:</label>
        <input type="text" class="form-control" name="longitude" value="{{old('longitude')}}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">緯度:</label>
        <input type="text" class="form-control" name="latitude" value="{{old('latitude')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">連絡電話:</label>
        <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">售票專線:</label>
        <input type="text" class="form-control" name="sales_tel" value="{{old('sales_tel')}}">
    </div>
</div>
<button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>