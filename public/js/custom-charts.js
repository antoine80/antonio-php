$(function () {
	//console.log(javascript);
	var devices = javascript.points;
	var deviceNames = Object.keys(devices);
	
	// Entramos en cada uno de los devices dentro de device.
	for (var i = 0; i < deviceNames.length; i++) {
		var chartData = {};
		var deviceName = deviceNames[i];
		var sensors = devices[deviceName];
		var series = [];
		var sensorNames = Object.keys(sensors);
		// Entramos en cada sensor del dispositivo
		for(x = 0; x < sensorNames.length; x++){
			var sensorName = sensorNames[x];
			// Generamos una serie para cada sensor 
			var serie = sensors[sensorName];
			var parsed = serie.map(function(element){
				return [element[0], parseFloat(element[1])];
			});
			series.push({
				name: sensorName,
				data: parsed
			});
		}
		
		// Asignamos series para el highchart
		chartData.series = series;

		// Le damos un title al highchart
		chartData.title = 'Device: ' + deviceNames[i];
		console.log(chartData);
		
		// Ejecutamos la función sobre el selector jquery
		printChart($('#' + deviceName + '-chart'), chartData);
	};

	function printChart(el, chartData) {

		el.highcharts({
	        chart: {
	            type: 'spline'
	        },
	        title: {
	            text: chartData.title,
	        },
	        subtitle: {
	            text: 'Irregular time data in Highcharts JS'
	        },
	        xAxis: {
	            type: 'datetime',
	            dateTimeLabelFormats: { // don't display the dummy year
	                month: '%e. %b',
	                year: '%b'
	            },
	            title: {
	                text: 'Date'
	            }
	        },
	        yAxis: {
	            title: {
	                text: 'Snow depth (m)'
	            },
	            min: 0
	        },
	        tooltip: {
	            headerFormat: '<b>{series.name}</b><br>',
	            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
	        },

	        plotOptions: {
	            spline: {
	                marker: {
	                    enabled: true
	                }
	            }
	        },

	        series: chartData.series
	    });

	};
   
    
});

