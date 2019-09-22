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
      <button type="button" id="openModal" class="btn btn-primary" data-toggle="modal" data-target="#addToFile{{ $post->id }}">+</button>
    </td>
    <td>
      <form action="/{{ $post->id }}/note" method="GET" class="form-horizontal">
        @csrf
        <div class="form-group">
          <button type="submit" class="btn btn-primary">{{ $post->count }}</button>
        </div>
      </form>
    </td>
  </tr>
  @endforeach
</tbody>
