@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Locus') }}</div>
        <div class="card-body">
          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
              {{ __('Name') }}
            </label>
            <div class="col-md-6">
              <h5>{{ $locus->name }}</h5>
            </div>
          </div>
          <div class="form-group row">
            <label for="content" class="col-md-4 col-form-label text-md-right">
              {{ __('Content') }}
            </label>
            <div class="col-md-6">
              <p>{{ $locus->content }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
