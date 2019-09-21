<div class="card">
  <div class="card-header" data-toggle="collapse" data-target="#makefile" role="button">
      {{ __('まとめる') }}
  </div>
  <div class="collapse" id="makefile">
    <div class="card-body">
      @include('common.errors')
      <form action="/file/edit" method="GET" class="form-horizontal">
        @csrf
        <div class="form-group">
          <div class="col-md-8">
            <button type="submit" class="btn btn-primary">
              {{ __('作成') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
