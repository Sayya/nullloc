<div class="card">
  <div class="card-header">まとめをつくる</div>
  <div class="card-body">
    @include('common.errors')
    <form action="/file/save" method="POST" class="form-horizontal">
      @csrf
      <div class="form-group">
        <label>タイトル</label>
        <div class="mx-auto">
          <input type="text" name="title" id="title" class="form-control"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">
            保存
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
