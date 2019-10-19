<div class="modal fade" id="addToFile" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">まとめへ追加</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/nopost/comment/save" method="POST" class="form-horizontal">
          @csrf
          <label>コメント</label>
          <div class="form-group">
            <div class="mx-auto">
              <input type="hidden" name="file_id" id="file_id" value="{{ $file_id }}"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="mx-auto">
              <textarea name="content" id="content" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">閉じる</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
