@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#makepost" role="button">
            {{ __('かきこむ') }}
        </div>
        <div class="collapse" id="makepost">
          <div class="card-body">
            @include('common.errors')
            <form action="/save/{{ $note->id }}" method="POST" class="form-horizontal">
              @csrf
              <div class="form-group">
                <div class="mx-auto">
                  <textarea name="content" id="content" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-8">
                  <button type="submit" class="btn btn-primary">
                    {{ __('投稿') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
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
          @if (count($note_posts) > 0)
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
                  <form action="/" method="GET" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">?</button>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
