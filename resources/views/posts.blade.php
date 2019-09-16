@extends('layouts.tab')

@section('content-tab1')
<div class="card">
  <div class="card-header" data-toggle="collapse" data-target="#makepost" role="button">
      {{ __('つぶやく') }}
  </div>
  <div class="collapse" id="makepost">
    <div class="card-body">
      @include('common.errors')
      <form action="/save" method="POST" class="form-horizontal">
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

@if (count($posts) > 0)
<div class="card">
  <div class="card-header">{{ __('つぶやき一覧') }}</div>
  <div class="card-body">
    <table class="table">
      <colgroup>
        <col style="width: 60%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
      </colgroup>
      <thead class="table-light">
        <th>つぶやき</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>ノート</th>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>
            <div>{{ $post->content }}</div>
          </td>
          <td>
            <div>{{ $post->name}}</div>
          </td>
          <td>
            <div>{{ $post->updated_at}}</div>
          </td>
          <td>
            <form action="/{{ $post->id }}/note" method="GET" class="form-horizontal">
              @csrf
              <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ $post->count }}</button>
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
@endsection

@section('content-tab2')
@if (count($posts) > 0)
<div class="card">
  <div class="card-header">{{ __('ノート一覧') }}</div>
  <div class="card-body">
    <table class="table">
      <colgroup>
        <col style="width: 30%;">
        <col style="width: 30%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
      </colgroup>
      <thead class="table-light">
        <th>つぶやき</th>
        <th>ノート</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>開く</th>
      </thead>
      <tbody>
        @foreach ($notes as $note)
        <tr>
          <td>
            <div>{{ $note->content}}</div>
          </td>
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
  </div>
</div>
@endif
@endsection

@section('content-tab3')
<div class="card">
  <div class="card-header">{{ __('知識一覧') }}</div>
  <div class="card-body">
  </div>
</div>
@endsection
