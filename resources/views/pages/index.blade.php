@extends('layouts.app')

@section('content')
    <div class="row mx-auto">
        <h1 class="h5  mx-auto mb-4 col-md-8">投稿一覧</h1>
        <ul class="list-group list-group-flush col-md-8 mx-auto">
            <li class="list-group-item py-3 list-group-item-action">
                <a class="link-dark link-underline-opacity-0" href="">
                    <span class="link-dark fs-5 fw-bolder d-block">投稿タイトル</span>
                    <span class="d-block">投稿者</span>
                    <div class="row w-50">
                        <time class="col">2024.06.20</time>
                        <i class="bi bi-suit-heart-fill col"></i>
                    </div>
                </a>
            </li>
            <li class="list-group-item py-3 list-group-item-action">
                <a class="link-dark link-underline-opacity-0" href="">
                    <span class="link-dark fs-5 fw-bolder d-block">投稿タイトル</span>
                    <span class="d-block">投稿者</span>
                    <div class="row w-50">
                        <time class="col">2024.06.20</time>
                        <i class="bi bi-suit-heart-fill col"></i>
                    </div>
                </a>
            </li>
            <li class="list-group-item py-3 list-group-item-action">
                <a class="link-dark link-underline-opacity-0" href="">
                    <span class="link-dark fs-5 fw-bolder d-block">投稿タイトル</span>
                    <span class="d-block">投稿者</span>
                    <div class="row w-50">
                        <time class="col">2024.06.20</time>
                        <i class="bi bi-suit-heart-fill col"></i>
                    </div>
                </a>
            </li>
        </ul>

    </div>

    {{-- モーダル --}}
    <button type="button" class="btn btn-primary position-fixed bottom-0 end-0 rounded-circle"
        style="margin-bottom: 20px; margin-right:20px" data-bs-toggle="modal" data-bs-target="#exampleModal">
        +
    </button>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">新規投稿</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="post_title">投稿タイトル</label>
                    <input class="form-control mb-4" type="text" name="post_title" id="">
                    <label for="post_content">投稿内容</label>
                    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-primary">投稿</button>
                </div>
            </div>
        </div>
    </div>
@endsection
