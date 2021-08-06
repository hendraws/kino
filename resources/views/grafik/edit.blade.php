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
				Edit Data Pencapaian Siswa Kino tahun {{ $data->tahun }}
			</div>
		</div>
	</div>
	<div class="card-body">
		<form class="needs-validation" action="{{ action('GrafikController@update', $data->id) }}" method="POST">
			@csrf
			@method('put')
			<div class="form-row mb-3">
				<div class="col-md-12">
					<label for="validationTooltip01">Tahun</label>
						<input type="text" class="form-control" required value="{{ $data->tahun }}" readonly="readonly">
				</div>
			</div>
			<div class="form-row">

				<div class="col-md-6 mb-3">
					<label for="validationTooltip03">Kategori</label>
					<input type="text" class="form-control" required value="{{ $data->kategori }}" readonly="readonly">
				</div>
				<div class="col-md-3 mb-3">
					<label for="validationTooltip04">Jumlah Siswa</label>
					<input type="number" class="form-control" required name="siswa" value="{{ $data->siswa }}">
				</div>
				<div class="col-md-3 mb-3">
					<label for="validationTooltip05">Jumlah Siswa Lulus</label>
					<input type="number" class="form-control" required name="siswa_lulus" value="{{ $data->siswa_lulus }}">
				</div>
			</div>

			<button class="btn btn-primary" type="submit">Simpan</button>
			<a class="btn btn-warning" href="{{ action('GrafikController@index') }}">Kembali</a>
		</form>

	</div>
</div>
<!-- Button trigger modal -->


@endsection
