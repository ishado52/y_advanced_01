@extends('layouts.app')

@section('content')
    <div class="row mx-auto">
        @auth
            <p>ログイン中のユーザー: {{ Auth::user()->id }}</p>
        @else
            <p>ゲスト</p>
        @endauth

        <h1 class="h5  mx-auto mb-4 col-md-8">投稿一覧</h1>
        <ul class="list-group list-group-flush col-md-8 mx-auto">

            @foreach ($posts as $post)
            <li class="list-group-item py-3 list-group-item-action">
                <a class="link-dark link-underline-opacity-0" href="">
                    <span class="link-dark fs-5 fw-bolder d-block">{{$post->title}}</span>
                    <span class="d-block">{{$post->user->name}}</span>
                    <div class="row w-50">
                        <time class="col">{{$post->created_at}}</time>
                        <i class="bi bi-suit-heart-fill col"></i>
                    </div>
                </a>
            </li>
@endforeach
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
                    <label for="title">投稿タイトル</label>
                    <input class="form-control mb-4" type="text" name="title" id="input_title">
                    <label for="comment">投稿内容</label>
                    <textarea class="form-control" name="comment" id="input_comment" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-primary" id="btn_submit">投稿</button>
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
