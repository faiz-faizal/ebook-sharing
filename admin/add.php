<?php include './template/header.php'; ?>

<div id="addBookPage"></div>

<div class="box box-success">

	<div class="box-header with-border">
		<h3 class="box-title">Add New Book</h3>
	</div>
	
	<div class="box-body">
	
        <form method="post" id="addForm" enctype="multipart/form-data" name="addForm" class="form-horizontal" action="upload_file.php">
			
					
					
                     <div class="form-group">
                      <label class="col-sm-3 control-label">ISBN/ID: </label>
						<div class="col-sm-8">
							<input type="text" id="bid" name="bid" class="form-control" placeholder="Enter the Book's ISBN/ID:" required="required">
							<div id="err"></div>
						</div>
					</div>
            
					<div class="form-group">
                      <label class="col-sm-3 control-label">Title:</label>
						<div class="col-sm-8">
							<input type="text" id="btitle" name="btitle" class="form-control" placeholder="Enter the Book's Title" required="required">
							<div id="err1"></div>
						</div>
					</div>

					<div class="form-group">
                      <label class="col-sm-3 control-label">Author:</label>
						<div class="col-sm-8">
							<input type="text" id="bauthor" name="bauthor" class="form-control" placeholder="Enter the Author's Name" required="required">
							<div id="err2"></div>
						</div>
					</div>
					
					<div class="form-group">
                      <label class="col-sm-3 control-label">Genre:</label>
						<div class="col-sm-8">
							<select name='bgenre' id='bgenre' class="form-control" required="required">
							</select>
							<div id="err3"></div>
						</div>
					</div>
					
					<div class="form-group">
                      <label class="col-sm-3 control-label">Series:</label>
						<div class="col-sm-8">
							<input type="text" id="bseries" name="bseries" class="form-control" placeholder="Enter the Book's Series (Optional)">
						</div>
					</div>

					<div class="form-group">
                      <label class="col-sm-3 control-label">Publisher:</label>
						<div class="col-sm-8">
							<input type="text" id="bpublish" name="bpublish" class="form-control" placeholder="Enter the Publisher's details" required="required">
							<div id="err4"></div>
						</div>
					</div>

					<div class="form-group">
                      <label class="col-sm-3 control-label">Language:</label>
						<div class="col-sm-8">
							<select name='blang' id='blang' class="form-control" required="required">
							</select>
							<div id="err5"></div>
						</div>
					</div>

					<div class="form-group">
                      <label class="col-sm-3 control-label">Number of Pages:</label>
						<div class="col-sm-2">
							<input type="number" id="bpages" name="bpages" class="form-control" placeholder="Enter no of pages" required="required">
							<div id="err6"></div>
						</div>
					</div>

					<div class="form-group">
                      <label class="col-sm-3 control-label">Book Description/Synopsis:</label>
						<div class="col-sm-8">
							<textarea name="bsyn" rows="5" cols="60" id="bsyn" class="form-control" placeholder="Enter the description or synopsis of the book" required="required"></textarea>
							<div id="charNum">1200 characters left</div>
							<div id="err7"></div>
						</div>
					</div>
				    
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Upload E-book (.pdf):</label>
						<div class="col-sm-8">
							<input type="file" name="bookUpload" id="bookUpload" class="form-control">
							<p>Note: Maximum size is <b>8MB</b></p>
							<div id="err8"></div>
						</div>
					</div>
                    
            
					<div class="form-group">
                      <label class="col-sm-3 control-label">Choose book's cover photo to upload:</label>
						<div class="col-sm-8">
							<input type="file" name="coverUpload" id="coverUpload" class="form-control">
							<p>Note: only <b>.jpg</b> photo are allowed.</p>
							<br><label>Preview : </label>
							<br>
							<img id="image_upload_preview" src="../images/bookscover/book_temp.png" alt="your image" height="200px"/>
						</div>
					</div>	
					
							<input type="text" name="option" value="add" style="display:none;">
							<br>
							<br>
		</form>
					<div class="box-footer">
						<button id="addBut" class="btn btn-success pull-right">Add Book</button>
					</div>
					
			</div>
		
</div>

<div id="resultadd"></div>

<?php include './template/footer.php'; ?>