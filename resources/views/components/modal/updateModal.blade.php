@extends('components.modal.masterModal')
@section('modal_title')<h1>{{$modal_title}}</h1>@overwrite
@section('modal_content')
    @include('components.modal.modalTabs')
    <form method="post" enctype="multipart/form-data">
        {{method_field('PUT')}}
        <div class="tab-content">
            <div class="tab-pane fade in active" id="update-basic-info" role="tabpanel" aria-labelledby="home-tab">
                @include("components.{$basic_info_folder}.basicInfo")
                <button type="submit" class="btn btn-primary">儲存變更</button>
                <div class="update-error-message"></div>
            </div>
            <div class="tab-pane fade" id="update-content" role="tabpanel" aria-labelledby="profile-tab">
                @include('components.modal.modalContent')
                <div class="row content-field">
                    <textarea id="update_editor" name="editor_input" class="form-control">{{Input::old('editor_input')}}</textarea>
                </div>
            </div>
        </div>
        <!--CSRF欄位-->{{csrf_field()}}
    </form>
@overwrite