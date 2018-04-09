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
  chart: {
      type: 'column',
      options3d: {
          enabled: true,
          alpha: 10,
          beta: 25,
          depth: 70
      }
  },
  title: {
      text: 'Sales by Month'
  },
  subtitle: {
      text: 'Notice the difference between a 0 value and a null point'
  },
  plotOptions: {
      column: {
          depth: 25
      }
  },
  xAxis: {
      categories: Highcharts.getOptions().lang.shortMonths,
      labels: {
          skew3d: true,
          style: {
              fontSize: '16px'
          }
      }
  },
  yAxis: {
      title: {
          text: null
      }
  },
  series: [{
      name: 'Sales',
      data: [2, 3, null, 4, 0, 5, 1, 4, 6, 3]
  }]
});
	</script>
  </body>
</html>
