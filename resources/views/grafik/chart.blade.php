<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chart</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<canvas id="myChart" ></canvas>
	</div>

	<script type="text/javascript">
		let myChart = document.getElementById('myChart').getContext('2d');
		let dataSiswa = <?php echo $data; ?>;
		let tahun = <?php echo $tahun; ?>;
		let data = {
			labels:tahun,
			datasets:dataSiswa

		}
		let barChart = new Chart(myChart, {
			type: 'bar',
			data: data,
			options:{
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>