@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <ul class="nav nav-tabs">
      <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">POST</a></li>
      <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">DISCUS</a></li>
      <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">NOTE</a></li>
    </ul>
  </div>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <div class="row justify-content-center">
        <div class="col-md-10">
          @yield('content-tab1')
        </div>
      </div>
    </div>
    <div class="tab-pane" id="tab2">
      <div class="row justify-content-center">
        <div class="col-md-10">
          @yield('content-tab2')
        </div>
      </div>
    </div>
    <div class="tab-pane" id="tab3">
      <div class="row justify-content-center">
        <div class="col-md-10">
          @yield('content-tab3')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
