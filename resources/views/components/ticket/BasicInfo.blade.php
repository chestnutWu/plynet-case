<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">地區:</label>
        <input type="text" class="form-control" name="region" value="{{old('region')}}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">促銷主題:</label><br>
        <input type="text" class="form-control" name="topic" value="{{old('topic')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">起始顯示日期:</label>
        <input type="date" class="form-control" name="started_at" value="{{old('started_at')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="ended_at" class="col-form-label">截止顯示日期:</label>
        <input type="date" class="form-control" name="ended_at" value="{{old('ended_at')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">航班出發日期:</label>
        <input type="date" class="form-control" name="depart_date" value="{{old('depart_date')}}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">航班回程日期:</label>
        <input type="date" class="form-control" name="return_date" value="{{old('return_date')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">售票說明:</label>
        <input type="text" class="form-control" name="sales_instruction" value="{{old('sales_instruction')}}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">票價:</label>
        <input type="text" class="form-control" name="price" value="{{old('price')}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">機票單號:</label>
        <input type="text" class="form-control" name="ticket_number" value="{{old('ticket_number')}}" placeholder="自動產生" disabled>
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">訂票專線:</label>
        <input type="text" class="form-control" name="sales_tel" value="{{old('sales_tel')}}">
    </div>
</div>
<button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>