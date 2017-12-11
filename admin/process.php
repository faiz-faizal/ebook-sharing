<?php 

include '../config.php';

//pdo 
try
{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Connection Error : " . $e->getMessage();
}



//-----------------------------ADMIN PROCESSES-------------------------------------------------------------------------------


//add new book
if( $_POST['option'] == "add" )
{
	try
	{
        $bkid = $_POST['bid'];
		$btitle = $_POST['btitle'];
		$bauthor = $_POST['bauthor'];
		$bgenre = $_POST['bgenre'];
		$bseries = $_POST['bseries'];
		$bpublish = $_POST['bpublish'];
		$blang = $_POST['blang'];
		$bpages = $_POST['bpages'];
		$bsyn = $_POST['bsyn'];
		$bsyn = str_replace("'","''",$bsyn);
        $bext = pathinfo("../ebooks/" . basename($_FILES["bookUpload"]["name"]),PATHINFO_EXTENSION);

		
		$stmt = $conn->prepare("INSERT INTO BOOKS (BK_ID,BK_TITLE,BK_AUTHOR,BK_GENRE,BK_SERIES,BK_PUBLISH,BK_LANG,BK_PAGES,BK_SYN,BK_EXT) VALUES(?,?,?,?,?,?,?,?,?,?) ");
		$stmt->execute(array($bkid,$btitle,$bauthor,$bgenre,$bseries,$bpublish,$blang,$bpages,$bsyn,$bext));
		//$bkid = $conn->lastInsertId();

        //upload FILE
		$target_dir = "../ebooks/";
		$target_file = $target_dir . basename($_FILES["bookUpload"]["name"]);
        $target_loc = $_FILES["bookUpload"]["name"];

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		$imgstat = 0;
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "<script>alertify.error('PDF not uploaded.')</script>";
		// if everything is ok, try to upload file4rG
		} 
        else {
			if (move_uploaded_file($_FILES["bookUpload"]["tmp_name"], $target_dir . $bkid .".".$imageFileType)) {
				echo "<script>alertify.success('The PDF has been uploaded.')</script>";
				$imgstat = 1;
			} 
            else {
				echo "<script>alertify.error('Sorry, there was an error uploading your file.')</script>";
			}
		}  //UPLOAD FILE
        
        
        //upload COVER
		$target_dir = "../images/bookscover/"; //tempat target letakkan img
		$target_file = $target_dir . basename($_FILES["coverUpload"]["name"]); // = 

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		
			$check = getimagesize($_FILES["coverUpload"]["tmp_name"]);
			if($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				//echo "File is not an image.";
				$uploadOk = 0;
			}

		// Check file size
		if ($_FILES["coverUpload"]["size"] > 100000000) {
			//echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg") {
			//echo "Sorry, only JPG file are allowed.";
			$uploadOk = 0;
		}
		
		$imgstat = 0;
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "<script>alertify.error('Photo not uploaded.')</script>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["coverUpload"]["tmp_name"], $target_dir . $bkid . "." . $imageFileType)) {
				echo "<script>alertify.success('The image has been uploaded.')</script>";
				$imgstat = 1;
			} else {
				echo "<script>alertify.error('Sorry, there was an error uploading your file.')</script>";
			}
		}
	}
    
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}


//populate select box Add Form
if( $_POST['option'] == "selectbox" )
{
	try
	{
		//book genres
		if($_POST['type'] == "bgenres")
		{
			$stmt = $conn->prepare("SELECT * FROM GENRES");
			$stmt->execute();
			
			echo "<option value=''>-Choose Book's Genre-</option>";
			
			while($result = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$genid = $result['GEN_ID'];
				$genname = $result['GEN_NAME'];
				
				echo "<option value='$genid'>$genname</option>";
			}
		}
		
		//book language
		if($_POST['type'] == "blang")
		{
			$stmt = $conn->prepare("SELECT * FROM LANGUAGES");
			$stmt->execute();
			
			echo "<option value=''>-Choose Book's Language-</option>";
			
			while($result = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$langid = $result['LANG_ID'];
				$langname = $result['LANG_NAME'];
				
				echo "<option value='$langid'>$langname</option>";
			}
		}
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}

}

//add upcoming book list
if( $_POST['option'] == "addupcomingbk" )
{
	try
	{
		$upbtitle = $_POST['upbtitle'];
		
		$stmt = $conn->prepare("INSERT INTO UPCOMINGS (UPC_TITLE) VALUES(?) ");
		$stmt->execute(array($upbtitle));

		echo "Add success.";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}

//list all upcoming book list
if( $_POST['option'] == "listupcoming" )
{
	try
	{

		echo "<div class='box box-info'>
						<div class='box-header with-border'>
						  <h3 class='box-title'>Manage Upcoming Books List</h3>
						</div><!-- /.box-header -->
						<div class='box-body table-responsive'>
						<form id='formDisp' name='formDisp' method='post'>
						  <table class='table table-bordered table-hover'>
							<tbody>
							<tr>
								<th style='width: 10px'>ID</th>
								<th>TITLE</th>
								<th style='width: 30px'>DELETE</th>
							</tr>
					";

		$stmt = $conn->prepare("SELECT * FROM UPCOMINGS ORDER BY UPC_ID DESC");
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$upbkid = $res['UPC_ID'];
			$upbktitle = $res['UPC_TITLE'];

			echo "
				<tr id='row$upbkid'>
				<td>$upbkid</td>
				<td>$upbktitle</td>
				<td><input type='checkbox' name='deleteitem[]' value='$upbkid' id='deleteitem' data-balloon='Mark to delete' data-balloon-pos='up'></td>
				</tr>
				";
		}

		echo "</tbody>
			  </table></form>
			  </ul></div>
			  </div><!-- /.box-body -->
		
	 		 </div>
			  ";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}


//delete multiple items
if($_POST['option'] == "deleteUpcomingBook")
{
	$ids = $_POST['deleteitem'];
	
	try
	{
		for($i=0;$i<count($ids);$i++)
		{
			$stmt = $conn->prepare("DELETE FROM UPCOMINGS WHERE UPC_ID = ?");
			$stmt->execute(array($ids[$i]));
		}

		echo "Items deleted";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
	
}

//list all ebook list
if( $_POST['option'] == "listebookmanage" )
{
	try
	{

		echo "<div class='box box-info'>
						<div class='box-header with-border'>
						  <h3 class='box-title'>Manage E-Books List</h3>
						</div><!-- /.box-header -->
						<div class='box-body table-responsive'>
						<form id='formEbook' name='formEbook' method='post'>
						  <table class='table table-bordered table-hover'>
							<tbody>
							<tr>
								<th style='width: 10px'>ID</th>
								<th>TITLE</th>
								<th style='width: 30px'>DELETE</th>
							</tr>
					";

		$stmt = $conn->prepare("SELECT * FROM EBOOKS");
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ebk_id = $res['EBK_ID'];
			$ebk_title = $res['EBK_TITLE'];

			echo "
				<tr id='row$ebk_id'>
				<td>$ebk_id</td>
				<td>$ebk_title</td>
				<td><input type='checkbox' name='deleteitemEbook[]' value='$ebk_id' id='deleteitemEbook' data-balloon='Mark to delete' data-balloon-pos='up'></td>
				</tr>
				";
		}

		echo "</tbody>
			  </table></form>
			  </ul></div>
			  </div><!-- /.box-body -->
		
	 		 </div>
			  ";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}

//delete multiple ebooks items
if($_POST['option'] == "deleteEbook")
{
	$ids = $_POST['deleteitemEbook'];
	
	try
	{
		for($i=0;$i<count($ids);$i++)
		{
			$stmt = $conn->prepare("DELETE FROM EBOOKS WHERE EBK_ID = ?");
			$stmt->execute(array($ids[$i]));

			unlink("../ebooks/$ids[$i].pdf");
		}

		echo "Ebooks deleted";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
	
}


//list all Book from database
if($_POST['option'] == "listall")
{
	
	try
	{
		//<----start code php pagination--->
		
		//check if pagenum is set, if not, set to 1
		$pagenum = isset($_POST['pagenum']) ? $_POST['pagenum'] : 0; 
		
		if ($pagenum == 0) 
		 { 
			$pagenum = 1; 
		 }
		 
		$stmtCount = $conn->prepare("SELECT COUNT(*) AS COUNT FROM BOOKS");
		$stmtCount->execute();
		$countRow = $stmtCount->fetch(PDO::FETCH_ASSOC);
		$numrows = $countRow['COUNT']; 
		
		//num of results displayed per page
		$page_rows =  6;
		
		//get number of last page
		$last = ceil($numrows/$page_rows);
		
		//make sure page number not below 1, or exceed max page
		if($pagenum < 1) {$pagenum = 1;}
		else if($pagenum > $last) {$pagenum = $last;}
		
		$calc = ($pagenum - 1) * $page_rows;
		if($calc < 0) {$calc = 0;} //avoid negative error
		
		//set range to display query
		$max = 'limit ' . $calc . ',' . $page_rows;
		 
		$stmt = $conn->prepare("SELECT 
								B.BK_ID, B.BK_TITLE, B.BK_AUTHOR, B.BK_GENRE, B.BK_LANG,
								L.LANG_ID, L.LANG_NAME, 
								G.GEN_ID, G.GEN_NAME

								FROM BOOKS B, GENRES G, LANGUAGES L

								WHERE B.BK_GENRE = G.GEN_ID
								AND B.BK_LANG = L.LANG_ID
								ORDER BY BK_ID DESC $max");
		$stmt->execute();
		
	
		echo "<div class='box box-success' >
					<div class='box-header with-border'>
					  <h3 class='box-title'>Manage Books List - $numrows total data</h3>
					</div><!-- /.box-header -->
					<div class='box-body table-responsive'>
					<form id='formDispBook' name='formDispBook' method='post'>
					  <table class='table table-bordered table-hover'>
						<tbody>
						<tr>
							<th style='width: 10px'>ID</th>
							<th>Title</th>
							<th>Author</th>
							<th>Genre</th>
							<th>Language</th>
							<th style='width: 30px'>UPDATE</th>
							<th style='width: 30px'>DELETE</th>
						</tr>
				";
		
		
		
		while($results = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$bk_id = $results['BK_ID'];
			$bk_title = $results['BK_TITLE'];
			$bk_author = $results['BK_AUTHOR'];
			$bk_genre = $results['GEN_NAME'];
			$bk_lang = $results['LANG_NAME'];
			
			
			echo "
			<tr>
			<td>$bk_id</td>
			<td>$bk_title</td>
			<td>$bk_author</td>
			<td>$bk_genre</td>
			<td>$bk_lang</td>
			<td><button name='updItem' value='$bk_id' id='updItem' class='btn btn-success' data-target='#upDataModal' data-toggle='modal' data-balloon='Update data' data-balloon-pos='up'><i class='fa fa-fw fa-gears'></i></button></td>
			<td><i class='fa fa-fw fa-trash'></i><input type='checkbox' name='deleteitemBook[]' value='$bk_id' id='deleteitemBook' data-balloon='Mark to delete' data-balloon-pos='up'></td>
			</tr>
			";
			
			
		}
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
	
	
	echo "</tbody>
		  </table></form>";
	
		  
	echo "<br><div id='center'><ul class='paginations'>";
	
	if($pagenum == 1 || $pagenum == 0) {}
	else 
	{
		echo "<li><button name='changepage' id='changepage' value='1'><i class='fa fa-angle-double-left' ></i> First</button></li>";
		echo " ";
		$previous = $pagenum-1;
		echo "<li><button name='changepage' id='changepage' value='$previous'><i class='fa fa-angle-left' ></i> Previous</button></li>";
	}
	
	//show current page and total num of page
	echo "<li> <showpage> --Page $pagenum of $last-- </showpage></li>";
	
	
	if($pagenum == $last) {}
	else 
	{
		$next = $pagenum + 1;
		echo "<li><button name='changepage' id='changepage' value='$next'>Next <i class='fa fa-angle-right' ></i></button></li>";
		echo " ";
		echo "<li><button name='changepage' id='changepage' value='$last'>Last <i class='fa fa-angle-double-right' ></i></button></li>";
	}
	
	echo "</ul></div>";
		  
		  echo"
		</div><!-- /.box-body -->
		
	  </div>";
	  
	  echo "<input type='text' id='curpage' value='$pagenum' style='display:none;'>";
}

//delete multiple items Book Manage
if($_POST['option'] == "deleteBookManage")
{
	$bk_ids = $_POST['deleteitemBook'];
	
	try
	{
		for($i=0;$i<count($bk_ids);$i++)
		{
			$stmt = $conn->prepare("DELETE FROM BOOKS WHERE BK_ID = ?");
			$stmt->execute(array($bk_ids[$i]));
		}

		echo "Items deleted";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
	
	unlink("./images/bookscover/$ids.jpg");
}

//show update data modal form
if($_POST['option'] == "showUpdateForm")
{
	$id = $_POST['id'];
	
	try
	{
		$stmt = $conn->prepare("SELECT 
								B.BK_ID, B.BK_TITLE, B.BK_AUTHOR, B.BK_GENRE, B.BK_LANG,
								B.BK_SERIES, B.BK_PUBLISH, B.BK_PAGES, B.BK_SYN,
								L.LANG_ID, L.LANG_NAME, 
								G.GEN_ID, G.GEN_NAME

								FROM BOOKS B, GENRES G, LANGUAGES L

								WHERE B.BK_GENRE = G.GEN_ID
								AND B.BK_LANG = L.LANG_ID
								AND BK_ID = ?");

		$stmt->execute(array($id));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$bk_id = $results['BK_ID'];
		$bk_title = $results['BK_TITLE'];
		$bk_author = $results['BK_AUTHOR'];
		$bk_genre = $results['BK_GENRE'];
		$gen_name = $results['GEN_NAME'];
		$bk_lang = $results['BK_LANG'];
		$lang_name = $results['LANG_NAME'];
		$bk_series = $results['BK_SERIES'];
		$bk_publish = $results['BK_PUBLISH'];
		$bk_pages = $results['BK_PAGES'];
		$bk_syn = $results['BK_SYN'];
		
		echo "
		
		<form role='form' id='formUpdate' enctype='multipart/form-data' method='post' name='formUpdate' class='form-horizontal'>
	  <div class='box-body'>

		<div class='form-group'>
          <label class='col-sm-3 control-label'>ID:</label>
			<div class='col-sm-8'>
				<input type='text' class='form-control' name='bk_id' id='bk_id' placeholder='Book ID' value='{$bk_id}' disabled='disabled' readonly='readonly'>
			</div>
		</div>
	  
		<div class='form-group'>
          <label class='col-sm-3 control-label'>Title:</label>
			<div class='col-sm-8'>
				<input type='text' id='btitle' name='btitle' class='form-control' placeholder='Enter the Book's Title' required='required' value='$bk_title'>
			</div>
		</div>

		<div class='form-group'>
          <label class='col-sm-3 control-label'>Author:</label>
			<div class='col-sm-8'>
				<input type='text' id='bauthor' name='bauthor' class='form-control' placeholder='Enter the Author's Name' required='required' value='$bk_author'>
			</div>
		</div>
		
		<div class='form-group'>
          <label class='col-sm-3 control-label'>Genre:</label>
			<div class='col-sm-8'>
				<select name='bgenre' id='bgenre' class='form-control' required='required'>
					"; 

					$stmtgen = $conn->prepare("SELECT * FROM GENRES");
					$stmtgen->execute();
					
					echo "<option value=''>-Choose Book's Genre-</option>";
					
					while($resgen = $stmtgen->fetch(PDO::FETCH_ASSOC))
					{
						$genid = $resgen['GEN_ID'];
						$genname = $resgen['GEN_NAME'];

						if($bk_genre == $genid)
						{
							echo "<option value='$genid' selected>$genname</option>";
						}
						else
						{
							echo "<option value='$genid'>$genname</option>";
						}
					}

					echo"
				</select>
			</div>
		</div>
		
		<div class='form-group'>
          <label class='col-sm-3 control-label'>Series:</label>
			<div class='col-sm-8'>
				<input type='text' id='bseries' name='bseries' class='form-control' placeholder='Book's Series (Optional)' value='$bk_series'>
			</div>
		</div>

		<div class='form-group'>
          <label class='col-sm-3 control-label'>Publisher:</label>
			<div class='col-sm-8'>
				<input type='text' id='bpublish' name='bpublish' class='form-control' placeholder='Enter the Publisher's details' required='required' value='$bk_publish'>
			</div>
		</div>

		<div class='form-group'>
          <label class='col-sm-3 control-label'>Language:</label>
			<div class='col-sm-8'>
				<select name='blang' id='blang' class='form-control' required='required'>
				"; 

					$stmtlang = $conn->prepare("SELECT * FROM LANGUAGES");
					$stmtlang->execute();
					
					echo "<option value=''>-Choose Book's Language-</option>";
					
					while($reslang = $stmtlang->fetch(PDO::FETCH_ASSOC))
					{
						$langid = $reslang['LANG_ID'];
						$langname = $reslang['LANG_NAME'];

						if($bk_lang == $langid)
						{
							echo "<option value='$langid' selected>$langname</option>";
						}
						else
						{
							echo "<option value='$langid'>$langname</option>";
						}
					}

					echo"
				</select>
			</div>
		</div>

		<div class='form-group'>
          <label class='col-sm-3 control-label'>Number of Pages:</label>
			<div class='col-sm-2'>
				<input type='number' id='bpages' name='bpages' class='form-control' placeholder='Enter no of pages' required='required' value='$bk_pages'>
			</div>
		</div>

		<div class='form-group'>
          <label class='col-sm-3 control-label'>Book Description/Synopsis:</label>
			<div class='col-sm-8'>
				<textarea name='bsyn' rows='5' cols='60' id='bsyn' class='form-control' placeholder='Enter the description or synopsis of the book' required='required'>
				   $bk_syn
				</textarea>
			</div>
		</div>
		
		<div class='form-group'>
		  <label>Choose a photo to upload:</label>
				<input type='file' name='coverUpload' id='coverUpload' class='form-control'>
				"; 
				
				if(file_exists('../images/bookscover/'.$bk_id.'.jpg'))
				{
					echo "
					<br><label id='labelupp'>Current Image : </label><br>
					<img id='image_upload_preview_upd' class='userimg' src='../images/bookscover/{$bk_id}.jpg'  height='150px'/>";
				}
				else
				{
					echo "<br><label id='labelupp'>Preview : </label><br>
					<img id='image_upload_preview_upd' class='userimg' src='../images/bookscover/book_temp.png' alt='your image' height='150px'/>";
				}
				
				echo"
		</div>	
		
		<input type='text' name='option' value='updatedataModal' style='display:none;'>
		<input type='text' name='idbook' value='{$bk_id}' style='display:none;'>
		
	  </div><!-- /.box-body -->
	  </form>
		
		";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
	
}

//update data into db modal
if($_POST['option'] == "updatedataModal")
{
	$bk_id = $_POST['idbook'];
	$btitle = $_POST['btitle'];
	$bauthor = $_POST['bauthor'];
	$bgenre = $_POST['bgenre'];
	$bseries = $_POST['bseries'];
	$bpublish = $_POST['bpublish'];
	$blang = $_POST['blang'];
	$bpages = $_POST['bpages'];
	$bsyn = $_POST['bsyn'];
	
	try
	{
		$stmt = $conn->prepare("UPDATE BOOKS SET BK_TITLE = ?,BK_AUTHOR = ?,BK_GENRE = ?,BK_SERIES = ?,BK_PUBLISH = ?,BK_LANG = ?,BK_PAGES = ?,BK_SYN = ? WHERE BK_ID = ?");
		$stmt->execute(array($btitle,$bauthor,$bgenre,$bseries,$bpublish,$blang,$bpages,$bsyn,$bk_id));
		
		echo "<script>alertify.success('Data Updated')</script>";
		
		//upload image
		$target_dir = "../images/bookscover/";
		$target_file = $target_dir . basename($_FILES["coverUpload"]["name"]);

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image

		// Check file size
		if ($_FILES["coverUpload"]["size"] > 500000) {
			//echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg") {
			//echo "Sorry, only JPG file are allowed.";
			$uploadOk = 0;
		}
		
		$imgstat = 0;
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "<script>alertify.error('Photo not uploaded.')</script>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["coverUpload"]["tmp_name"], $target_dir . $bk_id . "." . $imageFileType)) {
				echo "<script>alertify.success('The image has been uploaded.')</script>";
				$imgstat = 1;
			} else {
				echo "<script>alertify.error('Sorry, there was an error uploading your file.')</script>";
			}
		}
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}

//----END MANAGE BOOK---


//---------MANAGE MEMBERSHIP-- HASSAN--------------
//search member
if($_POST['option'] == "searchMember")
{
	try
	{
		$stmt = $conn->prepare("SELECT * FROM MEMBERSHIP");
		$stmt->execute();
		
		echo "
		<option value =''>Choose Member</option>";

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			
			$MEMBER_NAME = $result["M_FNAME"];
			$MEMBER_IC = $result["M_IC"];
			
			echo "<option value='$MEMBER_IC'>$MEMBER_NAME</option>";
		}

	}catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}

//update member
if($_POST['option'] == "updateMember")
{
	$ic = $_POST["ic"];
	try
	{
		
		$stmt = $conn->prepare("SELECT * FROM membership WHERE M_IC = ?");
		$stmt->execute(array($ic));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$id = $result['M_ID'];
		$fname = $result['M_FNAME'];
		$dob = $result['M_DOB'];
		$icc = $result['M_IC'];
		$email = $result['M_EMAIL'];
		$phone = $result['M_PHONE'];
		
		
		echo "
			<div class='box box-success'>	
			<div class='box-header with-border'>
				<h3 class='box-title'>Update Membership</h3>
			</div>
			<div class='box-body'>
				<form method='post' id='memberUpdate' enctype='multipart/form-data' name='memberUpdate' class='form-horizontal'>
			
					
					
					<div class='form-group'>
                      <label class='col-sm-3 control-label'>Full Name:</label>
						<div class='col-sm-8'>
							<input type='text' id='name' value = '$fname' name='name' class='form-control' required='required'>
						</div>
					</div>

					<div class='form-group'>
                      <label class='col-sm-3 control-label'>Date Of Birth:</label>
						<div class='col-sm-8'>
							<input type='date' id='dob' value='$dob' name='dob' class='form-control' required='required'>
						</div>
					</div>
					
					<div class='form-group'>
                      <label class='col-sm-3 control-label'>Identification Card</label>
						<div class='col-sm-8'>
							<input name='ic' id='ic' value='$icc' class='form-control' required='required'>
							</select>
						</div>
					</div>
					
					<div class='form-group'>
                      <label class='col-sm-3 control-label'>Email Address:</label>
						<div class='col-sm-8'>
							<input type='text' id='email' value='$email' name='email' class='form-control')'>
						</div>
					</div>

					<div class='form-group'>
                      <label class='col-sm-3 control-label'>Phone Number:</label>
						<div class='col-sm-8'>
							<input type='text' id='phone' value='$phone' name='phone' class='form-control'required='required'>
						</div>
					</div>
							<input type='text' id='id' value='$id' name='id' style='display:none'>
					<div class='box-footer'>
						<button id='upmember' class='btn btn-success pull-right'>Update Membership</button>
					</div>
					
			</div>
		</form>
		</div>
	</div>";

	}catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}

if($_POST['option'] == "updateMember2")
{
		$id = $_POST['id'];
		$fname = $_POST['name'];
		$dob = $_POST['dob'];
		$ic = $_POST['ic'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		
	try
	{
		$stmt = $conn->prepare("UPDATE MEMBERSHIP SET M_FNAME = ?, M_DOB = ?, M_IC = ?, M_EMAIL = ?, M_PHONE = ? WHERE M_ID = ?");
		$stmt->execute(array($fname,$dob,$ic,$email,$phone,$id));
		
		echo "Data updated.";
		
	}catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}
//------END MANAGE MEMBERSHIP-----


//statistics
if( $_POST['option'] == "statistics" )
{
	try
	{
		
		//TOTAL STOCK IN DATABASE
		//---------------------------------------------------------
		
		//total books
		$total = $conn->prepare("SELECT COUNT(*) AS COUNT FROM BOOKS");
		$total->execute();
		
		$result = $total->fetch(PDO::FETCH_ASSOC);
		$totalitems = $result['COUNT'];
		
		//total each genre
		$totalH = $conn->prepare("SELECT 
									( SELECT COUNT(*)
									 FROM BOOKS 
									 WHERE BK_GENRE = '1' 
									) AS HISTORY, 
									( SELECT COUNT(*)
									 FROM BOOKS 
									 WHERE BK_GENRE = '2' 
									) AS SCIFI,
									( SELECT COUNT(*)
									 FROM BOOKS 
									 WHERE BK_GENRE = '3' 
									) AS MYSTERY,
									( SELECT COUNT(*)
									 FROM BOOKS 
									 WHERE BK_GENRE = '4' 
									) AS ROMANCE");
		$totalH->execute();
		
		$resultB = $totalH->fetch(PDO::FETCH_ASSOC);

		$totalHistory = $resultB['HISTORY'];
		$totalScifi = $resultB['SCIFI'];
		$totalMystery = $resultB['MYSTERY'];
		$totalRomance = $resultB['ROMANCE'];
		
		echo $totalitems.",".$totalHistory.",".$totalScifi.",".$totalMystery.",".$totalRomance.",";

		//total ratings
		$totalRat = $conn->prepare("SELECT COUNT(*) AS COUNTRAT FROM RATINGS");
		$totalRat->execute();
		
		$resultRat = $totalRat->fetch(PDO::FETCH_ASSOC);
		$totalratings = $resultRat['COUNTRAT'];

		//total ratings each
		$totalR = $conn->prepare("SELECT 
									( SELECT COUNT(*)
									 FROM RATINGS 
									 WHERE RAT_STARS = '1' 
									) AS STAR1,
									( SELECT COUNT(*)
									 FROM RATINGS 
									 WHERE RAT_STARS = '2' 
									) AS STAR2,
									( SELECT COUNT(*)
									 FROM RATINGS 
									 WHERE RAT_STARS = '3' 
									) AS STAR3,
									( SELECT COUNT(*)
									 FROM RATINGS 
									 WHERE RAT_STARS = '4' 
									) AS STAR4,
									( SELECT COUNT(*)
									 FROM RATINGS 
									 WHERE RAT_STARS = '5' 
									) AS STAR5
									");
		$totalR->execute();
		
		$resultR = $totalR->fetch(PDO::FETCH_ASSOC);

		$star1 = $resultR['STAR1'];
		$star2 = $resultR['STAR2'];
		$star3 = $resultR['STAR3'];
		$star4 = $resultR['STAR4'];
		$star5 = $resultR['STAR5'];

		echo $totalratings.",".$star1.",".$star2.",".$star3.",".$star4.",".$star5.",";

	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}
	
//-----------------------------END ADMIN PROCESSES-------------------------------------------------------------------------------

//close sql connection
$conn = null;

?>