<div class="card">
  <div class="card-header">
    {{ __('まとめをつくる') }}
  </div>
  <div class="card-body">
    @include('common.errors')
    <form action="/file/save" method="POST" class="form-horizontal" id="file_save">
      @csrf
      <div class="form-group">
        <label>{{ __('タイトル') }}</label>
        <div class="mx-auto">
          <input type="text" name="title" id="title" class="form-control"></textarea>
        </div>
      </div>
    </form>
    <form action="/file/search" method="GET" class="form-horizontal" id="comment_search"></form>
    <form action="/file/edit" method="GET" class="form-horizontal" id="file_edit"></form>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary float-left" form="file_save">
          {{ __('投稿') }}
        </button>
        <button type="submit" class="btn btn-primary float-right" form="file_edit">
          {{ __('戻る') }}
        </button>
      </div>
    </div>
  </div>
</div>
