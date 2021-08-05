@extends('layouts.app')
@section('css')
@endsection
@section('js')
<script type="text/javascript">


</script> 
@endsection
@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h3>Overview Pencapaian Siswa Kino</h3>
	</div>
</div>
<hr>
<div class="card card-accent-primary">
	<div class="card-header">
		<div class="row">
			<div class="col-auto">
				Tambah Data Siswa Kino
			</div>
		</div>
	</div>
	<div class="card-body">
		<form class="needs-validation" action="{{ action('GrafikController@store') }}" method="POST">
			@csrf
			<div class="form-row mb-3">
				<div class="col-md-12">
					<label for="validationTooltip01">Tahun</label>
					<select class="form-control" id="exampleFormControlSelect1" name="tahun">
						@foreach ($data as $val)
						<option value="{{ $val }}" {{ $val == date('Y') ? 'selected' : '' }}>{{ $val }}</option>						
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				@foreach ($kategori as $value)

				<div class="col-md-6 mb-3">
					<label for="validationTooltip03">Kategori</label>
					<input type="text" class="form-control" required value="{{ $value }}" readonly="readonly">
				</div>
				<div class="col-md-3 mb-3">
					<label for="validationTooltip04">Jumlah Siswa</label>
					<input type="number" class="form-control" required name="kategori[{{ $value }}][siswa]">
				</div>
				<div class="col-md-3 mb-3">
					<label for="validationTooltip05">Jumlah Siswa Lulus</label>
					<input type="number" class="form-control" required name="kategori[{{ $value }}][siswa_lulus]">
				</div>
				@endforeach
			</div>

			<button class="btn btn-primary" type="submit">Submit form</button>
		</form>

	</div>
</div>
<!-- Button trigger modal -->


@endsection
