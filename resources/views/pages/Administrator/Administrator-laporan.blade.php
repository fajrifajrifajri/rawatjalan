@extends('layouts.Administrator')

@section('content')
	<div id="laporan" class="col-md-10">
		<div class="row">
			<div class="col-md-6 pt-md-3">
				<h2 class="text-center">Kunjungan bulan ini</h2>
				<div id="pengunjungBulanan"></div>
			</div>
			<div class="col-md-6 pt-md-3">
				<h2 class="text-center">Kunjungan tahun ini</h2>
				<div id="pengunjungTahunan"></div>
			</div>
			<div class="col-md-6 pt-md-3">
				<h2 class="text-center">Poliklinik bulan ini</h2>
				<div id="poliklinikBulanan"></div>
			</div>
			<div class="col-md-6 pt-md-3">
				<h2 class="text-center">Poliklinik tahun ini</h2>
				<div id="poliklinikTahunan"></div>
			</div>
	</div>
<!-- Resources -->
<script src={{asset('libs/amcharts4/core.js')}}></script>
<script src={{asset('libs/amcharts4/charts.js')}}></script>
<script src={{asset('libs/amcharts4/themes/animated.js')}}></script>

<!-- Chart code -->
<script>
am4core.ready(function() {
	// 4 Functions untuk masing-masing chart
	function showIndicator(chart, indicator, indicatorInterval) {
		if (!indicator) {
			indicator = chart.tooltipContainer.createChild(am4core.Container);
			indicator.background.fill = am4core.color("#fff");
			indicator.background.fillOpacity = 0.8;
			indicator.width = am4core.percent(100);
			indicator.height = am4core.percent(100);

			var indicatorLabel = indicator.createChild(am4core.Label);
			indicatorLabel.text = "Tunggu sebentar...";
			indicatorLabel.align = "center";
			indicatorLabel.valign = "middle";
			indicatorLabel.fontSize = 20;
			indicatorLabel.dy = 50;
			
			var hourglass = indicator.createChild(am4core.Image);
			hourglass.href = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-160/hourglass.svg";
			hourglass.align = "center";
			hourglass.valign = "middle";
			hourglass.horizontalCenter = "middle";
			hourglass.verticalCenter = "middle";
			hourglass.scale = 0.7;
		}
		indicator.hide(0);
		indicator.show();
	  
		  clearInterval(indicatorInterval);
		  indicatorInterval = setInterval(function() {
			hourglass.animate([{
			  from: 0,
			  to: 360,
			  property: "rotation"
			}], 2000);
		  }, 3000);
		  indicatorPengunjungBulanan = indicator;
		  indicatorIntervalPengunjungBulanan = indicatorInterval;
	}
	
	function showIndicatorI(chart, indicator, indicatorInterval) {
		if (!indicator) {
			indicator = chart.tooltipContainer.createChild(am4core.Container);
			indicator.background.fill = am4core.color("#fff");
			indicator.background.fillOpacity = 0.8;
			indicator.width = am4core.percent(100);
			indicator.height = am4core.percent(100);

			var indicatorLabel = indicator.createChild(am4core.Label);
			indicatorLabel.text = "Tunggu sebentar...";
			indicatorLabel.align = "center";
			indicatorLabel.valign = "middle";
			indicatorLabel.fontSize = 20;
			indicatorLabel.dy = 50;
			
			var hourglass = indicator.createChild(am4core.Image);
			hourglass.href = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-160/hourglass.svg";
			hourglass.align = "center";
			hourglass.valign = "middle";
			hourglass.horizontalCenter = "middle";
			hourglass.verticalCenter = "middle";
			hourglass.scale = 0.7;
		}
		indicator.hide(0);
		indicator.show();
	  
		  clearInterval(indicatorInterval);
		  indicatorInterval = setInterval(function() {
			hourglass.animate([{
			  from: 0,
			  to: 360,
			  property: "rotation"
			}], 2000);
		  }, 3000);
		  indicatorPengunjungTahunan = indicator;
		  indicatorIntervalPengunjungTahunan = indicatorInterval;
	}
	
	function showIndicatorX(chart, indicator, indicatorInterval) {
		if (!indicator) {
			indicator = chart.tooltipContainer.createChild(am4core.Container);
			indicator.background.fill = am4core.color("#fff");
			indicator.background.fillOpacity = 0.8;
			indicator.width = am4core.percent(100);
			indicator.height = am4core.percent(100);

			var indicatorLabel = indicator.createChild(am4core.Label);
			indicatorLabel.text = "Tunggu sebentar...";
			indicatorLabel.align = "center";
			indicatorLabel.valign = "middle";
			indicatorLabel.fontSize = 20;
			indicatorLabel.dy = 50;
			
			var hourglass = indicator.createChild(am4core.Image);
			hourglass.href = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-160/hourglass.svg";
			hourglass.align = "center";
			hourglass.valign = "middle";
			hourglass.horizontalCenter = "middle";
			hourglass.verticalCenter = "middle";
			hourglass.scale = 0.7;
		}
		indicator.hide(0);
		indicator.show();
	  
		  clearInterval(indicatorInterval);
		  indicatorInterval = setInterval(function() {
			hourglass.animate([{
			  from: 0,
			  to: 360,
			  property: "rotation"
			}], 2000);
		  }, 3000);
		  indicatorPoliklinikBulanan = indicator;
		  indicatorIntervalPoliklinikBulanan = indicatorInterval;
	}
	
	function showIndicatorY(chart, indicator, indicatorInterval) {
		if (!indicator) {
			indicator = chart.tooltipContainer.createChild(am4core.Container);
			indicator.background.fill = am4core.color("#fff");
			indicator.background.fillOpacity = 0.8;
			indicator.width = am4core.percent(100);
			indicator.height = am4core.percent(100);

			var indicatorLabel = indicator.createChild(am4core.Label);
			indicatorLabel.text = "Tunggu sebentar...";
			indicatorLabel.align = "center";
			indicatorLabel.valign = "middle";
			indicatorLabel.fontSize = 20;
			indicatorLabel.dy = 50;
			
			var hourglass = indicator.createChild(am4core.Image);
			hourglass.href = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-160/hourglass.svg";
			hourglass.align = "center";
			hourglass.valign = "middle";
			hourglass.horizontalCenter = "middle";
			hourglass.verticalCenter = "middle";
			hourglass.scale = 0.7;
		}
		indicator.hide(0);
		indicator.show();
	  
		  clearInterval(indicatorInterval);
		  indicatorInterval = setInterval(function() {
			hourglass.animate([{
			  from: 0,
			  to: 360,
			  property: "rotation"
			}], 2000);
		  }, 3000);
		  indicatorPoliklinikTahunan = indicator;
		  indicatorIntervalPoliklinikTahunan = indicatorInterval;
	}

	function hideIndicator(indicator, indicatorInterval) {
	  indicator.hide();
	  clearInterval(indicatorInterval);
	}
	
	///// Chart Pengunjung bulanan
	am4core.useTheme(am4themes_animated);
	var chartpengunjungBulanan = am4core.create("pengunjungBulanan", am4charts.XYChart);
	
	// Inisiasi loading
	chartpengunjungBulanan.preloader.disabled = true;
	var indicatorPengunjungBulanan;
	var indicatorIntervalPengunjungBulanan;
	showIndicator(chartpengunjungBulanan, indicatorPengunjungBulanan, indicatorIntervalPengunjungBulanan);
	
	// Load data
	var data = [];
	chartpengunjungBulanan.dataSource.url = "/api/pengunjungBulanan";
	chartpengunjungBulanan.dataSource.events.on("done", function(ev) {
		chartpengunjungBulanan.data = ev.data[0].data;
	  
		var categoryAxis = chartpengunjungBulanan.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.ticks.template.disabled = true;
		categoryAxis.renderer.line.opacity = 0;
		categoryAxis.renderer.grid.template.disabled = true;
		categoryAxis.renderer.minGridDistance = 40;
		categoryAxis.dataFields.category = "tanggal";
		categoryAxis.startLocation = 0.4;
		categoryAxis.endLocation = 0.6;


		var valueAxis = chartpengunjungBulanan.yAxes.push(new am4charts.ValueAxis());
		valueAxis.tooltip.disabled = true;
		valueAxis.renderer.line.opacity = 0;
		valueAxis.renderer.ticks.template.disabled = true;
		valueAxis.min = 0;

		var lineSeries = chartpengunjungBulanan.series.push(new am4charts.LineSeries());
		lineSeries.dataFields.categoryX = "tanggal";
		lineSeries.dataFields.valueY = "pengunjung";
		lineSeries.tooltipText = "pengunjung: {valueY.value}";
		lineSeries.fillOpacity = 0.5;
		lineSeries.strokeWidth = 3;
		lineSeries.propertyFields.stroke = "lineColor";
		lineSeries.propertyFields.fill = "lineColor";

		var bullet = lineSeries.bullets.push(new am4charts.CircleBullet());
		bullet.circle.radius = 6;
		bullet.circle.fill = am4core.color("#fff");
		bullet.circle.strokeWidth = 3;

		chartpengunjungBulanan.cursor = new am4charts.XYCursor();
		chartpengunjungBulanan.cursor.behavior = "panX";
		chartpengunjungBulanan.cursor.lineX.opacity = 0;
		chartpengunjungBulanan.cursor.lineY.opacity = 0;

		chartpengunjungBulanan.scrollbarX = new am4core.Scrollbar();
		chartpengunjungBulanan.scrollbarX.parent = chartpengunjungBulanan.bottomAxesContainer;
		
		// Hilangkan loading
		hideIndicator(indicatorPengunjungBulanan, indicatorIntervalPengunjungBulanan);
	});

	///// Chart Pengunjung tahunan
	var chartpengunjungTahunan = am4core.create("pengunjungTahunan", am4charts.XYChart);
	
	// Inisiasi loading
	chartpengunjungTahunan.preloader.disabled = true;
	
	var indicatorPengunjungTahunan;
	var indicatorIntervalPengunjungTahunan;
	showIndicatorI(chartpengunjungTahunan, indicatorPengunjungTahunan, indicatorIntervalPengunjungTahunan);
	
	// Load data
	var data = [];

	chartpengunjungTahunan.dataSource.url = "/api/pengunjungTahunan";
	chartpengunjungTahunan.dataSource.events.on("done", function(ev) {
		chartpengunjungTahunan.data = ev.data[0].data;
	  
		var categoryAxis = chartpengunjungTahunan.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.ticks.template.disabled = true;
		categoryAxis.renderer.line.opacity = 0;
		categoryAxis.renderer.grid.template.disabled = true;
		categoryAxis.renderer.minGridDistance = 40;
		categoryAxis.dataFields.category = "tanggal";
		categoryAxis.startLocation = 0.4;
		categoryAxis.endLocation = 0.6;


		var valueAxis = chartpengunjungTahunan.yAxes.push(new am4charts.ValueAxis());
		valueAxis.tooltip.disabled = true;
		valueAxis.renderer.line.opacity = 0;
		valueAxis.renderer.ticks.template.disabled = true;
		valueAxis.min = 0;

		var lineSeries = chartpengunjungTahunan.series.push(new am4charts.LineSeries());
		lineSeries.dataFields.categoryX = "tanggal";
		lineSeries.dataFields.valueY = "pengunjung";
		lineSeries.tooltipText = "pengunjung: {valueY.value}";
		lineSeries.fillOpacity = 0.5;
		lineSeries.strokeWidth = 3;
		lineSeries.propertyFields.stroke = "lineColor";
		lineSeries.propertyFields.fill = "lineColor";

		var bullet = lineSeries.bullets.push(new am4charts.CircleBullet());
		bullet.circle.radius = 6;
		bullet.circle.fill = am4core.color("#fff");
		bullet.circle.strokeWidth = 3;

		chartpengunjungTahunan.cursor = new am4charts.XYCursor();
		chartpengunjungTahunan.cursor.behavior = "panX";
		chartpengunjungTahunan.cursor.lineX.opacity = 0;
		chartpengunjungTahunan.cursor.lineY.opacity = 0;

		chartpengunjungTahunan.scrollbarX = new am4core.Scrollbar();
		chartpengunjungTahunan.scrollbarX.parent = chartpengunjungTahunan.bottomAxesContainer;
		
		// Hilangkan loading
		hideIndicator(indicatorPengunjungTahunan, indicatorIntervalPengunjungTahunan);
	});
	
	///// Chart poliklinik bulanan
	var chartpoliklinikBulanan = am4core.create("poliklinikBulanan", am4charts.PieChart);

	// Inisiasi loading
	chartpoliklinikBulanan.preloader.disabled = true;
	
	var indicatorPoliklinikBulanan;
	var indicatorIntervalPoliklinikBulanan;
	showIndicatorX(chartpoliklinikBulanan, indicatorPoliklinikBulanan, indicatorIntervalPoliklinikBulanan);

	// Load data
	var data = [];

	chartpoliklinikBulanan.dataSource.url = "/api/poliklinikBulanan";
	chartpoliklinikBulanan.dataSource.events.on("done", function(ev) {
		chartpoliklinikBulanan.data = ev.data[0].data;
	  
		var pieSeries = chartpoliklinikBulanan.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "pengunjung";
		pieSeries.dataFields.category = "poli";
		
		// Hilangkan loading
		hideIndicator(indicatorPoliklinikBulanan, indicatorIntervalPoliklinikBulanan);
	});
	
	///// Chart poliklinik tahunan
	var chartpoliklinikTahunan = am4core.create("poliklinikTahunan", am4charts.PieChart);

	// Inisiasi loading
	chartpoliklinikTahunan.preloader.disabled = true;

	var indicatorPoliklinikTahunan;
	var indicatorIntervalPoliklinikTahunan;
	showIndicatorY(chartpoliklinikTahunan, indicatorPoliklinikTahunan, indicatorIntervalPoliklinikTahunan);

	// Load data
	var data = [];

	chartpoliklinikTahunan.dataSource.url = "/api/poliklinikTahunan";
	chartpoliklinikTahunan.dataSource.events.on("done", function(ev) {
		chartpoliklinikTahunan.data = ev.data[0].data;
	  
		var pieSeries = chartpoliklinikTahunan.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "pengunjung";
		pieSeries.dataFields.category = "poli";
		
		// Hilangkan loading
		hideIndicator(indicatorPoliklinikTahunan, indicatorIntervalPoliklinikTahunan);
	});

}); // end am4core.ready()
</script>
@endsection