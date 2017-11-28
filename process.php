<?php 

include './config.php';

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

//-----------------------------USER PROCESSES-------------------------------------------------------------------------------

//membership form - CODE HASSAN
if($_POST['option'] == "register")
{
	try
	{
		$fnamem = $_POST['name'];
		$dateBirth = $_POST["dob"];
		$ic = $_POST["ic"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		
		$stmt = $conn->prepare("INSERT INTO MEMBERSHIP (M_FNAME,M_DOB,M_IC,M_EMAIL,M_PHONE) VALUES(?,?,?,?,?)");
		$stmt->execute(array($fnamem,$dateBirth,$ic,$email,$phone));
		echo "Success! Thank You.";
		
	}catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}

//contact form
if($_POST['option'] == "contactus")
{
	try
	{
		$fname = $_POST['name'];
		$senderemail = $_POST['email'];
		$mtype = $_POST['typeMessage'];
		$message = $_POST['message'];
		$star = $_POST['star'];
		$starrate = ($_POST['star'] > 1) ? $_POST['star']." stars" : $_POST['star']." star";

		//INSERT DATA INTO DB
		$stmt = $conn->prepare("INSERT INTO RATINGS (RAT_STARS) VALUES(?)");
		$stmt->execute(array($star));

		//EMAIL FUNCTION
		require './template/plugins/phpmailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		$mail->isSMTP();                                      									 // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  												 // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               								 // Enable SMTP authentication
		$mail->Username = '';    															// SMTP username/GMAIL address
		$mail->Password = '';                             									// SMTP password/GMAIL password
		$mail->SMTPSecure = 'tls';                                                         // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                                                       // TCP port to connect to

		//$mail->SMTPDebug  = 2;

		$mail->setFrom('elibraryinfo@gmail.com', 'E-Library Info Contact Form');

		$stmt = $conn->prepare("SELECT USR_EMAIL FROM USERS");
		$stmt->execute();
		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$mail->addAddress($res['USR_EMAIL']);  //add recipient 
		}

		$mail->isHTML(true);                                                                 // Set email format to HTML

		date_default_timezone_set("Asia/Kuala_Lumpur"); 
		$timeNow = date("h:i:s a"); 
		$dateNow = date("d-m-Y"); 

		$emailData = "
			Visitor Name: $fname <br>
			Email Address: $senderemail <br>
			Message Type: $mtype <br>
			Rate: $starrate <br>
			Message : <br> $message <br>

		";

		$bodydata = $emailData . "<br><br> <i>Send on {$timeNow} {$dateNow}</i>";

		$mail->Subject = "Visitor $mtype For E-Library Info";
		$mail->Body    = $bodydata;

		if(!($mail->Send())) 
		{
			echo 'Email could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
			echo 'Email has been sent';
		}
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}
					

//list upcoming book homepage
if( $_POST['option'] == "listupcomingHomepage" )
{
	try
	{

		echo "<ul class='fa-ul'>";

		$stmt = $conn->prepare("SELECT * FROM UPCOMINGS ORDER BY UPC_ID DESC");
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$upbkid = $res['UPC_ID'];
			$upbktitle = $res['UPC_TITLE'];

			echo "
				<li><i class='fa-li fa fa-book'></i><a href='#'>$upbktitle</a></li><br>
				";
		}

		echo "</ul>";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}


//list all ebook homepage
if( $_POST['option'] == "listEbooksHomepage" )
{
	try
	{

		echo "<div class='table-responsive'>
			  <table class='table table-bordered table-hover'>
			    <thead>
			      <tr>
			        <th>#</th>
			        <th>Title</th>
			        <th>Author</th>
			        <th>Category</th>
			        <th>Synopsis</th>
			        <th>Actions</th>
			      </tr>
			    </thead>
			    <tbody>";
        
        //SQL Query
		$stmt = $conn->prepare("SELECT E.EBK_ID,E.EBK_TITLE,E.EBK_AUTHOR,E.EBK_GEN,E.EBK_SYN,G.GEN_ID,G.GEN_NAME
								FROM EBOOKS E, GENRES G
								WHERE E.EBK_GEN = G.GEN_ID");
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
            //PDO::FETCH_ASSOC is 
		{
			$ebk_id = $res['EBK_ID'];
			$ebk_title = $res['EBK_TITLE'];
			$ebk_author = $res['EBK_AUTHOR'];
			$ebk_genre = $res['GEN_NAME'];
			$ebk_syn = $res['EBK_SYN'];

			echo "
				<tr>
			        <td>$ebk_id</td>
			        <td>$ebk_title</td>
			        <td>$ebk_author</td>
			        <td>$ebk_genre</td>
			        <td>$ebk_syn</td>
			        <td>
			        	<div class='btn-group-vertical'>
			        		<a href='./ebooks/$ebk_id.pdf' class='btn btn-primary' target='_blank'>Read</a>
			        		<a href='./ebooks/$ebk_id.pdf' class='btn btn-success' download>Download</a>
						 </div>
			        </td>
			     </tr>
				";
		}

		echo "</tbody>
				  </table>
				</div>";
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}


//----------START SEARCH CODE, BY HUSSIN------------
	//Search books website - CODE HUSSIN
	if($_POST['option'] == 'search'){
			try{
				$search = $_POST['search'];
				$language = $_POST['filterLang'];
				$genre = $_POST['filterGen'];
				
				//num of rows
				$pagerows = 6;
				//check if pagenum is set, if not, set to 1
				$pagenum = isset($_POST['pagenum']) ? $_POST['pagenum'] : 0; 
				if ($pagenum == 0) { 
					$pagenum = 1; 
				}
				
				if($language != 0 && $genre != 0 && $search == ""){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_LANG = '$language' 
					AND BK_GENRE = '$genre'
					
					");
				}

				if($language == 0 && $genre != 0 && $search == ""){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_GENRE = '$genre'
					
					");
				}

				if($language != 0 && $genre == 0 && $search == ""){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_LANG = '$language' 
					
					");
				}

				if($search != "" && $language == 0 && $genre == 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_TITLE LIKE '%$search%' 
					OR 
					BK_AUTHOR LIKE '%$search%'
					AND BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					");
				}

				if($search != "" && $language != 0 && $genre == 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_TITLE LIKE '%$search%' 
					AND BK_LANG = '$language'
					OR 
					BK_AUTHOR LIKE '%$search%'
					AND BK_LANG = '$language'
					AND BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					
					");
				}

				if($search != "" && $language == 0 && $genre != 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_TITLE LIKE '%$search%' 
					AND BK_GENRE = '$genre'

					OR 
					BK_AUTHOR LIKE '%$search%'
					AND BK_GENRE = '$genre'
					AND BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					
					");
				}

				if($search != "" && $language != 0 && $genre != 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS
					WHERE BK_TITLE LIKE '%$search%' 
					AND BK_GENRE = '$genre'
					AND BK_LANG = '$language'

					OR BK_AUTHOR LIKE '%$search%'
					AND BK_GENRE = '$genre'
					AND BK_LANG = '$language'
					
					");
				}
				
				if($search == "" && $genre == 0 && $language == 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					");
				}

				$stmt->execute();
				$rowcount = $stmt->rowCount();
				//paging	
				$last = ceil($rowcount/$pagerows);
				
				if($pagenum < 1){$pagenum = 1;}
				else if($pagenum > $last){$pagenum = $last;}
				$calc = ($pagenum - 1) * $pagerows;
				
				if($calc < 0) {$calc = 0;} //avoid negative error
				
				//set range to display query
				$max = 'limit ' .$calc. ',' . $pagerows;
				
				// execute only 6 per page
				if($language != 0 && $genre != 0 && $search == ""){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_LANG = '$language' 
					AND BK_GENRE = '$genre'
					$max
					");
				}

				if($language == 0 && $genre != 0 && $search == ""){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_GENRE = '$genre'
					$max
					");
				}

				if($language != 0 && $genre == 0 && $search == ""){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_LANG = '$language' 
					$max
					");
				}

				if($search != "" && $language == 0 && $genre == 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_TITLE LIKE '%$search%' 
					OR 
					BK_AUTHOR LIKE '%$search%'
					AND BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					$max
					");
				}

				if($search != "" && $language != 0 && $genre == 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_TITLE LIKE '%$search%' 
					AND BK_LANG = '$language'
					OR 
					BK_AUTHOR LIKE '%$search%'
					AND BK_LANG = '$language'
					AND BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					$max
					");
				}

				if($search != "" && $language == 0 && $genre != 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					AND BK_TITLE LIKE '%$search%' 
					AND BK_GENRE = '$genre'

					OR 
					BK_AUTHOR LIKE '%$search%'
					AND BK_GENRE = '$genre'
					AND BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID
					$max
					
					");
				}

				if($search != "" && $language != 0 && $genre != 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS
					WHERE BK_TITLE LIKE '%$search%' 
					AND BK_GENRE = '$genre'
					AND BK_LANG = '$language'

					OR BK_AUTHOR LIKE '%$search%'
					AND BK_GENRE = '$genre'
					AND BK_LANG = '$language'
					$max
					
					");
				}
				
				if($search == "" && $genre == 0 && $language == 0){
					$stmt = $conn->prepare("
					SELECT * FROM BOOKS,LANGUAGES,GENRES
					WHERE BK_LANG = LANG_ID
					AND BK_GENRE = GEN_ID 
					$max
					");
				}

				$stmt->execute();
				
				echo "<div class='panel panel-default'>
							<div class='panel-heading'><center><h1>Books</h1></center></div>
								<div class='panel-body'>
								<div class='table-responsive'>
								  <table class='table table-striped table-responsive table-bordered'>
									<thead>
									  <tr>
										
										<th></th>
										<th align='center'>Name</th>
										<th align='center'>Author</th>
										<th align='center'>Genre</th>
										<th align='center'>Language</th>
										<th algin='center'>Actions</th>
									  </tr>
									</thead>
									<tbody>";
				while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					$BK_ID = $result['BK_ID'];
					$BK_TITLE = $result['BK_TITLE'];
					$BK_AUTHOR = $result['BK_AUTHOR'];
					$BK_GENRE= $result['GEN_NAME'];
					$BK_LANGUAGE = $result['LANG_NAME'];

					echo "
									  <tr>
									  ";
									  if(file_exists('./images/bookscover/'.$BK_ID.'.jpg'))
									  {
										echo "<td align='center'><img src=./images/bookscover/$BK_ID.jpg class='img-thumbnail img-responsive' alt='Cinque Terre' width='100' height='40' ></td>";
									  }
									  else
									  {
										echo "<td align='center'><img src='./images/bookscover/book_temp.png' class='img-thumbnail img-responsive' alt='Cinque Terre' width='100' height='40'></td>";
									  } 
											
									echo "
										<td>$BK_TITLE</td>
										<td>$BK_AUTHOR</td>
										<td>$BK_GENRE</td>
										<td>$BK_LANGUAGE</td>
										<td align='left'>
                                        <div class='btn-group-horizontal'>
                                            <button id='modals' data-toggle='modal' data-target='#book' class='btn btn-default' value='$BK_ID' data-balloon='View Book Details' data-balloon-pos='up' style='color:white; background-color:#FFC107'>details</button>
                                        
                                            <a data-balloon='View Book Details' data-balloon-pos='up' href='./ebooks/$BK_ID.pdf' class='btn btn-primary' target='_blank'>Read</a>

                                            <a data-balloon='View Book Details' data-balloon-pos='up' href='./ebooks/$BK_ID.pdf' class='btn btn-success' download>Download</a>
                                        </div>
                                        
                                        </td>
                                        
									  </tr>
									";
				}
				
				echo "	</tbody>
						</table>
						<div>
						</div>";
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}	
			
			echo "<br><center><ul class='pagination'>";
			//paging
			if($pagenum == 1 || $pagenum == 0) {}
			else 
			{
				echo "<li><button name='changepage' id='changepage' value='1' class='btn btn-warning'><i class='fa fa-angle-double-left' ></i> First</button></li>";
				echo " ";
				$previous = $pagenum-1;
				echo "<li><button name='changepage' id='changepage' value='$previous' class='btn btn-success'><i class='fa fa-angle-left' ></i> Previous</button></li>";
			}
			
			//show current page and total num of page
			//paging
			echo "<li class='showpage'> --Page <b>$pagenum</b> of <b>$last</b>-- </li>";
			
			
			if($pagenum == $last) {}
			else 
			{
				$next = $pagenum + 1;
				echo "<li><button name='changepage' id='changepage' value='$next' class='btn btn-success'>Next <i class='fa fa-angle-right' ></i></button></li>";
				echo " ";
				echo "<li><button name='changepage' id='changepage' value='$last' class='btn btn-warning'>Last <i class='fa fa-angle-double-right' ></i></button></li>";
			}
			
			echo "</ul></center>";
				  
				  echo"
				</div><!-- /.box-body -->
				
			  </div>";
			  
			  echo "<input type='text' id='curpage' value='$pagenum' style='display:none;'>";
			
			//end paging
		
	}
	
	
	//modal show books details - CODE HUSSIN
	if($_POST['option']=='modal'){
		$id = $_POST['ids'];
		
		try{
			$stmt = $conn->prepare("
					SELECT * 
					FROM BOOKS,LANGUAGES
					WHERE BK_LANG = LANG_ID
					AND BK_ID = '$id'
					");
			$stmt->execute();

			while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$BK_ID = $result['BK_ID'];
				$BK_TITLE = $result['BK_TITLE'];
				$BK_AUTHOR = $result['BK_AUTHOR'];
				$BK_SERIES = $result['BK_SERIES'];
				$BK_PAGES = $result['BK_PAGES'];
				$BK_PUBLISH = $result['BK_PUBLISH'];
				$BK_LANG = $result['LANG_NAME'];
				$BK_SYN = $result['BK_SYN'];
				
				 
				if(file_exists('./images/bookscover/'.$BK_ID.'.jpg'))
				{
					echo "<center><img src=./images/bookscover/$BK_ID.jpg height='250px'></center>";
				}
				else
				{
					echo "<center><img src='./images/bookscover/book_temp.png' height='250px'></center>";
				} 
				echo "
					<h4><u>Details</u></h4>
					<b>Title:</b> $BK_TITLE<br>
					<b>Author:</b> $BK_AUTHOR<br>
					<b>Series:</b> $BK_SERIES<br>
					<b>Pages:</b> $BK_PAGES<br>
					<b>Publisher:</b> $BK_PUBLISH<br>
					<b>Language:</b> $BK_LANG<br>
					<br>
					<h4><u>Synopsis</u></h4>
					  <p>$BK_SYN</p>
				";
					
				
			}	
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	}
	
	//POPULATE SEARCH SELECT BOX
	//language search - CODE HUSSIN
	if($_POST['option'] == 'searchlanguage'){
		try{
			$stmt = $conn->prepare("
						SELECT *
						FROM LANGUAGES
						"
					);
			$stmt->execute();
			echo "<option value='0'>Choose language</option>";
			while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				
				$LANG_NAME = $result["LANG_NAME"];
				$LANG_ID = $result["LANG_ID"];
				
				echo "<option value='$LANG_ID'>$LANG_NAME</option>";
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	//genre search - CODE HUSSIN
	if($_POST['option'] == 'searchgenre'){
		try{
			$stmt = $conn->prepare("
						SELECT *
						FROM GENRES
						"
					);
			$stmt->execute();
			echo "<option value='0'>Choose genre</option>";
			while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				$GEN_NAME = $result["GEN_NAME"];
				$GEN_ID = $result["GEN_ID"];
				
				echo "<option value='$GEN_ID'>$GEN_NAME</option>";
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	//----------END SEARCH CODE--------------


	//--------START LIST NEW BOOK---------

	if($_POST['option'] == 'listnewestbook')
	{
		try
		{
			//----HISTORY BOOK----
			if($_POST['bookgenre'] == "history")
			{
				$stmtHist = $conn->prepare("
							SELECT *
							FROM BOOKS 
							WHERE BK_GENRE = '1'
							ORDER BY BK_ID DESC
							LIMIT 8
							"
						);
				$stmtHist->execute();
				$i = 1;

				while($resHist = $stmtHist->fetch(PDO::FETCH_ASSOC))
				{
					$bk_id = $resHist['BK_ID'];
					$bk_title = $resHist['BK_TITLE'];
					
					echo "

						<div class='col-xs-3'>
							  <button id='modals' data-toggle='modal' data-target='#book' value='$bk_id' style='border:none;background:none;'><img src='./images/bookscover/$bk_id.jpg' class='img-responsive book' title='$bk_title'></button>
							</div>

					";
					
					if($i % 4 == 0)
					{
						echo "<div class='col-xs-12 shelf'></div>";
					}
					
					$i++;
				}
			}

			//-----SciFi Fantasy Books-----
			if($_POST['bookgenre'] == "scifi")
			{
				$stmtHist = $conn->prepare("
							SELECT *
							FROM BOOKS 
							WHERE BK_GENRE = '2'
							ORDER BY BK_ID DESC
							LIMIT 8
							"
						);
				$stmtHist->execute();
				$i = 1;

				while($resHist = $stmtHist->fetch(PDO::FETCH_ASSOC))
				{
					$bk_id = $resHist['BK_ID'];
					$bk_title = $resHist['BK_TITLE'];
					
					echo "

						<div class='col-xs-3'>
							  <button id='modals' data-toggle='modal' data-target='#book' value='$bk_id' style='border:none;background:none;'><img src='./images/bookscover/$bk_id.jpg' class='img-responsive book' title='$bk_title'></button>
							</div>

					";
					
					if($i % 4 == 0)
					{
						echo "<div class='col-xs-12 shelf'></div>";
					}
					
					$i++;
				}
			}

			//-----Mystery Suspense Books-----
			if($_POST['bookgenre'] == "mystery")
			{
				$stmtHist = $conn->prepare("
							SELECT *
							FROM BOOKS 
							WHERE BK_GENRE = '3'
							ORDER BY BK_ID DESC
							LIMIT 8
							"
						);
				$stmtHist->execute();
				$i = 1;

				while($resHist = $stmtHist->fetch(PDO::FETCH_ASSOC))
				{
					$bk_id = $resHist['BK_ID'];
					$bk_title = $resHist['BK_TITLE'];
					
					echo "

						<div class='col-xs-3'>
							  <button id='modals' data-toggle='modal' data-target='#book' value='$bk_id' style='border:none;background:none;'><img src='./images/bookscover/$bk_id.jpg' class='img-responsive book' title='$bk_title'></button>
							</div>

					";
					
					if($i % 4 == 0)
					{
						echo "<div class='col-xs-12 shelf'></div>";
					}
					
					$i++;
				}
			}

			//-----Romance Books-----
			if($_POST['bookgenre'] == "romance")
			{
				$stmtHist = $conn->prepare("
							SELECT *
							FROM BOOKS 
							WHERE BK_GENRE = '4'
							ORDER BY BK_ID DESC
							LIMIT 8
							"
						);
				$stmtHist->execute();
				$i = 1;

				while($resHist = $stmtHist->fetch(PDO::FETCH_ASSOC))
				{
					$bk_id = $resHist['BK_ID'];
					$bk_title = $resHist['BK_TITLE'];
					
					echo "

						<div class='col-xs-3'>
							  <button id='modals' data-toggle='modal' data-target='#book' value='$bk_id' style='border:none;background:none;'><img src='./images/bookscover/$bk_id.jpg' class='img-responsive book' title='$bk_title'></button>
							</div>

					";
					
					if($i % 4 == 0)
					{
						echo "<div class='col-xs-12 shelf'></div>";
					}
					
					$i++;
				}
			}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

		


	//----------END LIST NEW BOOK---------

    
      
      
    



//close sql connection
$conn = null;

?>