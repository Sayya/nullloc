@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @include('file.make_search')
      @include('file.edit', ['files' => $files])
    </div>
  </div>
</div>
@endsection
