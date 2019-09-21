<div class="card">
  <div class="card-header" data-toggle="collapse" data-target="#makepost" role="button">
      {{ __('かきこむ') }}
  </div>
  <div class="collapse" id="makepost">
    <div class="card-body">
      @include('common.errors')
      <form action="/save/{{ $note->id }}" method="POST" class="form-horizontal">
        @csrf
        <div class="form-group">
          <div class="mx-auto">
            <textarea name="content" id="content" class="form-control"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-8">
            <button type="submit" class="btn btn-primary">
              {{ __('投稿') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
