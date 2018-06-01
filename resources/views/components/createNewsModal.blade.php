@extends('components.masterModal')
@section('modal_title','建立「最新消息」')
@section('modal_content')
    @include('components.navTabs')
    <form action="/news/create" method="post" enctype="multipart/form-data">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="create-basic-info" role="tabpanel" aria-labelledby="home-tab">
                @include('components.newsBasicInfo')
                <button type="submit" class="btn btn-primary">新增</button>
                <div class="create-error-message"></div>
            </div>
            <div class="tab-pane fade" id="create-content" role="tabpanel" aria-labelledby="profile-tab">
                @include('components.navContent')
                <div class="row content-field">
                    <textarea id="create_editor" name="editor_input" class="form-control">{{Input::old('editor_input')}}</textarea>
                </div>
            </div>
        </div>
        <!--CSRF欄位-->{{csrf_field()}}
    </form>
@overwrite