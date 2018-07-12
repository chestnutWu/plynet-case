<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">標題:</label>
        <input type="text" class="form-control" name="title" value="{{old('title')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="picture" class="col-form-label">圖片:</label>
        <input type="file" name="picture">
        <img class="image" height="150" width="240">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="introduction" class="col-form-label">介紹:</label>
        <textarea class="form-control" name="introduction"> {{Input::old('introduction')}}</textarea>
    </div>
</div>
<button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>