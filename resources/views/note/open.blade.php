@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @include('note.open_make')
      <div class="card">
        <div class="card-header">かきこみ一覧</div>
        <div class="card-body">
          投稿日：{{ $post->created_at}}<br>
          投稿者：{{ $post->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $post->content }}</p>
          </blockquote>
          <div class="card card-body bg-light">
            投稿日：{{ $note->created_at}}<br>
            投稿者：{{ $note->name}}<br>
            <blockquote class="blockquote text-center">
              <p>{{ $note->title}}</p>
            </blockquote>
          </div>
          <table class="table">
            <colgroup>
              <col style="width: 45%;">
              <col style="width: 15%;">
              <col style="width: 15%;">
              <col style="width: 15%;">
              <col style="width: 10%;">
            </colgroup>
            <thead class="table-light">
              <th>かきこみ</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>コメント</th>
              <th>ノート</th>
            </thead>
            @include('post.list', ['posts' => $note_posts, 'myfiles' => $myfiles])
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
