<?php include './template/header.php'; ?>

<div id="statistics"></div>
	
	<!-- book statistics -->
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-fw fa-book"></i> Books Statistics</h3>
		</div>
		
		<div class="box-body">

			<div id="disptotalBooks"></div>

			<canvas id="pieBooksGenre" width="409" height="130"></canvas>

		</div>
	</div>

	<!-- ratings statistics -->
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-fw fa-star"></i> Ratings Statistics</h3>
		</div>
		
		<div class="box-body">

			<div id="disptotalRatings"></div>

			<canvas id="barChart" width="409" height="130"></canvas>

		</div>
	</div>


<?php include './template/footer.php'; ?>