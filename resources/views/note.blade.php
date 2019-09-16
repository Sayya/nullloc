@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#makenote" role="button">
          {{ __('ノートをつくる') }}
        </div>
        <div class="collapse" id="makenote">
          <div class="card-body">
            @include('common.errors')
            <form action="/{{ $post->id }}/note/save" method="POST" class="form-horizontal">
              @csrf
              <div class="form-group">
                <label>{{ __('タイトル') }}</label>
                <div class="mx-auto">
                  <input type="text" name="title" id="title" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-8">
                  <button type="submit" class="btn btn-primary">
                    {{ __('作成') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">{{ __('議論ノート一覧') }}</div>
        <div class="card-body">
          投稿日：{{ $post->created_at}}<br>
          投稿者：{{ $post->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $post->content }}</p>
          </blockquote>
          @if (count($notes) > 0)
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
                  <div>{{ $note->title}}</div>
                </td>
                <td>
                  <div>{{ $note->name}}</div>
                </td>
                <td>
                  <div>{{ $note->updated_at}}</div>
                </td>
                <td>
                  <form action="/{{ $post->id }}/note/{{ $note->id }}" method="GET" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">{{ $note->count }}</button>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
