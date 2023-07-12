<table class="table">
    <thead>
      <tr>
        @foreach ($headings as $heading)
          <th>{{ $heading }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach($data as $item)
      <tr>
        <th>{{ $item }}</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      @endforeach
    </tbody>
</table>