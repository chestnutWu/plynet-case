<!--Create Modal -->
@extends('components.masterModal')
@section('modal_title','建立「最新消息」')
@section('modal_content')
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#basic-info-form" role="tab" aria-controls="home" aria-selected="true">基本資訊</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#context" role="tab" aria-controls="profile" aria-selected="false">內文</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade in active" id="basic-info-form" role="tabpanel" aria-labelledby="home-tab">
        @include('components.createForm')
        <div class="create-error-message"></div>
    </div>
    <div class="tab-pane fade" id="context" role="tabpanel" aria-labelledby="profile-tab">
        <div class="form-goup row">
            <label class="col-sm-2 col-form-label-lg">內文選擇:</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="no-content" checked>
                    <label class="form-check-label" for="inlineRadio1">無內文</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="hypertext-content">
                    <label class="form-check-label" for="inlineRadio2">超連結內文</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="as-input-content">
                    <label class="form-check-label" for="inlineRadio3">如以下輸入</label>
                </div>
            </div>
        </div>
        <div class="form-goup row">
            <div class="hyper-link-field" hidden="true">
                <label class="col-sm-2 col-form-label-lg">超連結:</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-control" placeholder="http://">
                    </div>
                </div>
            </div>
            <div class="content-field" hidden="true">
                <label class="col-sm-2 col-form-label-lg">輸入內容:</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <textarea name="editor" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@overwrite