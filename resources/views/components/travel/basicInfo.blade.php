<div class="row">
    <div class="form-group col-md-4">
        <label class="col-form-label">景點:</label>
        <input type="text" class="form-control" name="name" value="{{old('name')}}">
    </div>
    <div class="form-group col-md-4">
        <label class="col-form-label">區域:</label><br>
        <input type="text" class="form-control" name="region" value="{{old('region')}}">
    </div>
    <div class="form-group col-md-4">
        <label class="col-form-label">地址:</label>
        <input type="text" class="form-control" name="address" value="{{old('address')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">圖標</label>
        <input type="text" class="form-control" name="icon" value="{{old('icon')}}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">分類:</label>
        <input type="text" class="form-control" name="classification" value="{{old('classification')}}">
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