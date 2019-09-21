@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if($is_search)
        @include('file.make_back')
      @else
        @include('note.open_make')
      @endif
      <div class="card">
        <div class="card-header">{{ __('かきこみ一覧') }}</div>
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
              <col style="width: 60%;">
              <col style="width: 15%;">
              <col style="width: 15%;">
              <col style="width: 10%;">
            </colgroup>
            <thead class="table-light">
              <th>かきこみ</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </thead>
            <tbody>
              @foreach ($note_posts as $note_post)
              <tr>
                <td>
                  <div>{{ $note_post->content }}</div>
                </td>
                <td>
                  <div>{{ $note_post->name}}</div>
                </td>
                <td>
                  <div>{{ $note_post->updated_at}}</div>
                </td>
                <td>
                  @if($is_search)
                  <form action="/search/{{ $note_post->id }}/note" method="GET" class="form-horizontal">
                  @else
                  <form action="/{{ $note_post->id }}/note" method="GET" class="form-horizontal">
                  @endif
                    @csrf
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">{{ $note_post->count }}</button>
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
