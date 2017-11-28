<?php 
	$titlepage = "Membership";
	include "./template/header.php";
?>

<div class="container">
	<div class="panel panel-success">
		<div class="panel-body">
				<div class="page-header">
		 		 	<h1>Membership</h1>
				</div>

				<p>
					Become a member now to enjoy all the benefits!  
				</p>

				<p>
					As a library member, you can access all the books, photos, artworks, documents, maps, manuscripts and more when you visit library. Members also have the privileged to borrow the items from the library using the membership card.
				</p>

				<p>
					Furthermore, members can also extend their borrow duration through the membership online portal in the website.
				</p>

				<p>
					Join a vibrant and engaged community of active library users. You can enjoy a range of member-only benefits, programs and services by signing up now. 
				</p><br>

				<center>
				<div class="table-responsive">
				<div class="boxForm">
					<span style="font-size:30px"><b>Membership Registration Form</b></span><hr>
	                <!-- form start -->
	                <form role="form" class="form-horizontal" id="registerMemberForm">
	                    <div class="form-group" id="nameIn">
	                      <label class="col-sm-2 control-label">Full Name</label>
	                      <div class="col-sm-10">
	                     	 <input type="text" class="form-control" id="membershipFName" name="name" placeholder="Enter your name">
	                      </div>
	                      <div class="errorForm"></div>
	                    </div>
	                    <div class="form-group" id="dobIn">
	                      <label class="col-sm-2 control-label">Date Of Birth</label>
	                      <div class="col-sm-10">
	                     	 <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter your date of birth">
	                      </div>
	                      <div class="errorForm"></div>
	                    </div>
	                    <div class="form-group" id="icIn">
	                      <label class="col-sm-2 control-label">Identification Card</label>
	                      <div class="col-sm-10">
	                     	 <input type="text" class="form-control" id="ic" name="ic" placeholder="Enter your IC (XXXXXX-XX-XXXX)">
	                      </div>
	                      <div class="errorForm"></div>
	                    </div>
	                    <div class="form-group" id="emailIn">
	                      <label class="col-sm-2 control-label">Email Address</label>
	                      <div class="col-sm-10">
	                     	 <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
	                      </div>
	                      <div class="errorForm"></div>
	                    </div>
	                    <div class="form-group" id="phoneIn">
	                      <label class="col-sm-2 control-label">Phone Number</label>
	                      <div class="col-sm-10">
	                      	<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
	                      </div>
	                      <div class="errorForm"></div>
	                    </div>
						<input type="text" name="option" value="register" style="display:none;">
	                    <button id="registerMember" class="btn btn-primary pull-right">Submit</button>
	                </form>  
	            </div></div></center>
			<br><br><br>
		</div>	
	</div>
	<br><br><br>
</div>

<?php include "./template/footer.php"; ?>