<?php 
	$titlepage = "Contact Us";
	include "./template/header.php";
?>

<div class="container">
	<div class="panel panel-success">
		<div class="panel-body">
				<div class="page-header">
		 		 	<h1>Contact Us</h1>
				</div>

				<p>Have any any suggestions, complaints, or feedbacks? Do not hesitate to contact us!. You can also rate this website and our services. We welcome our visitors to personally contact and rate us so that we can improve our services in the future.</p>
				<p>You can contact us by sending us a message using the form below, or you can also reach us through our Facebook and Twitter page.</p>
				 <div class="socials-link-contact">
				 	
					  <a href="http://www.facebook.com/afzafri" title="Find us on Facebook" target="_blank" class="socials-link-fb-contact">Facebook <i class="fa fa-facebook-square" alt="Find us on Facebook"></i><span class="sr-only">Facebook&gt;/span&gt;</span></a> 
					  &nbsp;&nbsp;
				      <a href="https://twitter.com/afzafri" title="Follow us on Twitter" target="_blank" class="socials-link-twitter-contact">Twitter <i class="fa fa-twitter-square" alt="Follow us on Twitter"></i><span class="sr-only">Twitter</span></a>
			      </div>
				<br><br>
				<center>
				<div class="table-responsive">
				<div class="boxForm">
					<span style="font-size:30px"><b>Message Form</b></span><hr>
	                <!-- form start -->
	                <form role="form" class="form-horizontal" id="contactUsForm" action="./contact.php" method="post">
	                    <div class="form-group" id="nameIn">
	                      <label class="col-sm-2 control-label">Full Name</label>
	                      <div class="col-sm-10">
	                     	 <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required="required">
	                      </div>
	                    </div>
	                    <div class="form-group" id="emailIn">
	                      <label class="col-sm-2 control-label">Email Address</label>
	                      <div class="col-sm-10">
	                     	 <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required="required">
	                      </div>
	                    </div>
	                    <div class="form-group" id="typeMessageIn">
	                      <label class="col-sm-2 control-label">Message Type</label>
	                      <div class="col-sm-10">
	                     	 Suggestion: <input type="radio" id="typeMessage" name="typeMessage" value="Suggestion" checked> &nbsp;
	                     	 Complaint: <input type="radio" id="typeMessage" name="typeMessage" value="Complaint"> &nbsp;
	                     	 Feedback: <input type="radio" id="typeMessage" name="typeMessage" value="Feedback"> &nbsp;
	                      </div>
	                    </div>

	                    <div class="form-group" id="typeMessageIn">
	                      <label class="col-sm-2 control-label">Rate</label>
	                      	<div class="stars">
		                    	<input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
							    <label class="star star-5" for="star-5"></label>
							    <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
							    <label class="star star-4" for="star-4"></label>
							    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
							    <label class="star star-3" for="star-3"></label>
							    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
							    <label class="star star-2" for="star-2"></label>
							    <input class="star star-1" id="star-1" type="radio" name="star" value="1"/ checked>
							    <label class="star star-1" for="star-1"></label>
							</div>	
	                    </div>

	                    <div class="form-group" id="messageIn">
	                      <label class="col-sm-2 control-label">Message</label>
	                      <div class="col-sm-10">
	                      	<textarea class="form-control" id="message" name="message" rows="8" cols="20" placeholder="Enter your message" required="required"></textarea>
	                      </div>
	                    </div>
	                    <input type="text" name="option" value="contactus" style="display:none;">
	                    <button id="contactUsSubmit" class="btn btn-success pull-right" name="contactMsg" value="1">Send</button>
	                </form>  
	            </div></div>
	            </center>
			<br><br><br>
				
			<br><br><br>
		</div>	
	</div>
	<br><br><br>
</div>

<?php include "./template/footer.php"; ?>