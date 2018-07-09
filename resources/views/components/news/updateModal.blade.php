@extends('components.masterModal')
@section('modal_title')<h1>更新「最新消息」</h1>@overwrite
@section('modal_content')
    @include('components.modalTabs')
    <form method="post" enctype="multipart/form-data">
        {{method_field('PUT')}}
        <div class="tab-content">
            <div class="tab-pane fade in active" id="update-basic-info" role="tabpanel" aria-labelledby="home-tab">
                @include('components.news.BasicInfo')
                <button type="submit" class="btn btn-primary">儲存變更</button>
                <div class="update-error-message"></div>
            </div>
            <div class="tab-pane fade" id="update-content" role="tabpanel" aria-labelledby="profile-tab">
                @include('components.modalContent')
                <div class="row content-field">
                    <textarea id="update_editor" name="editor_input" class="form-control">{{Input::old('editor_input')}}</textarea>
                </div>
            </div>
        </div>
        <!--CSRF欄位-->{{csrf_field()}}
    </form>
@overwrite