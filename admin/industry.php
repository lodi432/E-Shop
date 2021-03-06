<?php include_once '../konfiguracija.php';

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once 'includes/head.php'; ?>
    <style>
    	#container {
			min-width: 310px;
			max-width: 800px;
			height: 400px;
			margin: 0 auto;
		}
    </style>
  </head>
  <body>
      	<?php include_once 'includes/panel.php'; ?>
    <div class="grid-container">



      	<div class="grid-x grid-padding-x">
			<div class="large-12 cell">
				<div id="container"></div>
			</div>
		</div>



    </div>

    <script src="<?php echo $putanjaApp; ?>js/vendor/highcharts/highcharts.js"></script>
	<script src="<?php echo $putanjaApp; ?>js/vendor/highcharts/series-label.js"></script>
	<script src="<?php echo $putanjaApp; ?>js/vendor/highcharts/exporting.js"></script>
	<script>
		Highcharts.chart('container', {

		    title: {
		        text: 'Solar Employment Growth by Sector, 2010-2016'
		    },

		    subtitle: {
		        text: 'Source: thesolarfoundation.com'
		    },

		    yAxis: {
		        title: {
		            text: 'Number of Employees'
		        }
		    },
		    legend: {
		        layout: 'vertical',
		        align: 'right',
		        verticalAlign: 'middle'
		    },

		    plotOptions: {
		        series: {
		            label: {
		                connectorAllowed: false
		            },
		            pointStart: 2010
		        }
		    },

		    series: [{
		        name: 'Installation',
		        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
		    }, {
		        name: 'Manufacturing',
		        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
		    }, {
		        name: 'Sales & Distribution',
		        data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
		    }, {
		        name: 'Project Development',
		        data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
		    }, {
		        name: 'Other',
		        data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
		    }],

		    responsive: {
		        rules: [{
		            condition: {
		                maxWidth: 500
		            },
		            chartOptions: {
		                legend: {
		                    layout: 'horizontal',
		                    align: 'center',
		                    verticalAlign: 'bottom'
		                }
		            }
		        }]
		    }

		});
	</script>
  </body>
</html>
