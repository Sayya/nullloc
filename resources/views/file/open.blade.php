@extends ('layouts.app')

@section ('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">まとめ</div>
        <div class="card-body">
          投稿日：{{ $file->created_at }}<br>
          投稿者：{{ $file->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $file->title }}</p>
          </blockquote>
          @if ($file->created_user_id === Auth::id())
          <form action="/file/{{ $file->id }}/edit" method="GET" class="form-horizontal" id="form_edit"></form>
          <form action="/file/{{ $file->id }}/pubed" method="POST" class="form-horizontal" id="form_pubed">
            @csrf
          </form>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" form="form_edit">編集</button>
            @if ($file->open_scope === 0)
            <button type="submit" class="btn btn-primary float-right" form="form_pubed">公開</button>
            @else
            <button type="button" class="btn btn-primary float-right" form="form_pubed" disabled="true">公開済み</button>
            @endif
          </div>
          @endif
          @foreach ($comments as $comment)
          <div class="card card-body bg-light">
            <p>{{ $comment->content }}</p>
            @if (! is_null($comment->post_id))
            <div class="card card-body bg-white">
              投稿日：{{ $comment->post_created_at }}<br>
              投稿者：{{ $comment->user_name }}<br>
              @if (! is_null($comment->note_id))
              <nobr>ノート：<a href="/{{ $comment->post_id }}/note/{{ $comment->note_id }}">{{ $comment->note_title }}</a></nobr><br>
              @endif
              <blockquote class="blockquote text-center">
                <p>{{ $comment->post_content }}</p>
              </blockquote>
            </div>
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
