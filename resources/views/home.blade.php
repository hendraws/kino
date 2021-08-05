@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-8">
							Performance Kelulusan Kino
						</div>
						<div class="col-md-4">
							<a href="{{ action('GrafikController@create') }}" class="btn btn-primary float-right">Tambah Data</a>
						</div>
					</div>
				</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<table>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Tahun</th>
									<th scope="col">Kategori</th>
									<th scope="col">Siswa Les</th>
									<th scope="col">Siswa Lulus</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
