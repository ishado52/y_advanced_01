@extends('layouts.app')

@section('content')
    <div class="row mx-auto">
        @auth
            <p>ログイン中のユーザー: {{ Auth::user()->id }}</p>
        @else
            <p>ゲスト</p>
        @endauth

        <h1 class="h5 fw-bolder mx-auto mb-4 col-md-8">{{ $post->title }}</h1>

        <ul class="list-group list-group-flush col-md-8 mx-auto mb-4">
            <li class="list-group-item py-3">
                <span class="d-block">{{ $post->user->name }}</span>
                <div class="row w-50">
                    <time class="col">{{ $post->created_at }}</time>
                    <i class="bi bi-suit-heart-fill col"></i>
                    <i class="bi bi-pencil-fill col" data-bs-toggle="modal" data-bs-target="#editPostModal"></i>
                    <i class="bi bi-trash-fill col" data-bs-toggle="modal" data-bs-target="#deletePostModal"></i>
                </div>
                <p>
                    {{ $post->comment }}
                </p>
            </li>
            @foreach ($comments as $comment)
                <li class="list-group-item py-3">
                    <span class="d-block">{{ $comment->user->name }}</span>
                    <div class="row w-50">
                        <time class="col">{{ $comment->created_at }}</time>
                        <i class="bi bi-pencil-fill col"></i>
                        <i class="bi bi-trash-fill col"></i>
                    </div>
                    <p>
                        {{ $comment->comment }}
                    </p>
                </li>
            @endforeach
        </ul>
        <form action="" class="col-md-8 mx-auto mb-4">
            <textarea class="form-control mb-4" name="" id="" cols="30" rows="10" placeholder="コメント内容"></textarea>
            <input type="button" class="btn btn-primary w-100" value="書き込み">
        </form>
    </div>

    {{-- 投稿削除モーダル --}}
    <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPostModalLabel">投稿削除</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    この投稿を削除しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-danger" id="btn_submit">削除</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 投稿編集モーダル --}}
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePostModalLabel">投稿編集</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="title">投稿タイトル</label>
                    <input class="form-control mb-4" type="text" name="title" id="input_title"
                        value="{{ $post->title }}">
                    <label for="comment">投稿内容</label>
                    <textarea class="form-control" name="comment" id="input_comment" cols="30" rows="10">{{ $post->comment }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-primary" id="btn_submit">更新</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // 作成した投稿をajaxでpost
        // ajaxで投稿
        document.addEventListener('DOMContentLoaded', function() {
            var btnSubmit = document.getElementById('btn_submit');

            btnSubmit.addEventListener('click', function() {
                var title = document.getElementById('input_title').value;
                var comment = document.getElementById('input_comment').value;

                // CSRFトークンを取得
                var token = document.head.querySelector('meta[name="csrf-token"]').content;

                // Ajaxリクエストの設定
                var xhr = new XMLHttpRequest();
                var url = '{{ route('posts.store') }}';
                var params = 'title=' + title + '&comment=' + comment + '&user_id=' +
                    {{ Auth::user()->id }};
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);

                xhr.onreadystatechange = () => {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            var response = JSON.parse(xhr.responseText);
                            console.log(response);
                            alert('投稿成功');
                        } else {
                            console.error(xhr.responseText);
                            alert('投稿失敗');
                        }
                    }
                };

                xhr.send(params);
            });
        });
    </script>
@endsection
