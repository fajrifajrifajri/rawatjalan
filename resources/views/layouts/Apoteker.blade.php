<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Aplikasi Rawat Jalan</title>
  @include('inc.head')
</head>
<body id="administrator">
	@include('inc.Apoteker-nav')
	<main>
		<div class="row">
			@include('inc.Administrator-sidebar')
			@yield('content')
		</div>
	</main>
	@include('inc.scripts')
	<script>
	
	///// PAGE - PEMERIKSAAN /////
	$(document).ready(function () {    
		var daftarPasien = $('.pasiendifilter')
		$('#selectpoli').change(function () {
			$('.pasiendifilter').detach()
			var classPoliSelected = $('#selectpoli option:selected').prop('class');
			
			console.log(classPoliSelected)
			if(classPoliSelected === "") {
				$.each(daftarPasien, function (i, j) {
					$(j).appendTo('#pemeriksaan-pasien');
				});
			}
			
			var poliSelected = daftarPasien.filter('.' + classPoliSelected);
			$.each(poliSelected, function (i, j) {
				$(j).appendTo('#pemeriksaan-pasien');
			});
		});
	});
	
	//////// POPULATE - Pemeriksaan
	$(".populate").click(function () {
		var id_pasien = $(this).attr("id-pasien");
		var nama_pasien = $(this).attr("nama-pasien");
		var poliklinik = $(this).attr("poliklinik");
		$("#nama_pasien").val(nama_pasien);
		$("#poliklinik").val(poliklinik);
		$("#id_pasien").val(id_pasien);
	});
	$(document).ready(function() {
		$("#searchObat").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".list-obat label span, .list-resep label span").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
			  $(this).parent().parent().toggle($(this).text().toLowerCase().indexOf(value) > -1);
			});
		  });
		  
		$("#searchResep").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".list-resep label span").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
			  $(this).parent().parent().toggle($(this).text().toLowerCase().indexOf(value) > -1);
			});
		  });
		  
		$('.obat').change(function() {
/*(1)*/		if ($(".obat").is(":checked")) { // event ketika obat dicentang
				var parent = $(this).parent();
				var inputQty = parent.children("input[type=number]");
				inputQty.toggle(); // mentoggle() dari display: none; jadi display: block;
				
				var nama_obat = parent.find("span").text();
				var harga_obat = $(this).attr("harga-obat");
				var value_checkbox = parent.children("input[type=checkbox]").val();
				var value_checkbox_split = value_checkbox.split(",");
				var id_obat = value_checkbox_split[0];
				console.log(value_checkbox)
				if ($(".qty_obat_"+id_obat).length) { // seandainya <span> rincian obat sudah terbuat
					$(".qty_obat_"+id_obat).toggle(); // toggle span rincian obat
				} else {
					$(".rincian-obat").append("<li class='qty_obat_"+id_obat+"'><span class='mr-md-1'>"+nama_obat+": </span><span class='badge badge-success mr-md-1'>Rp. "+harga_obat+"</span><span class='badge badge-secondary'></span></li>");
				};
			} else {
				var parent = $(this).parent();
				var inputQty = parent.children("input[type=number]");
				inputQty.toggle();
			}
/*(2)*/		$( '.qtyObat' ).on('input', function() { // event input type="number" jumlah obat
				console.log("Obat");
				var parent = $(this).parent();
				var checkbox = parent.children("input[type=checkbox]");
				var id_obat = checkbox.val();
				var inputQty = $(this);
				
				var qty = inputQty.val();
				$(".qty_obat_"+id_obat).find("span:last").text(qty);
				
				
				var currentCheckboxVal = checkbox.val();
				currentCheckboxVal = currentCheckboxVal.split(",");
				if(currentCheckboxVal.length > 1) {
					console.log(currentCheckboxVal)
					currentCheckboxVal = currentCheckboxVal[0];
				}
				console.log(currentCheckboxVal)
				checkbox.val(currentCheckboxVal+","+qty)
				
				var total = 0; 
				
				$('.obat:checked, .resep:checked').each(function(){ // hitung total menggunakan each() 
					var qty = parseInt($(this).parent().find('input[type=number]').val());
					total += isNaN(parseInt($(this).attr("harga-obat"))) ? 0 : parseInt($(this).attr("harga-obat")) * (isNaN(qty) ? 0 : qty);
					$("#harga_obat").text(total); // untuk display rincian total
					$("#harga_obat1").val(total); // input type="hidden" harga (untuk ke controller)
				});
			}); 
			var checkedObat = $('.obat').is(':checked'); 
/*(3)*/		if (!checkedObat){ // dikeluarkan dari fungsi diatas, value checkedObat akan menjadi array [ .toggle() jadi ngelooping]
				var value_checkbox = parent.children("input[type=checkbox]").val();
				var value_checkbox_split = value_checkbox.split(",");
				var id_obat = value_checkbox_split[0];
				$(".qty_obat_"+id_obat).toggle(); // toggle span rincian obat
			}
			// [repeat coding :75] tapi untuk di event :checked
			var total2 = 0
			$('.obat:checked, .resep:checked').each(function(){
				var qty = parseInt($(this).parent().find('input[type=number]').val());
				total2 += isNaN(parseInt($(this).attr("harga-obat"))) ? 0 : parseInt($(this).attr("harga-obat")) * (isNaN(qty) ? 0 : qty);
				$("#harga_obat").text(total2); // untuk display rincian total
				$("#harga_obat1").val(total2); // input type="hidden" harga (untuk ke controller)
			});
			
			// Jika seandainya tidak ada checkbox yang dicentang //
			if($('.obat:checked, .resep:checked').length === 0) {
				// Maka total harga kosong (0)
				$("#harga_obat").text(0); // untuk display rincian total
				$("#harga_obat1").val(0); // input type="hidden" harga (untuk ke controller)
			}
		});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$('.resep').change(function() {
/*(1)*/		if ($(".resep").is(":checked")) {
				var parent = $(this).parent();
				var inputQty = parent.children("input[type=number]");
				inputQty.toggle();
				
				var nama_resep = parent.find("span").text();
				var harga_resep = $(this).attr("harga-obat");
				var value_checkbox = parent.children("input[type=checkbox]").val();
				var value_checkbox_split = value_checkbox.split(",");
				var id_resep = value_checkbox_split[0];
				
				if ($(".qty_resep_"+id_resep).length) {
					$(".qty_resep_"+id_resep).toggle(); 
				} else {
					$(".rincian-resep").append("<li class='qty_resep_"+id_resep+"'><span class='mr-md-1'>"+nama_resep+": </span><span class='badge badge-success mr-md-1'>Rp. "+harga_resep+"</span><span class='badge badge-secondary'></span></li>");
				};
			} else {
				var parent = $(this).parent();
				var inputQty = parent.children("input[type=number]");
				inputQty.toggle();
			}
/*(2)*/		$( '.qtyResep' ).on('input', function() {
				console.log("Resep");
				var parent = $(this).parent();
				var checkbox = parent.children("input[type=checkbox]");
				var id_resep = checkbox.val();
				var inputQty = $(this);
				
				var qty = inputQty.val();
				$(".qty_resep_"+id_resep).find("span:last").text(qty);
				
				
				var currentCheckboxVal = checkbox.val();
				currentCheckboxVal = currentCheckboxVal.split(",");
				if(currentCheckboxVal.length > 1) {
					console.log(currentCheckboxVal)
					currentCheckboxVal = currentCheckboxVal[0];
				}
				console.log(currentCheckboxVal)
				checkbox.val(currentCheckboxVal+","+qty)
				
				var total = 0; 
				
				$('.obat:checked, .resep:checked').each(function(){ 
					var qty = parseInt($(this).parent().find('input[type=number]').val());
					total += isNaN(parseInt($(this).attr("harga-obat"))) ? 0 : parseInt($(this).attr("harga-obat")) * (isNaN(qty) ? 0 : qty);
					$("#harga_obat").text(total);  // var harga_obat biar sama dengan function obat
					$("#harga_obat1").val(total); // ini juga sama
				});
			}); 
			var checkedResep = $('.resep').is(':checked'); 
/*(3)*/		if (!checkedResep){
				var value_checkbox = parent.children("input[type=checkbox]").val();
				var value_checkbox_split = value_checkbox.split(",");
				var id_resep = value_checkbox_split[0];
				$(".qty_resep_"+id_resep).toggle(); 
			}
			//
			var total2 = 0
			$('.obat:checked, .resep:checked').each(function(){
				var qty = parseInt($(this).parent().find('input[type=number]').val());
				total2 += isNaN(parseInt($(this).attr("harga-obat"))) ? 0 : parseInt($(this).attr("harga-obat")) * (isNaN(qty) ? 0 : qty);
				$("#harga_obat").text(total2); // sama kaya coding: 127
				$("#harga_obat1").val(total2);  // ini juga sama
			});
			
			// Jika seandainya tidak ada checkbox yang dicentang //
			if($('.obat:checked, .resep:checked').length === 0) {
				// Maka total harga kosong (0)
				$("#harga_obat").text(0); // untuk display rincian total
				$("#harga_obat1").val(0); // input type="hidden" harga (untuk ke controller)
			}
		});
	});
	
	//////// TOOLTIPS - Pemeriksaan
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});
	</script>
</body>
</html>