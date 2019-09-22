<div class="card">
  <div class="card-header">ノート一覧</div>
  <div class="card-body">
    <table class="table">
      <colgroup>
        <col style="width: 30%;">
        <col style="width: 30%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
      </colgroup>
      <thead class="table-light">
        <th>つぶやき</th>
        <th>ノート</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>開く</th>
      </thead>
      <tbody>
        @foreach ($notes as $note)
        <tr>
          <td>
            <div>{{ $note->content}}</div>
          </td>
          <td>
            <div>{{ $note->title}}</div>
          </td>
          <td>
            <div>{{ $note->name}}</div>
          </td>
          <td>
            <div>{{ $note->updated_at}}</div>
          </td>
          <td>
            <form action="/{{ $note->post_id }}/note/{{ $note->id }}" method="GET" class="form-horizontal">
              @csrf
              <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ $note->count }}</button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
