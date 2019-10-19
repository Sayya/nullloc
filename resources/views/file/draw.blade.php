@extends ('layouts.app')

@section ('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">まとめ編集</div>
        <div class="card-body" id="cv-container">
          <div class="form-group">
            <input type="text" id="insertText" class="form-control">
          </div>
          <div class="form-group">
            <button type="button" id="addRect" class="btn btn-primary">+</button>
            <button type="button" id="clearScreen" class="btn btn-primary">クリア</button>
            <button type="button" id="openModal" class="btn btn-primary float-right" data-toggle="modal" data-target="#addToFile">保存</button>
          </div>
          <canvas class="border" id="cv" style="width: 100%;"></canvas>
        </div>
        @include ('file.modal_draw', ['file_id' => $file_id])
      </div>
    </div>
  </div>
</div>
<!-- My Scripts -->
<script src="{{ asset('js/my_cv.js') }}" defer></script>
@endsection
