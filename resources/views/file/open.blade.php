@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{ __('まとめ') }}</div>
        <div class="card-body">
          投稿日：{{ $file->created_at}}<br>
          投稿者：{{ $file->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $file->title}}</p>
          </blockquote>
          @if (count($comments) > 0)
          <table class="table">
            <colgroup>
              <col style="width: 60%;">
              <col style="width: 15%;">
              <col style="width: 25%;">
            </colgroup>
            <thead class="table-light">
              <th>かきこみ</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </thead>
            <tbody>
              @foreach ($comments $comment)
              <tr>
                <td>
                  <div>{{ $comment->content }}</div>
                </td>
                <td>
                  <div>{{ $comment->name}}</div>
                </td>
                <td>
                  <div>{{ $comment->updated_at}}</div>
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
