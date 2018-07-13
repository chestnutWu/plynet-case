@extends('components.modal.masterModal')
@section('modal_title')<h1>{{$modal_title}}</h1>@overwrite
@section('modal_content')
    <p>{{$confirm_message}}</p>
    <button type="submit" class="btn btn-danger deleteBtn" data-dismiss="modal">刪除</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
@overwrite