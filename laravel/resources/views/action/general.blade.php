@if($kdlevel=='00' || $kdlevel=='99')
	
	<center>
		<a href="javascript:;" id="{{ $id }}" class="btn btn-xs btn-primary ubah-data" title="Ubah Data">
			<i class="fa fa-pencil"></i>
		</a>
		<a href="javascript:;" id="{{ $id }}" class="btn btn-xs btn-danger hapus-data" title="Hapus Data">
			<i class="fa fa-trash"></i>
		</a>
	</center>

@else

	<center>-</center>

@endif