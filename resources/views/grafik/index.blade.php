@extends('layouts.app')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/DataTables/DataTables-1.10.22/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/DataTables/DataTables-1.10.22/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		let table = $('.table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ url()->full() }}",
			pageLength: 25,
			autoWidth: false,
			scrollX: "100%",
			scrollCollapse:false,
			columnDefs: [
			{targets: [0,2,3,], className: "text-center",},
			{targets: 0, width: "15px"},
			],
			columns: [

			{data: 'DT_RowIndex', name: 'DT_RowIndex', title: '#'},
			{data: 'tahun', name: 'tahun', title: 'Tahun'},
			{data: 'kategori', name: 'kategori', title: 'Kategori'},
			{data: 'siswa', name: 'siswa', title: 'Siswa'},
			{data: 'siswa_lulus', name: 'siswa_lulus', title: 'Siswa Lulus'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});


		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('body').on('click', '#saveBtn', function (e) {
			e.preventDefault();
			var id = $("#id").val();
			var nip = $("#nip").val();
			var nama = $("#nama").val();
			var alamat = $("#alamat").val();
			var no_hp = $("#no_hp").val();
			var email = $("#email").val();

			$.ajax({
				url: "{{ action('GrafikController@store') }}",
				type: "POST",
				data: {
					id: id,
					nip: nip,
					nama: nama,
					alamat: alamat,
					no_hp: no_hp,
					email: email,
				},
				dataType: 'json',
				success: function (data) {

					$('#exampleModal').modal('hide');
					$('#karyawanform').trigger('reset');
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Success',
						showConfirmButton: false,
						timer: 1500
					})
					reloadData();
				},
				error: function (data) {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Error',
						showConfirmButton: false,
						timer: 1500
					})
					console.log('Error......');
				}
			});
		});

		$('body').on('click', '.edit', function (e) {
			$('#karyawanform').trigger('reset');
			var id = $(this).data('id');
			$.get('/karyawan/'+id+'/edit', function (data) {
				console.log(data);
				$('#userCrudModal').html("Edit Karyawan");
				$('#exampleModal').modal('show');
				$('#id').val(data.data.id);
				$('#nip').val(data.data.nip);
				$('#nama').val(data.data.nama);
				$('#alamat').val(data.data.alamat);
				$('#no_hp').val(data.data.no_telp);
				$('#email').val(data.data.email);

			})
		});

		function reloadData() {
			$('.table').DataTable().ajax.reload();
		}

		$('body').on('click', '.hapus', function (event) {
			event.preventDefault();
			var id = $(this).attr('data-id');
		    var url = '{{ action("GrafikController@destroy",":id") }}';
		    url = url.replace(':id',id);
			Swal.fire({
				title: 'Are you sure?',

				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {

					$.ajax(
					{
						url: url,
						type: 'DELETE',
						data: {
							id: $(this).attr('data-id')
						},
						success: function (response){
							Swal.fire(
								'Remind!',
								'deleted successfully!',
								'success'
								);
						}
					});
					reloadData();
				}
			})


			return false;
		});

	});

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
				<a href="{{ action('GrafikController@create') }}" class="btn btn-primary" >
					Tambah Data
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table id="data-table" class="table table-bordered table-striped">
		</table>

	</div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ action('GrafikController@store') }}" method="POST" id="karyawanform">
					<div class="form-group row">
						<label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
						<div class="col-sm-10">
							<input required type="number" class="form-control" id="tahun" value="" name="tahun">
						</div>
					</div>
					<div class="form-group row">
						<label for="nama" class="col-sm-2 col-form-label">CPNS</label>
						<div class="col-sm-10">
							<input required type="text" class="form-control" id="nama" value="" name="nama">
						</div>
					</div>
					<input type="hidden" name="id" id="id">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button id="saveBtn" class="btn btn-brand btn-square btn-primary" type="button"><i class="fa fa-save"></i><span>Simpan</span></button>

			</div>
		</div>
	</div>
</div>
@endsection
