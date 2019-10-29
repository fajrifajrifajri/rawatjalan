$(document).ready(function() {
	var base_url = window.location.origin;
	
    $('#tbl_rekam_medis').DataTable({
			"pageLength": 5,
			"order": [[ 0, 'desc' ]],
			"lengthChange": false,
			"info": false,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/antrian",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{ "data": "id" },
				{},
				{ "data": "nama_pasien" },
				{ "data": "kelamin" },
				{ "data": "tanggal_lahir" },
				{ "data": "alamat" },
				{ "data": "rekam_medis" },
				{}
			],
			columnDefs: [{   
					"targets": [0],
					"visible": false,
					"searchable": false
				}, 
				{
					"targets": 1,
					"render": function ( data, type, row, meta ) {
						return `<button type="submit" class="btn btn-link kunjungan" rekam-medis="`+row['rekam_medis']+`"><i class="h5 far fa-calendar-check"></i></button>`;
					}
				},
				{
				"targets": 7,
				"render": function ( data, type, row, meta ) {
					return `<button class="populate" nama-pasien="`+row['nama_pasien']+`" kelamin="`+row['kelamin']+`" tanggal-lahir="`+row['tanggal_lahir']+`" alamat="`+row['alamat']+`" rekam-medis="`+row['rekam_medis']+`">Daftar!</button>`;
				}
			  } ],
			  "drawCallback": function( settings ) {
				  $(".populate").click(function () {
						var nama_pasien = $(this).attr("nama-pasien");
						var kelamin = $(this).attr("kelamin");
						var tanggal_lahir = $(this).attr("tanggal-lahir");
						var alamat = $(this).attr("alamat");
						var rekam_medis = $(this).attr("rekam-medis");
						console.log(nama_pasien);
						$("#nama_pasien").val(nama_pasien);
						if(kelamin == "Pria") {
							$("#kelamin1").parent().click();
							$("#kelamin1").prop("checked", true);
						} else {
							$("#kelamin2").parent().click();
							$("#kelamin2").prop("checked", true);
						}
						$("#tanggal_lahir").val(tanggal_lahir);
						$("#alamat").val(alamat);
						$("#rekam_medis").val(rekam_medis);
						$('#exampleModalCenter').modal('hide'); 
					});
				$(".kunjungan").on("click", function(){
					var rm = $(this).attr('rekam-medis');
					$.ajax({
						"url": "/api/antrian",
						"type": "POST",
						"headers": {
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						}
					}).done(function(res) {
						var count = 0;
						$.map(res.data, function(data, i) {
							if(data.rekam_medis === rm) {
								count++;
							}
						});
						var filteredObj = $.grep( res.data, function( n, i ) {
							return n.rekam_medis === rm;
						});
						var createdAt = [];
						$.each(filteredObj, function(i, value){
							createdAt.push(value.created_at);
						})
						alert("Jumlah kunjungan: "+count+"\nKunjungan terakhir: "+createdAt.slice(-1)[0]);
					});
				});
			  }
	});
	$('#tbl_rekam_medis_antrian').DataTable({
			"pageLength": 5,
			"order": [[ 0, 'desc' ]],
			"lengthChange": false,
			"info": false,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/antrian",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{ "data": "id" },
				{ "data": "nama_pasien" },
				{ "data": "kelamin" },
				{ "data": "tanggal_lahir" },
				{ "data": "alamat" },
				{ "data": "rekam_medis" },
				{},
				{}
			],
			"columnDefs": [{   
					"targets": 0,
					"visible": false,
					"searchable": false
				},
				{ 
					"targets": 6,
					"data": "created_at",
					"render": function ( data, type, row, meta ) {
						var hari = data.split(" ");
						return hari[0];
					}
				},
				{
					"targets": 7,
					"render": function ( data, type, row, meta ) {
						return `<button type="submit" class="btn btn-link kunjungan" rekam-medis="`+row['rekam_medis']+`"><i class="h5 far fa-calendar-check"></i></button>`;
					}
				}
			],
			"drawCallback": function(settings) {
				$(".kunjungan").on("click", function(){
					var rm = $(this).attr('rekam-medis');
					$.ajax({
						"url": "/api/antrian",
						"type": "POST",
						"headers": {
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						}
					}).done(function(res) {
						var count = 0;
						$.map(res.data, function(data, i) {
							if(data.rekam_medis === rm) {
								count++;
							}
						});
						var filteredObj = $.grep( res.data, function( n, i ) {
							return n.rekam_medis === rm;
						});
						var createdAt = [];
						$.each(filteredObj, function(i, value){
							createdAt.push(value.created_at);
						})
						alert("Jumlah kunjungan: "+count+"\nKunjungan terakhir: "+createdAt.slice(-1)[0]);
					});
				});
			}
	});
	var TanggalBaru = new Date();
	var tanggal = ("0" + TanggalBaru.getDate()).slice(-2); // Tanggal sekarang
	var bulan = ("0" + (TanggalBaru.getMonth() + 1)).slice(-2); // Bulan sekarang
	var tahun = TanggalBaru.getFullYear(); // Tahun sekarang
	var table_antrian = $('#tbl_antrian').DataTable({
				"pageLength": 5,
				"lengthChange": false,
				"info": false,
				"order": [[ 5, "desc" ]],
				"processing": true,
				"serverSide": true,
				"ajax": /* "{{ route('api.antrian.index') }}", */  {
					"url": "/api/realantrian",
					"type": "POST",
					"headers": {
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					}
				},
				/*
				"oSearch": { // Untuk mencari pasien yang terdaftar (HARI INI)
					"sSearch": tahun + '-' + bulan + '-' + tanggal
				}, 
				*/
				initComplete: function () {
				this.api().columns([6]).every( function () {
					var column = this;
					var select = $('#poliFilter')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							
							column
								.search( val ? '^'+val+'$' : '', true, false )
								.draw();
						} );
	 
							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				},
				"columns": [
					{ "data": "nama_pasien" },
					{ "data": "kelamin" },
					{ "data": "tanggal_lahir" },
					{ "data": "alamat" },
					{ "data": "rekam_medis" },
					{},
					{ 
					/*
					"searchable": false, // Untuk memperbaiki search hasil join dua tabel error datatables
					*/
					"data": "nama_poli"
					},
				],
				"columnDefs": [ {
					"targets": 5,
					"data": "created_at",
					"type": 'time-uni',
					"render": function ( data, type, row, meta ) {
						var datang = data.split(" ");
						datang = datang[1];
						return datang;
					}
			  } ],
				dom: "<'row'<'col-md-12'tr>>" +
				"<'row'<'col-sm-12 col-md-12'p>>",		 
	});
	
    $('#tbl_pasien').DataTable({
			"pageLength": 5,
			"order": [[ 0, 'desc' ]],
			"searching": false,
			"lengthChange": false,
			"info": false,
			dom: "<'row'<'col-md-3'l><'col-md-3'f><'col-md-6'p>>" +
				 "<'row'<'col-md-12'tr>>",
			language: {
				paginate: {
				  next: '<i class="fas fa-arrow-circle-right"></i>',
				  previous: '<i class="fas fa-arrow-alt-circle-left"></i>'  
				}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/antrian",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{ "data": "id" },
				{ "data": "nama_pasien" },
				{ "data": "kelamin" },
				{ "data": "tanggal_lahir" },
				{ "data": "alamat" },
				{ "data": "rekam_medis" },
				{ "data": "nama_poli" },
				{},
				{}
			],
			"columnDefs": [{   
					"targets": 0,
					"visible": false,
					"searchable": false
				}, {
				"targets": 7,
				"data": "id",
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="GET" action="`+base_url+`/administrator/pasien/`+data+`/edit"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="GET"> <button type="submit" class="btn btn-link text-center"><i class="fas fa-pencil-alt"></i></button></form>`);
				}
			}, {
				"targets": 8,
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="POST" action="`+base_url+`/administrator/pasien/`+row['id']+`"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-link text-center delete"><i class="fas fa-times text-danger"></i></button></form>`);
				}
			}],
			"drawCallback": function( settings ) {
				 $('.delete').on('click', function() {
					 event.preventDefault();
					var form = event.target.form; // storing the form
					console.log(form)
					Swal.fire({
					  title: "Hapus pasien ini?",
					  text: "Pasien akan terhapus dari antrian dan rekam medis.",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#3085d6",
					  confirmButtonText: "Iya, hapus!",
					  cancelButtonColor: '#d33',
					  cancelButtonText: "Batalkan!"
					}).then((result) => {
					  if (result.value) {
						  console.log(result.value)
						form.submit();          // submitting the form when user press yes
					  }
					})
				})
			}
	})
	$('#tbl_dokter').DataTable({
			"pageLength": 5,
			"searching": false,
			"order": [[ 0, 'desc' ]],
			"lengthChange": false,
			"info": false,
			dom: "<'row'<'col-md-3'l><'col-md-3'f><'col-md-6'p>>" +
				 "<'row'<'col-md-12'tr>>",
			language: {
				paginate: {
				  next: '<i class="fas fa-arrow-circle-right"></i>',
				  previous: '<i class="fas fa-arrow-alt-circle-left"></i>'  
				}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/dokter",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{ "data": "id" },
				{ "data": "nama_dokter" },
				{ "data": "nama_poli" },
				{},
				{ "data": "alamat" },
				{},
				{},
				{}
			],
			"columnDefs": [{   
					"targets": 0,
					"visible": false,
					"searchable": false
				}, {
					"targets": 3,
					"data": "foto",
					"render": function ( data, type, row, meta ) {
						if(data) {
							return '<img src="../storage/'+data+'" style="display:flex; margin:auto;"/>';
						} else {
							return null;
						}
					}
				}, {
					"targets": 5,
					"data": "telp",
					"render": function ( data, type, row, meta ) {
						if(data) {
							return data+"<a target='_blank' rel='noopener noreferrer' class='text-success h4' href='https://wa.me/"+data+"'><i class='fab fa-whatsapp ml-md-2'></i></a>"
						} else {
							return null;
						}
					}
				}, {
					"targets": 6,
					"data": "id",
					"width": "10px",
					"render": function( data, type, row, meta ) {
						var csrf = $('meta[name="csrf-token"]').attr('content');
						return (`<form method="GET" action="`+base_url+`/administrator/dokter/`+data+`/edit"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="GET"> <button type="submit" class="btn btn-link text-center"><i class="fas fa-pencil-alt"></i></button></form>`);
					}
				}, {
					"targets": 7,
					"width": "10px",
					"render": function( data, type, row, meta ) {
						var csrf = $('meta[name="csrf-token"]').attr('content');
						return (`<form method="POST" action="`+base_url+`/administrator/dokter/`+row['id']+`"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-link text-center deleteDokter"><i class="fas fa-times text-danger"></i></button></form>`);
					}
				}],
				"drawCallback": function( settings ) {
					 $('.deleteDokter').on('click', function() {
						 event.preventDefault();
						var form = event.target.form; // storing the form
						console.log(form)
						Swal.fire({
						  title: "Hapus dokter ini?",
						  text: "Dokter akan terhapus dari tabel.",
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonColor: "#3085d6",
						  confirmButtonText: "Iya, hapus!",
						  cancelButtonColor: '#d33',
						  cancelButtonText: "Batalkan!"
						}).then((result) => {
						  if (result.value) {
							  console.log(result.value)
							form.submit();          // submitting the form when user press yes
						  }
						})
					})
				}
	});
	$('#tbl_poliklinik').DataTable({
			"pageLength": 5,
			"searching": false,
			"order": [[ 0, 'asc' ]],
			"lengthChange": false,
			"info": false,
			dom: "<'row'<'col-md-3'l><'col-md-3'f><'col-md-6'p>>" +
				 "<'row'<'col-md-12'tr>>",
			language: {
				paginate: {
				  next: '<i class="fas fa-arrow-circle-right"></i>',
				  previous: '<i class="fas fa-arrow-alt-circle-left"></i>'  
				}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/poliklinik",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{ "data": "nama_poli" },
				{},
				{}
			],
			"columnDefs": [{
				"targets": 1,
				"data": "id",
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="GET" action="`+base_url+`/administrator/poliklinik/`+data+`/edit"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="GET"> <button type="submit" class="btn btn-link text-center"><i class="fas fa-pencil-alt"></i></button></form>`);
				}
			}, {
				"targets": 2,
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="POST" action="`+base_url+`/administrator/poliklinik/`+row['id']+`"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-link text-center deletePoli"><i class="fas fa-times text-danger"></i></button></form>`);
				}
			}],
			"drawCallback": function( settings ) {
				 $('.deletePoli').on('click', function() {
					 event.preventDefault();
					var form = event.target.form; // storing the form
					console.log(form)
					Swal.fire({
					  title: "Hapus poliklinik ini?",
					  text: "Poliklinik akan terhapus dari tabel.",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#3085d6",
					  confirmButtonText: "Iya, hapus!",
					  cancelButtonColor: '#d33',
					  cancelButtonText: "Batalkan!"
					}).then((result) => {
					  if (result.value) {
						  console.log(result.value)
						form.submit();          // submitting the form when user press yes
					  }
					})
				})
			}
	});
	$('#tbl_obat').DataTable({
			"pageLength": 5,
			"searching": false,
			"order": [[ 0, 'asc' ]],
			"lengthChange": false,
			"info": false,
			dom: "<'row'<'col-md-3'l><'col-md-3'f><'col-md-6'p>>" +
				 "<'row'<'col-md-12'tr>>",
			language: {
				paginate: {
				  next: '<i class="fas fa-arrow-circle-right"></i>',
				  previous: '<i class="fas fa-arrow-alt-circle-left"></i>'  
				}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/obat",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{ "data": "nama_obat" },
				{ "data": "jenis_obat" },
				{ "data": "satuan" },
				{},
				{},
				{}
			],
			"columnDefs": [{
				"targets": 3,
				"data": "harga_satuan",
				"render": function( data, type, row, meta ) {
					return 'Rp. '+data;
				}
			},
			{
				"targets": 4,
				"data": "id",
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="GET" action="`+base_url+`/administrator/obat/`+data+`/edit"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="GET"> <button type="submit" class="btn btn-link text-center"><i class="fas fa-pencil-alt"></i></button></form>`);
				}
			}, {
				"targets": 5,
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="POST" action="`+base_url+`/administrator/obat/`+row['id']+`"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-link text-center deleteObat"><i class="fas fa-times text-danger"></i></button></form>`);
				}
			}],
			"drawCallback": function( settings ) {
				 $('.deleteObat').on('click', function() {
					 event.preventDefault();
					var form = event.target.form; // storing the form
					console.log(form)
					Swal.fire({
					  title: "Hapus obat ini?",
					  text: "Obat akan terhapus dari antrian dan rekam medis.",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#3085d6",
					  confirmButtonText: "Iya, hapus!",
					  cancelButtonColor: '#d33',
					  cancelButtonText: "Batalkan!"
					}).then((result) => {
					  if (result.value) {
						  console.log(result.value)
						form.submit();          // submitting the form when user press yes
					  }
					})
				})
			}
	});
	$('#tbl_resep_dokter').DataTable({
			"pageLength": 5,
			"searching": false,
			"order": [[ 0, 'asc' ]],
			"lengthChange": false,
			"info": false,
			dom: "<'row'<'col-md-3'l><'col-md-3'f><'col-md-6'p>>" +
				 "<'row'<'col-md-12'tr>>",
			language: {
				paginate: {
				  next: '<i class="fas fa-arrow-circle-right"></i>',
				  previous: '<i class="fas fa-arrow-alt-circle-left"></i>'  
				}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/resep-dokter",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{ "data": "nama_obat" },
				{ "data": "jenis_obat" },
				{ "data": "satuan" },
				{},
				{},
				{}
			],
			"columnDefs": [{
				"targets": 3,
				"data": "harga_satuan",
				"render": function( data, type, row, meta ) {
					return 'Rp. '+data;
				}
			}, {
				"targets": 4,
				"data": "id",
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="GET" action="`+base_url+`/administrator/resep-dokter/`+data+`/edit"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="GET"> <button type="submit" class="btn btn-link text-center"><i class="fas fa-pencil-alt"></i></button></form>`);
				}
			}, {
				"targets": 5,
				"width": "10px",
				"render": function( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					return (`<form method="POST" action="`+base_url+`/administrator/resep-dokter/`+row['id']+`"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-link text-center deleteResep"><i class="fas fa-times text-danger"></i></button></form>`);
				}
			}],
			"drawCallback": function( settings ) {
				 $('.deleteResep').on('click', function() {
					 event.preventDefault();
					var form = event.target.form; // storing the form
					console.log(form)
					Swal.fire({
					  title: "Hapus resep ini?",
					  text: "Resep akan terhapus dari tabel.",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#3085d6",
					  confirmButtonText: "Iya, hapus!",
					  cancelButtonColor: '#d33',
					  cancelButtonText: "Batalkan!"
					}).then((result) => {
					  if (result.value) {
						  console.log(result.value)
						form.submit();          // submitting the form when user press yes
					  }
					})
				})
			}
	});
	$('#tbl_pembayaran').DataTable({
			"pageLength": 5,
			"order": [[ 1, 'desc' ]],
			"lengthChange": false,
			"info": false,
			dom: "<'row'<'col-md-12'l>>" +
				 "<'row'<'col-md-6'f><'col-md-6'p>>"+
				 "<'row'<'col-md-12'tr>>",
			language: {
				paginate: {
				  next: '<i class="fas fa-arrow-circle-right"></i>',
				  previous: '<i class="fas fa-arrow-alt-circle-left"></i>'  
				}
			},
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/api/pemeriksaan",
				"type": "POST",
				"headers": {
					"X-CSRF-TOKEN": "{{ csrf_token() }}"
				}
			},
			"columns": [
				{},
				{ "data": "updated_at", },
				{ "data": "rekam_medis" },
				{ "data": "nama_pasien" },
				{ "data": "nama_poli" },
				{ "data": "total_harga" },
				{}
			],
			"columnDefs": [ {
				"targets": 0,
				"data": "created_at",
				"render": function ( data, type, row, meta ) {
					if(data !== null) {
						var created_at = data.split(" ");
						created_at = created_at[0];
						return created_at;
					} else {
						return data;
					}
				}
			},
			{   
					"targets": [1],
					"visible": false,
					"searchable": false
			},
			{
				"targets": 6,
				"data": "id",
				"data": "bayar",
				"data": "kelamin",
				"data": "tanggal_lahir",
				"data": "alamat",
				"data": "nama_dokter",
				"data": "penyakit_atau_gejala",
				"data": "keterangan",
				"data": "total_harga",
				"render": function ( data, type, row, meta ) {
					var csrf = $('meta[name="csrf-token"]').attr('content');
					if(row["bayar"]==="belum") {
						return (`<form method="POST" action="`+base_url+`/administrator/pembayaran"> <input name="_token" value="`+csrf+`" type="hidden"> <input type="hidden" name="id_pasien" value="`+row["id"]+`"> <input type="hidden" name="pay" value="sudah"> <button type="submit" class="btn btn-success bayar"><i class="fas fa-hand-holding-usd"></i></button></form>`);
					} else {
						return `
							<button class="btn btn-warning populating" type="button" data-toggle="modal" 
							id="`+row["id"]+`"
							rekam-medis="`+row["rekam_medis"]+`" 
							nama-pasien="`+row["nama_pasien"]+`" 
							kelamin="`+row["kelamin"]+`"
							tanggal-lahir="`+row["tanggal_lahir"]+`"
							alamat="`+row["alamat"]+`"
							nama-dokter="`+row["nama_dokter"]+`" 
							nama-poli="`+row["nama_poli"]+`" 
							penyakit="`+row["penyakit_atau_gejala"]+`" 
							keterangan="`+row["keterangan"]+`" 
							total-harga="`+row["total_harga"]+`" 
							data-target="#exampleModalCenter">
							  <i class="fas fa-print"></i>
							</button>`;
					}
				}
			} ],
			"drawCallback": function( settings ) {
				 $('.bayar').on('click', function() {
					event.preventDefault();
					var form = event.target.form; // storing the form
					console.log(form)
					Swal.fire({
					  title: "Pasien ini sudah membayar?",
					  text: "Data Pasien akan terlihat dan dapat langsung dicetak.",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#3085d6",
					  confirmButtonText: "Iya, sudah!",
					  cancelButtonColor: '#d33',
					  cancelButtonText: "Batalkan!"
					}).then((result) => {
					  if (result.value) {
						  console.log(result.value)
						form.submit();          // submitting the form when user press yes
					  }
					})
				});
				 $('.populating').on('click', function() {
					$.ajax({
						url: '/api/pembayaranObat',
						type: "POST",
						headers: {
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						},
						data: { 'id': $(this).attr("id") },
						beforeSend: function () { Swal.showLoading(); },
						success:function(res){
							console.log(res);
							Swal.close();
							$("#resepObat").empty();
							$.each(JSON.parse(res), function(key, value) {
								$("#resepObat").append(`
								<li style="width: 100%;">
									<div class="dot-div"></div>
									<div class="text-div">
										<span class="text-span pr-md-3">`+value.nama_obat+`</span><span class="text-span">[Obat bebas]</span>
										<span class="text-span float-right">Rp. `+value.harga_satuan*value.jumlah+`(`+value.jumlah+`)</span>
									</div>
								</li>`);
							});
							$("#btnPrint").toggle();
						},
						error: function (res){
							console.log('Gagal');
							console.log(res);
						}, 
					});
				});
				 $('.populating').on('click', function() {
					$.ajax({
						url: '/api/pembayaranResep',
						type: "POST",
						headers: {
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						},
						data: { 'id': $(this).attr("id") },
						success:function(res){
							console.log(res)
							$.each(JSON.parse(res), function(key, value) {
								$("#resepObat").append(`
								<li style="width: 100%;">
									<div class="dot-div"></div>
									<div class="text-div">
										<span class="text-span">`+value.nama_obat+`</span><span class="text-span">[Resep dokter]</span>
										<span class="text-span float-right">Rp. `+value.harga_satuan*value.jumlah+`(`+value.jumlah+`)</span>
									</div>
								</li>`);
							});
						},
						error: function (res){
							console.log('Gagal');
							console.log(res);
						}, 
					});
				});
				$(".populating").click(function () {
					var rekam_medis = $(this).attr("rekam-medis");
					var nama_pasien = $(this).attr("nama-pasien");
					var kelamin = $(this).attr("kelamin");
					var tanggal_lahir = $(this).attr("tanggal-lahir");
					var alamat = $(this).attr("alamat");
					var nama_dokter = $(this).attr("nama-dokter");
					var nama_poli = $(this).attr("nama-poli");
					var penyakit_atau_gejala = $(this).attr("penyakit");
					var keterangan = $(this).attr("keterangan");
					var total_harga = $(this).attr("total-harga");
					$("#modalTitle").html(nama_pasien+' | '+rekam_medis);
					$("#nama").html(": "+nama_pasien);
					$("#rm").html(": "+rekam_medis);
					$("#kelamin").html(": "+kelamin);
					$("#tanggal_lahir").html(": "+tanggal_lahir);
					$("#alamat").html(": "+alamat);
					$("#nama_dokter").html(": "+nama_dokter);
					$("#nama_poli").html(": "+nama_poli);
					$("#penyakit").html(": "+penyakit_atau_gejala);
					$("#total").html("Rp. "+total_harga);
					if(keterangan==="null") {
						$("#keterangan").html(": "+"Tidak ada keterangan...");
					} else {
						$("#keterangan").html(": "+keterangan);
					}
				});
				
				$('#exampleModalCenter').on('hidden.bs.modal', function () {
					$("#btnPrint").toggle();
				});
				
				// JS untuk cetak!
				document.getElementById("btnPrint").onclick = function() {
					printElement(document.getElementById("printThis"));
					window.print();
				}

				function printElement(elem, append) {
					var domClone = elem.cloneNode(true);

					var $printSection = document.getElementById("printSection");

					if (!$printSection) {
						var $printSection = document.createElement("div");
						$printSection.id = "printSection";
						document.body.appendChild($printSection);
					}
					
					  if (append !== true) {
							$printSection.innerHTML = "";
						}

					$printSection.appendChild(domClone);
				}
			}
	});
} );

//////// FILTER - Select
// Not working here, so I put it outside

//////// POPULATE - Pemeriksaan
// Not working here, so I put it outside