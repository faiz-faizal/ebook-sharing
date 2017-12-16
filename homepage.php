<?php 

  $titlepage = "Home";
  include "./template/header.php";

?>

<div id="homepage"></div>

<div class="wrapper">

<div class= "main col-md-9">
         

	<div class="panel panel-success">
		  <div class="panel-heading">Popular Books</div>
			  
		<!-- slide show -->
		<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 720px; height: 300px; overflow: hidden; visibility: hidden;">
			<!-- Loading Screen -->
			<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
				<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
				<div style="position:absolute;display:block;background:url('./images/banner/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
			</div>
			<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 720px; height: 300px; overflow: hidden;">
				<div data-p="112.50" style="display: none;">
					<img data-u="image" src="./images/banner/artofwar.jpg" />
				</div>
				<div data-p="112.50" style="display: none;">
					<img data-u="image" src="./images/banner/wrightbrother.jpg" />
				</div>
				<div data-p="112.50" style="display: none;">
					<img data-u="image" src="./images/banner/TopFour.png" />
				</div>
				<div data-p="112.50" style="display: none;">
					<img data-u="image" src="./images/banner/divergenttrilogy.jpg" />
				</div>
				<div data-p="112.50" style="display: none;">
					<img data-u="image" src="./images/banner/allegiant.jpg" />
				</div>
				<div data-p="112.50" style="display: none;">
					<img data-u="image" src="./images/banner/5thwave.jpg" />
				</div>
				<a data-u="add" href="http://www.jssor.com" style="display:none">Jssor Slider</a>
			
			</div>
			<!-- Bullet Navigator -->
			<div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
				<!-- bullet navigator item prototype -->
				<div data-u="prototype" style="width:16px;height:16px;"></div>
			</div>
			<!-- Arrow Navigator -->
			<span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
			<span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
		</div>

	</div>


	<div class="panel panel-warning">
		<div class="panel-heading">Newest Books</div>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="pill" href="#menu1">Education</a></li>
				<li><a data-toggle="pill" href="#menu2">Sci-Fi &amp; Fantasy</a></li>
				<li><a data-toggle="pill" href="#menu3">Novel</a></li>
				<li><a data-toggle="pill" href="#menu4">Other</a></li>
		  </ul>
		  
		 <div class="panel-body">
		 
			<div class="tab-content">

				<!-- list newest History Books -->
				<div id="menu1" class="tab-pane fade in active">
					<div class="row">
							<div id="listNewestHistory"></div>
						</div>
				</div>

				<!-- list newest SciFi Fantasy Books -->
				<div id="menu2" class="tab-pane fade">
					<div class="row">
							<div id="listNewestSciFi"></div>
						</div>
				</div>
				
				<div id="menu3" class="tab-pane fade">
					<div class="row">
							<div id="listNewestMystery"></div>
						</div>
				</div>
				
				<div id="menu4" class="tab-pane fade">
					<div class="row">
							<div id="listNewestRomance"></div>
						</div>
				</div>
				
			</div>
		<br>
		</div> 
	</div>
	
	<br><br><br><br><br><br><br>

	</div><!-- end  column -->
	
	<!-- Start side bar right -->
    <div class="sidebar col-md-3 hidden-sm hidden-xs">
         <div class="panel panel-primary">
			<div class="panel-heading">Search</div>
				<div class="panel-body">
					
					<form method="get" action="./search.php">
						<div class="input-group">
						  <input type="text" class="form-control" placeholder="Search Books..." id="searchTextBox" name="q" required="required">
						  <span class="input-group-btn">
							<button class="btn btn-success" type="submit" id="searchBookBut" name="searchSub"><i class="glyphicon glyphicon-search" style="font-size:20px;"></i></button>
						  </span>
						</div><!-- /input-group -->
					</form>
					<span style="float:right;"><a href="./search.php">Advanced Search</a></span>
				</div>
		 </div>
   </div>
   
    <div class="sidebar col-md-3 hidden-sm hidden-xs">
         <div class="panel panel-danger">
			<div class="panel-heading">Upcoming Books</div>
				<div class="panel-body">
					
					<div id="listUpcomingBookHomepage"></div>
					
				</div>
		 </div>
   </div>
   <!-- end side bar right -->

</div> <!-- end wrapper -->


<!--BOOKS MODAL -->

<!-- Modal Show Books Details -->
  <div class="modal fade" id="book" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Book Details</h4>
        </div>
        <div class="modal-body">
			<div id="modalpages"></div>
        
        </div>
      </div>
      
    </div>
 </div>

<!-- END BOOKS MODAL-->


<?php include "./template/footer.php"; ?>

<!--CSS FONTAWESOME ADE FONT,ICON
contoh yg kita gunakan : facebook, insta icon-->