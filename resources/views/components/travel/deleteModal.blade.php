<!--Delete Modal -->
@extends('components.masterModal')
@section('modal_title')<h1>刪除「出去走走」</h1>@overwrite
@section('modal_content')
    <p>確定刪除此「出去走走」?</p>
    <button type="submit" class="btn btn-danger deleteBtn" data-dismiss="modal">刪除</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
@overwrite