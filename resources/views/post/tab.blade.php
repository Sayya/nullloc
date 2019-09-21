@if (count($posts) > 0)
<div class="card">
  <div class="card-header">{{ __('つぶやき一覧') }}</div>
  <div class="card-body">
    <table class="table">
      <colgroup>
        <col style="width: 60%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
      </colgroup>
      <thead class="table-light">
        <th>つぶやき</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>ノート</th>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>
            <div>{{ $post->content }}</div>
          </td>
          <td>
            <div>{{ $post->name}}</div>
          </td>
          <td>
            <div>{{ $post->updated_at}}</div>
          </td>
          <td>
            @if($is_search)
            <form action="/search/{{ $post->id }}/note" method="GET" class="form-horizontal">
            @else
            <form action="/{{ $post->id }}/note" method="GET" class="form-horizontal">
            @endif
              @csrf
              <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ $post->count }}</button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
