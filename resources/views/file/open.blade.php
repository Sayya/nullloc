@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">まとめ</div>
        <div class="card-body">
          投稿日：{{ $file->created_at}}<br>
          投稿者：{{ $file->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $file->title}}</p>
          </blockquote>
          @foreach ($comments as $comment)
          <div class="card card-body bg-light">
            <p>{{ $comment->content}}</p>
            <div class="card card-body bg-light">
              投稿日：{{ $comment->post_created_at}}<br>
              投稿者：{{ $comment->name}}<br>
              <blockquote class="blockquote text-center">
                <p>{{ $comment->post_content}}</p>
              </blockquote>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
