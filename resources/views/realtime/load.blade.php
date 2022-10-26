<table id="add-row" class="display table table-striped table-hover" >
	<thead>
		<tr>
			<th>Status</th>
			<th>Date & Time</th>
		</tr>
	</thead>
	<tbody>
        @foreach ($data as $item)
            <tr>
                <td>{!! $item['text'] !!}</td>
                <td>{{ date("d F Y, h:i A", strtotime($item['time'])) }}</td>
            </tr>
        @endforeach
	</tbody>
</table>
