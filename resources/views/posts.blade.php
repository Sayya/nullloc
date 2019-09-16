@extends('layouts.tab')

@section('content-tab1')
<div class="card">
  <div class="card-header" data-toggle="collapse" data-target="#collexample" role="button">
      {{ __('Post') }}
  </div>
  <div class="collapse" id="collexample">
    <div class="card-body">
      @include('common.errors')
      <form action="/save" method="POST" class="form-horizontal">
        @csrf
        <div class="form-group">
          <div class="mx-auto">
            <textarea name="content" id="post-content" class="form-control"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-8">
            <button type="submit" class="btn btn-primary">
              {{ __('Save') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@if (count($posts) > 0)
<div class="card">
  <div class="card-header">{{ __('Global Board') }}</div>
  <div class="card-body">
    <table class="table">
      <colgroup>
        <col style="width: 65%;">
        <col style="width: 20%;">
        <col style="width: 15%;">
      </colgroup>
      <thead class="table-dark">
        <th>Content</th>
        <th>User</th>
        <th>&nbsp;</th>
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
            <form action="/locus" method="POST" class="form-horizontal">
              @csrf
              <div class="form-group">
                <input type="hidden" name="post_id" id="locus-post_id" value="{{ $post->id }}">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ $post->icon }}</button>
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
  <div class="card-header">{{ __('Global Board') }}</div>
  <div class="card-body">
    <table class="table">
      <colgroup>
        <col style="width: 100%;">
      </colgroup>
      <thead class="table-dark">
        <th>Content</th>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>
            <div>{{ $post->content }}</div>
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
  <div class="card-header">{{ __('Note') }}</div>
  <div class="card-body">
  </div>
</div>
@endsection
