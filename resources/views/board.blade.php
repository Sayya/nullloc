@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <ul class="nav nav-tabs">
      <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">つぶやき</a></li>
      <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">ノート</a></li>
      <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">まとめ</a></li>
    </ul>
  </div>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <div class="row justify-content-center">
        <div class="col-md-10">
          @include('post.tab_make')
          @include('post.tab', ['posts' => $posts])
        </div>
      </div>
    </div>
    <div class="tab-pane" id="tab2">
      <div class="row justify-content-center">
        <div class="col-md-10">
          @include('note.tab', ['notes' => $notes])
        </div>
      </div>
    </div>
    <div class="tab-pane" id="tab3">
      <div class="row justify-content-center">
        <div class="col-md-10">
          @include('file.tab_make')
          @include('file.tab', ['files' => $files])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
