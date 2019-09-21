<div class="card">
  <div class="card-header" data-toggle="collapse" data-target="#makenote" role="button">
    {{ __('ノートをつくる') }}
  </div>
  <div class="collapse" id="makenote">
    <div class="card-body">
      @include('common.errors')
      <form action="/{{ $post->id }}/note/save" method="POST" class="form-horizontal">
        @csrf
        <div class="form-group">
          <label>{{ __('タイトル') }}</label>
          <div class="mx-auto">
            <input type="text" name="title" id="title" class="form-control"></textarea>
          </div>
        </div>
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
