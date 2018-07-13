@extends('components.modal.masterModal')
@section('modal_title')<h1>批量建立「特價機票」</h1>@overwrite
@section('modal_content')
    <div class="tab">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">地區:</label>
                <input type="text" class="form-control" name="region" value="{{old('region')}}">
                <div class="validation-msg"></div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label">促銷主題:</label><br>
                <input type="text" class="form-control" name="topic" value="{{old('topic')}}">
                <div class="validation-msg"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">訂票專線:</label>
                <input type="text" class="form-control" name="sales_tel" value="{{old('sales_tel')}}">
                <div class="validation-msg"></div>
            </div>
        </div>
    </div>
    <div class="tab">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">起始顯示日期:</label>
                <input type="date" class="form-control" name="started_at" value="{{old('started_at')}}">
                <div class="validation-msg"></div>
            </div>
            <div class="form-group col-md-6">
                <label for="ended_at" class="col-form-label">截止顯示日期:</label>
                <input type="date" class="form-control" name="ended_at" value="{{old('ended_at')}}">
                <div class="validation-msg"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">航班出發日期:</label>
                <input type="date" class="form-control" name="depart_date" value="{{old('depart_date')}}">
                <div class="validation-msg"></div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label">航班回程日期:</label>
                <input type="date" class="form-control" name="return_date" value="{{old('return_date')}}">
                <div class="validation-msg"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="col-form-label">售票說明:</label>
                <input type="text" class="form-control" name="sales_instruction" value="{{old('sales_instruction')}}">
                <div class="validation-msg"></div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label">票價:</label>
                <input type="text" class="form-control" name="price" value="{{old('price')}}">
                <div class="validation-msg"></div>
            </div>
        </div>
        <div class="row">
            <label class="col-form-label">內容:</label>
            <textarea id="create_batch_editor" name="editor_input" class="form-control">{{Input::old('editor_input')}}</textarea>
        </div>
    </div>
    <div class="tab">
        <table id="preview_table" class="table table-hover">
            <thead>
                <tr>
                    <th>地區</th>
				    <th>起始顯示</th>
                    <th>截止顯示</th>
                    <th>航班出發</th>
				    <th>航班回程</th>
                    <th>票價</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">前一步</button>
            <button type="button" id="batchBtn" onclick="addBatch()">加入批量</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">下一步</button>
            <button type="button" id="submitBtn" onclick="nextPrev(1)">新增至資料庫</button>
        </div>
    </div>
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
@overwrite