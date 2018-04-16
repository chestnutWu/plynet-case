<!--Create Modal -->
@extends('components.masterModal')
@section('modal_title','建立「最新消息」')
@section('modal_content')
    @include('components.createForm')
    <div class="create-error-message"></div>
@overwrite