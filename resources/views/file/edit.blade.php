@extends ('layouts.app')

@section ('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">まとめ編集</div>
        <div class="card-body">
          投稿日：{{ $file->created_at }}<br>
          投稿者：{{ $file->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $file->title }}</p>
          </blockquote>
          <div class="form-group">
            <button type="button" id="openModal" class="btn btn-primary" data-toggle="modal" data-target="#addToFile">+</button>
            <button type="submit" class="btn btn-primary" form="form_draw">+ 図</button>
            <button type="submit" class="btn btn-primary float-right" form="form_update">保存</button>
          </div>
          <form action="/file/{{ $file->id }}/draw" method="GET" class="form_horizontal" id="form_draw"></form>
          <form action="/file/{{ $file->id }}/update" method="POST" class="form-horizontal" id="form_update">
            @csrf
            @foreach ($comments as $comment)
            <div class="card card-body bg-light dragitem" draggable="true"> <!-- ドラッグ処理(dragitem) -->
              <div class="form-group">
                <div class="mx-auto">
                  <input type="hidden" name="sort{{ $comment->id }}" id="sort{{ $comment->id }}" value="{{ $comment->sort_no }}">
                  <textarea name="comment{{ $comment->id}}" id="comment{{ $comment->id}}" class="form-control">{{ $comment->content }}</textarea>
                </div>
              </div>
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
          </form>
        </div>
        @include ('file.modal_nopost', ['file_id' => $file->id])
      </div>
    </div>
  </div>
</div>
<!-- My Scripts -->
<script src="{{ asset('js/my_dnd.js') }}" defer></script>
@endsection
