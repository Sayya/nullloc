@extends ('layouts.app')

@section ('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if ($post->user_id != Auth::user()->id)
        @include ('note.board_make')
      @endif
      <div class="card">
        <div class="card-header">ノート一覧</div>
        <div class="card-body">
          投稿日：{{ $post->created_at }}<br>
          投稿者：{{ $post->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $post->content }}</p>
          </blockquote>
          <table class="table">
            <colgroup>
              <col style="width: 60%;">
              <col style="width: 15%;">
              <col style="width: 15%;">
              <col style="width: 10%;">
            </colgroup>
            <thead class="table-light">
              <th>ノート</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>開く</th>
            </thead>
            <tbody>
              @foreach ($notes as $note)
              <tr>
                <td>
                  <div>{{ $note->title }}</div>
                </td>
                <td>
                  <div>{{ $note->name }}</div>
                </td>
                <td>
                  <div>{{ $note->updated_at }}</div>
                </td>
                <td>
                  <form action="/{{ $post->id }}/note/{{ $note->id }}" method="GET" class="form-horizontal">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">{{ $note->count }}</button>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
