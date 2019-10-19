<div class="card">
  <div class="card-header">つぶやき一覧</div>
  <div class="card-body">
    <table class="table">
      <colgroup>
        <col style="width: 45%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
      </colgroup>
      <thead class="table-light">
        <th>つぶやき</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>コメント</th>
        <th>ノート</th>
      </thead>
      @include ('post.list', ['posts' => $posts, 'myfiles' => $myfiles])
    </table>
    @foreach ($posts as $post)
      @include ('file.modal', ['post' => $post, 'myfiles' => $myfiles])
    @endforeach
  </div>
</div>
