@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">まとめ編集</div>
        <div class="card-body">
          投稿日：{{ $file->created_at}}<br>
          投稿者：{{ $file->name }}<br>
          <blockquote class="blockquote text-center">
            <p>{{ $file->title}}</p>
          </blockquote>
        </div>
      </div>
    </div>
  </div>
</div>
