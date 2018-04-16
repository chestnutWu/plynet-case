<!--Edit Modal -->
@extends('components.masterModal')
@section('modal_title')<h1>編輯「最新消息」</h1>@overwrite
@section('modal_content')
    @include('components.editForm')
    <div class="edit-error-message"></div>
@overwrite