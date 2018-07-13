@extends('components.modal.masterModal')
@section('modal_title',"{$modal_title}")
@section('modal_content')
    @include('components.modal.modalTabs')
    <form action="/{{$create_route}}/create" method="post" enctype="multipart/form-data">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="create-basic-info" role="tabpanel" aria-labelledby="home-tab">
                @include("components.{$basic_info_folder}.basicInfo")
                <button type="submit" class="btn btn-primary">新增</button>
                <div class="create-error-message"></div>
            </div>
            <div class="tab-pane fade" id="create-content" role="tabpanel" aria-labelledby="profile-tab">
                @include('components.modal.modalContent')
                <div class="row content-field">
                    <textarea id="create_editor" name="editor_input" class="form-control">{{Input::old('editor_input')}}</textarea>
                </div>
            </div>
        </div>
        <!--CSRF欄位-->{{csrf_field()}}
    </form>
@overwrite