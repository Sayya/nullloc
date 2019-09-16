@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Locus') }}</div>
        <div class="card-body">
          @include('common.errors')
          <form action="/locus/save" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">
                {{ __('Name') }}
              </label>
              <div class="col-md-6">
                <input type="text" name="name" id="locus-name" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="content" class="col-md-4 col-form-label text-md-right">
                {{ __('Content') }}
              </label>
              <div class="col-md-6">
                <textarea name="content" id="post-content" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="post_id" id="locus-post_id" value="{{ $post_id }}">
            </div>
            <div class="form-group">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Save') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
