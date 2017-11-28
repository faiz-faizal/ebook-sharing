$(document).ready(function(){
	
	$('.overlay').hide();
	$('.sk-circle').hide();
	
	// Remove active for all items.
  $('.sidebar-menu li').removeClass('active');

  
  // highlight submenu item
  var locations = this.location.pathname;
  var newloc = "." + locations.substring(15);
  $('li a[href="' + newloc + '"]').parent().addClass('active');
  
  if(locations == "/elibrary/admin/home.php" 
    || locations == "/elibrary/admin/" || 
    locations == "/elibrary/admin")
  {
    $('li a[href="./home.php"]').parent().addClass('active');
  }
  
  /*USER THIS INSTEAD OF ABOVE CODE IF THE FILES IS HOSTED IN THE ROOT DIRECTORY
   // highlight submenu item
  var locations = this.location.pathname;
  var newloc = "." + locations.substring(6);
  $('li a[href="' + newloc + '"]').parent().addClass('active');
  
  if(locations == "/admin/home.php" || locations == /admin/)
  {
    $('li a[href="./home.php"]').parent().addClass('active');
  }
  */



	
	
	//-----------------------------ADMIN PROCESSES-------------------------------------------------------------------------------
	
	//populate select box in Add Form
	$(function(){
			if($('#addBookPage').length > 0 || $('#upEBookPage').length > 0){
				
				//book genres
				$.post("./process.php", "option=selectbox&type=bgenres", function(data){
						$('#bgenre').append(data);
				});

				//book language
				$.post("./process.php", "option=selectbox&type=blang", function(data){
						$('#blang').append(data);
				});
			}	
	});	
	
	//add data
	$(document).on('click', '#addBut', function() {
		
		//START form required error checking
		$('#err1').empty(); $('#err2').empty(); $('#err3').empty(); $('#err4').empty(); $('#err5').empty();
		$('#err6').empty(); $('#err7').empty(); 
		$('#btitle').removeClass("error");  $('#bauthor').removeClass("error");  $('#bgenre').removeClass("error");  
		$('#bpublish').removeClass("error");  $('#blang').removeClass("error");  $('#bpages').removeClass("error");  
		$('#bsyn').removeClass("error");
		
		var required = "<font color='red'>Required</font>";
		if($('#btitle').val() == "" ){$('#err1').append(required); $('#btitle').addClass("error");}  
		if($('#bauthor').val() == ""){$('#err2').append(required); $('#bauthor').addClass("error");}
		if($('#bgenre').val() == ""){$('#err3').append(required); $('#bgenre').addClass("error");}
		if($('#bpublish').val() == ""){$('#err4').append(required); $('#bpublish').addClass("error");}
		if($('#blang').val() == ""){$('#err5').append(required); $('#blang').addClass("error");}
		if($('#bpages').val() == ""){$('#err6').append(required); $('#bpages').addClass("error");}
		if($('#bsyn').val() == ""){$('#err7').append(required); $('#bsyn').addClass("error");}
		
		if(
			($('#btitle').val() == "") || ($('#bauthor').val() == "") || ($('#bgenre').val() == "") || 
			($('#bpublish').val() == "") || ($('#blang').val() == "") || ($('#bpages').val() == "") || 
			($('#bsyn').val() == "")
			)
			{alertify.alert("Please complete all the required fields first before submitting");}
			
		//END form required error checking
		
		//process run if no required fields error
		if(($('#btitle').val() != "") && ($('#bauthor').val() != "") && ($('#bgenre').val() != "") && 
			($('#bpublish').val() != "") && ($('#blang').val() != "") && ($('#bpages').val() != "") && 
			($('#bsyn').val() != ""))
			{
				alertify.confirm("<i class='fa fa-fw fa-warning'></i> Are you sure?",function(){
			
					$('.overlay').show();
					$('.sk-circle').show();
					
					var formData = new FormData($('#addForm')[0]);
					$.ajax({
						
						url: "./process.php",
						type: "POST",
						data: formData,
						async: false,
						success: function(data){
							$('#resultadd').append(data);
							$("#addForm")[0].reset();
							$('#image_upload_preview').attr('src', "../images/bookscover/book_temp.png");
							alertify.success("Data added");	
						},
						contentType: false,
						cache: false,
						processData: false,
							
					});
					
					$('.overlay').hide();
					$('.sk-circle').hide();

					//e.preventDefault();
								
					});
			}
	});
	
	//image preview before upload
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#image_upload_preview').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
    }

	$(document).on('change', '#fileToUpload', function() {
        readURL(this);
		$('#labelupphoto').text('New Photo');
    });
	
	//count text and display current char count, show warning and disable submit when reached limit
	//for description text area in add stock form
	$('#bsyn').keyup(function () {
	  var max = 1200;
	  var len = $(this).val().length;
	  
	  if (len >= (max-10) && len <= max) {
		 var char = max - len;
		$('#charNum').html("<font color='red'>"+char + " characters left</font>");
		$('#addBut').prop('disabled', false);
	  } 
	  else if (len >= max) {
		 var char = max - len;
		$('#charNum').html("<font color='red'>"+char + " you have reached the limit</font>");
		$('#addBut').prop('disabled', true);
	  } 
	  else {
		var char = max - len;
		$('#charNum').text(char + ' characters left');
		$('#addBut').prop('disabled', false);
	  }
	  
	});

	//-------START UPLOAD NEW EBOOK---------
	//add data
	$(document).on('click', '#upEbookBut', function() {
		
		//START form required error checking
		$('#err1').empty(); $('#err2').empty(); $('#err3').empty(); $('#err4').empty(); $('#err5').empty();
		$('#btitle').removeClass("error");  $('#bauthor').removeClass("error");  $('#bgenre').removeClass("error");  
		$('#fileToUpload').removeClass("error"); $('#bsyn').removeClass("error");
		
		var required = "<font color='red'>Required</font>";
		if($('#btitle').val() == "" ){$('#err1').append(required); $('#btitle').addClass("error");}  
		if($('#bauthor').val() == ""){$('#err2').append(required); $('#bauthor').addClass("error");}
		if($('#bgenre').val() == ""){$('#err3').append(required); $('#bgenre').addClass("error");}
		if($('#fileToUpload').val() == ""){$('#err4').append(required); $('#fileToUpload').addClass("error");}
		if($('#bsyn').val() == ""){$('#err5').append(required); $('#bsyn').addClass("error");}
		
		if(
			($('#btitle').val() == "") || ($('#bauthor').val() == "") || ($('#bgenre').val() == "") || 
			($('#fileToUpload').val() == "") || ($('#bsyn').val() == "")
			)
			{alertify.alert("Please complete all the required fields first before submitting");}
			
		//END form required error checking
		
		//process run if no required fields error
		if(($('#btitle').val() != "") && ($('#bauthor').val() != "") && ($('#bgenre').val() != "") && 
			($('#fileToUpload').val() != "") && ($('#bsyn').val() != ""))
			{
				alertify.confirm("<i class='fa fa-fw fa-warning'></i> Are you sure?",function(){
			
					$('.overlay').show();
					$('.sk-circle').show();
					
					var formData = new FormData($('#upEbookForm')[0]);
					$.ajax({
						
						url: "./process.php",
						type: "POST",
						data: formData,
						async: false,
						success: function(data){
							$('#resultadd').append(data);
							$("#upEbookForm")[0].reset();
							alertify.success("Data added");	
							$('#listEbookManage').empty();
							listEbookData();
						},
						contentType: false,
						cache: false,
						processData: false,
							
					});
					
					$('.overlay').hide();
					$('.sk-circle').hide();

					//e.preventDefault();
								
					});
			}
	});

	//list upcoming ebook data
	$(function(){
			if($('#upEBookPage').length > 0){
				$('.overlay').show();
				$('.sk-circle').show();
				$('#listEbookManage').empty();
				
				listEbookData();
			}	
	});	

	function listEbookData()
	{
		$.post("./process.php", "option=listebookmanage", function(data){
					
			$('.overlay').hide();
			$('.sk-circle').hide();
			
			$('#listEbookManage').append(data).hide().fadeIn('slow');
			alertify.success("All data loaded");
		});
	}

	//show delete button when checkbox is checked
	$(document).on("click","#deleteitemEbook",function(){
		
		var anycheckbox = false;
		$('#formEbook input[type="checkbox"]').each(function(){
			if($(this).is(":checked")) {
				anycheckbox = true;
			}
		});
		
		if(anycheckbox == true){
			$('#deletebutEbook').fadeIn('slow');
		}
		else
		{
			$('#deletebutEbook').fadeOut('slow');
		}
		
	});

	//delete multiple items
	$(document).on("click",'#deletebutEbook',function(){
		
		alertify.confirm("Are sure sure?",function(){
			
			$('.overlay').show();
			$('.sk-circle').show();
			
			$.post("./process.php",$('#formEbook').serialize()+"&option=deleteEbook",function(data){
				
				alertify.success(data);
				
				$('#listEbookManage').empty();

				listEbookData();
				
				$('#deletebutEbook').fadeOut('slow');
				
				$('.overlay').hide();
				$('.sk-circle').hide();
				
			});
			
		});
		
	});

	//--------END UPLOAD NEW EBOOK---------


	//----------------START UPCOMING BOOK PAGE-------

	//insert upcoming book list into db
	$(document).on('click', '#addUpcomingBkBut', function() {
			

			var addTitleVal = $('#upbtitle').val();
			
			if(addTitleVal != "")
			{
				alertify.confirm("<i class='fa fa-fw fa-warning'></i> Insert upcoming book?",function(){

					$('#listUpcomingBk').empty();

					$('.overlay').show();
					$('.sk-circle').show();

					$.post("./process.php", "option=addupcomingbk&"+$('#insertUpcomingBkForm').serialize(), function(data){
					
						$('.overlay').hide();
						$('.sk-circle').hide();

						alertify.success(data);
						
						listUpcomingBkData();

						$('#insertUpcomingBkForm')[0].reset();
					});
				});
			}
			else
			{
				alertify.alert("Please enter book title before submit!");
			}
			
	});	

	//list upcoming book data
	$(function(){
			if($('#UpcomingBookPage').length > 0){
				$('.overlay').show();
				$('.sk-circle').show();
				$('#listUpcomingBk').empty();
				
				listUpcomingBkData();
			}	
	});	

	function listUpcomingBkData()
	{
		$.post("./process.php", "option=listupcoming", function(data){
					
			$('.overlay').hide();
			$('.sk-circle').hide();
			
			$('#listUpcomingBk').append(data).hide().fadeIn('slow');
			alertify.success("All data loaded");
		});
	}

	//show delete button when checkbox is checked
	$(document).on("click","#deleteitem",function(){
		
		var anycheckbox = false;
		$('#formDisp input[type="checkbox"]').each(function(){
			if($(this).is(":checked")) {
				anycheckbox = true;
			}
		});
		
		if(anycheckbox == true){
			$('#deletebut').fadeIn('slow');
		}
		else
		{
			$('#deletebut').fadeOut('slow');
		}
		
	});

	//delete multiple items
	$(document).on("click",'#deletebut',function(){
		
		alertify.confirm("Are sure sure?",function(){
			
			$('.overlay').show();
			$('.sk-circle').show();
			
			$.post("./process.php",$('#formDisp').serialize()+"&option=deleteUpcomingBook",function(data){
				
				alertify.success(data);
				
				$('#listUpcomingBk').empty();

				listUpcomingBkData();
				
				$('#deletebut').fadeOut('slow');
				
				$('.overlay').hide();
				$('.sk-circle').hide();
				
			});
			
		});
		
	});
	//-----------------END UPCOMING BOOK PAGE--------------


	//-----------------START LIST ALL BOOK MANAGE-----------

	//append homepage
	$(function(){
		if($('#manageBook').length > 0) {
			$('.overlay').show();
			$('.sk-circle').show();
			var numpage = $('#curpage').val();
			
			listall(numpage);
			
			$('.overlay').hide();
			$('.sk-circle').hide();
			
		}
	});
	
	//function list all
	function listall(numpage)
	{
		$.post("./process.php","option=listall&pagenum="+numpage,function(data){
			
				$('#listAllBook').append(data).hide().fadeIn('slow');
			
		});
	}

	//change page jQuery
	$(document).on('click', '#changepage', function() {
		
		var numpage = $(this).val();
		
		$('#listAllBook').empty();
		
		listall(numpage);
		
	});

	//show delete button when checkbox is checked
	$(document).on("click","#deleteitemBook",function(){
		var anycheckbox = false;
		$('#formDispBook input[type="checkbox"]').each(function(){
			if($(this).is(":checked")) {
				anycheckbox = true;
			}
		});
		
		if(anycheckbox == true){
			$('#deletebutManageBook').fadeIn('slow');
		}
		else
		{
			$('#deletebutManageBook').fadeOut('slow');
		}
		
	});
	
	//delete multiple items
	$(document).on("click",'#deletebutManageBook',function(){
		
		alertify.confirm("Are sure sure?",function(){
			
			$('.overlay').show();
			$('.sk-circle').show();
			var numpage = $('#curpage').val();
			
			$.post("./process.php",$('#formDispBook').serialize()+"&option=deleteBookManage",function(data){
				
				alertify.success(data);
				
				//get data from db
				$('#listAllBook').empty();
				
				listall(numpage);
				
				$('#deletebutManageBook').fadeOut('slow');
				
				$('.overlay').hide();
				$('.sk-circle').hide();
				
			});
			
		});
		
	});

	//show input box update items
	$(document).on("click",'#updItem',function(){
		
		event.preventDefault();
		var id = $(this).val();
		
		$.post("./process.php","id="+id+"&option=showUpdateForm",function(data){
			
			$('#dispUpdateDataModal').empty().append(data).hide().fadeIn('slow');
			
		});
		
	});

	//update data modal
	$(document).on("click","#updatedat",function(){
		
		$('.overlay').show();
		$('.sk-circle').show();
		$('#resultadd').empty();
		$('#listAllBook').empty();
		$('.close').click();
		
		var numpage = $('#curpage').val();
		
		var formData = new FormData($('#formUpdate')[0]);
		$.ajax({
			
			url: "./process.php",
			type: "POST",
			data: formData,
			async: false,
			success: function(data){
				$('#resultadd').append(data);
				$('#formUpdate')[0].reset();
			},
			contentType: false,
			cache: false,
			processData: false,
				
		});
		
		event.preventDefault();
		
		//get data from db
		listall(numpage);
			
		$('.overlay').hide();
		$('.sk-circle').hide();
		
	});



	//-----------------END LIST ALL BOOK MANAGE---------------


	//-------------------------------Manage Membership-----------------------------------
	//search member
	$(function(){
		if($('#membershipadminpage').length > 0){
			$.post('./process.php','option=searchMember',function(data){
				$('#searchMemberSelect').append(data);
				$('.selectpicker').selectpicker('refresh');
				
			});
		}
	});
	
	
	//append member box to update
	$('#showBox').click(function(){
		event.preventDefault();
		var ics = $('#searchMemberSelect').val();
		$("#dis").empty();
		if(ics == '')
		{
			alertify.alert("Please choose member's name before search.");
		}
		else
		{
			$.post('./process.php','option=updateMember&ic='+ics,function(data){
				$("#dis").append(data).hide().fadeIn('slow');
				alertify.success("Data loaded.");
			});
		}
		
	});

	//update membership
	$(document).on("click","#upmember",function(){
		event.preventDefault();

		alertify.confirm("Update data?",function(){
			var ics = $('#ic').val();
			$.post('./process.php',$('#memberUpdate').serialize()+'&option=updateMember2',function(data){
				alertify.success(data);
				
				$("#dis").empty();
				$.post('./process.php','option=updateMember&ic='+ics,function(data){
					$("#dis").append(data).hide().fadeIn('slow');
					alertify.success("Data loaded.");
				});
				
			});
		});
		
	});
	
	
	//---------START STATISTICS----------------
	
	$(function(){
		if($('#statistics').length > 0) {
			
			//bar chart for total stock
			$.post("./process.php", "option=statistics", function(data){
					var dataChart = data.split(',');

					//pie chart books genre
					$('#disptotalBooks').append("<h4>Total Books in Database: <b>"+dataChart[0]+"</b></h4>");
					var pieBooksGenre = $("#pieBooksGenre");
					var myPieChart = new Chart(pieBooksGenre,{
						type: 'pie',
						data: {
							labels: [
								"History",
								"Sci-Fi & Fantasy",
								"Mystery & Suspense",
								"Romance"
							],
							datasets: [
								{
									data: [dataChart[1],dataChart[2],dataChart[3],dataChart[4]],
									backgroundColor: [
										"#ff9933",
										"#36A2EB",
										"#EF1665",
										"#CB59EE"
									],
									hoverBackgroundColor: [
										"#ff9933",
										"#36A2EB",
										"#EF1665",
										"#CB59EE"
									]
								}]
						}
					});

					
					//bar chart
					$('#disptotalRatings').append("<h4>Total Ratings in Database: <b>"+dataChart[5]+"</b></h4>");
					var ctx = $("#barChart");
					var myChart = new Chart(ctx, {
						type: 'bar',
						data: {
						labels: ["1 Stars","2 Stars","3 Stars","4 Stars","5 Stars"],
						datasets: [
							{
								label: "Number of Ratings",
								backgroundColor: "rgb(27,168,171)",
								borderColor: "rgb(73,146,171)",
								borderWidth: 1,
								hoverBackgroundColor: "rgb(102, 255, 102)",
								hoverBorderColor: "rgb(51, 204, 51)",
								data: [dataChart[6], dataChart[7], dataChart[8], dataChart[9], dataChart[10]],
							}
						]
					},
						options: {
							scales: {
								xAxes: [{
									categorySpacing: 0
								}],
								yAxes: [{
									ticks: {
										beginAtZero:true
									}
								}]
							}
						}
					});
					
				});
				
			}
		});
		
	
	//--------END STATISTICS--------------------
	
	
	
	
	
	//logout
	$('#logoutBut').click(function(){
		alertify.confirm("<i class='fa fa-fw fa-warning'></i> Logout of Administrator Page?",function(){
			window.location.href = "./logout.php";
		});
	});
	
	//-----------------------------END ADMIN PROCESSES-------------------------------------------------------------------------------
	
	
});
