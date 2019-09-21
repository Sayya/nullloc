<div class="card">
  <div class="card-header">{{ __('まとめ要素') }}</div>
  <div class="card-body">
    @if (count($files) > 0)
    <table class="table">
      <colgroup>
        <col style="width: 60%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
      </colgroup>
      <thead class="table-light">
        <th>まとめ</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>開く</th>
      </thead>
      <tbody>
        @foreach ($files as $file)
        <tr>
          <td>
            <div>{{ $file->title}}</div>
          </td>
          <td>
            <div>{{ $file->name}}</div>
          </td>
          <td>
            <div>{{ $file->updated_at}}</div>
          </td>
          <td>
            <form action="/{{ $post->id }}/file/{{ $file->id }}" method="GET" class="form-horizontal">
              @csrf
              <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ $file->count }}</button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
</div>
