<?php 

	include('components/header.php');

	if (!isset($_SESSION['myemail'])) 
	{
		echo "<script>	
		alert('Please Login First ');
		window.location.assign('login.php');	
		</script>";  
	}

	$myemail = $_SESSION['myemail'];
	$myid = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');

	if (isset($_POST['btn-edit']))   
	{	
		$edid    = $myid;
		$edname  = $_POST['edname'];
		$edmail  = $_POST['edmail'];
		$edphone = $_POST['edphone'];
		$eddob   = $_POST['eddob'];

		$update  = "UPDATE user SET userName ='$edname', userEmail ='$edmail', userPhone ='$edphone', userDateOfBirth ='$eddob' WHERE    userID  = '$myid' "; 

		$runupdate = mysqli_query($connect, $update); 
  		
		if($runupdate)
		{  	   	
			$_SESSION['myemail'] = 	$edmail;
			echo "<script>	
			alert('Updated Successfully ! ');
			window.location.assign('profile.php');	
			</script>";  
		}
					
		else
		{
			echo mysqli_error($connect);	
		}
	}	

	if (isset($_POST['btn-upgrade'])) 
	{	
		$card     = $_POST['rdocard'];
        $userid   = $myid;
        $incomeid = GET_ID('income', 'incomeID');	
        $date	  = DATE('Y-m-d');
        $day      = DATE('d');
        $month    = DATE('m');
        $year     = DATE('Y');	
        $cardnumb = $_POST['txtcardnumber'];

		$update  = "UPDATE user 
					SET sellerStatus = '1'           
					WHERE userID = '$userid' ";

		$runupdate = mysqli_query($connect, $update);
   
		$insert = "INSERT INTO income 
				   VALUES('$incomeid', '$date', '$day', '$month', '$year', '29', '$card', '$cardnumb', 'Seller Registration', '$userid')";

		$runinsert = mysqli_query($connect, $insert);

		if($runupdate)			
		{  	   

			if($runinsert)			
			{  	   
				echo "<script>		
				alert('Seller Account Registered Successfully !');
				window.location.assign('profile.php');	 
				</script>";  
			}
										
			else
			{	
				echo mysqli_error($connect);	
			}
		}
									
		else
		{	
			echo mysqli_error($connect);	
		}

	}		

 ?>

 <!DOCTYPE html>	
 <html>	
 <head>
 <title>Profile | PimShop</title>	
 <style type="text/css">

	 	.rowp	
	 	{
 			display: flex;	 
 		}  

 		.col-50
 		{
 			flex: 50%;		
 		}

 		.col-25
 		{
 			flex:25%;
 		}

 		.col-30
 		{
 			flex:33.33%;
 		}

	 		.display-div
	 		{
	 			height: 480px;	
	 			background-color: white;
	 			margin:20px; 
	 			box-shadow: 0px 0px 10px #bfbfbf;	
	 			margin-top: 40px;
	 		}

 		.col-100
 		{
 			flex: 100%;
 		}

 		label
 		{
 			padding: 15px;
 			text-align:center;
 			color: #e7ab3c;
 		}

		label span
		{
			color: blue;
		}

 		.display-div p, .display-div2 p
 		{
 			padding-left: 15px;
 			padding-bottom: 10px;
 		}

 		.display-div button
 		{
 			width: 40%;
 			margin-left:auto;
 			margin-right:auto;
 		}	

 		.display-div2
 		{
 			height: 470px;
 			background-color: white;
 			margin:20px;
 			box-shadow: 0px 0px 10px #bfbfbf;
 			margin-top: 40px;
 		}

 		.display-div2 h4
 		{
 			text-align: center;
 			padding: 30px;
 			color: #e7ab3c;
 			
 		}

 		a:hover
 		{
 			color: blue;
 		}

 		.upgrade
 		{
 			color: red;	 	 	
 		}

 		input[type=text], input[type=date] {
			width: 90%;	
			height: 46px;
			border: 2px solid #bfbfbf;
			margin-left: 15px;
			padding-left: 10px;
			color: #404040;
		}

									

	    table {  
		  border-collapse: collapse;
		  border-spacing: 0;
		  width: 100%;
		  border:none;		
		}								
   
		th, td { text-align: left; padding: 16px;}

		tr:nth-child(even) {
		  background-color: #f2f2f2;
		}
      		
		.display-div-edit
 		{	
 				background-color: white;
 			margin:20px;
 			box-shadow: 0px 0px 10px #bfbfbf;					
 			margin-top: 40px;
 		}
 		
 		.display-div-edit h4
 		{
 			text-align: left;
 			padding: 30px; 				
 			color: #e7ab3c;	
 		}

 		.display-div-edit p
 		{
 			padding-left: 30px;				
 		}

 		.display-div-edit input
 		{
 			margin-left: 0px;
 			width: 50%;	
 		}	

 		.btn-link
 		{
 			color: white;
 			text-decoration: none;
 			background-color: #e7ab3c;	
 			padding: 10px;
 		}

 		.btn-link:hover	
 		{
 			color: white;
 			background-color: #e39d1c;
 			text-decoration: none; 
 		}

 </style>	
 </head> 
 <body>
 	
 	<!-- Register Section Begin --><br><br>
    <div class="register-login-section spad">

            <div class="rowp">

            	<?php 

            		if (isset($_GET['edit'])) 
	    			{	
		    			$loggemail = $_SESSION['myemail'];
	            		$myname = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userName');
	            		$phone  = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userPhone');
	            		$dob = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userDateOfBirth'); 
	            		$country = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userCountry');
	            		$gender = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userGender');	  
            	 ?>
            	 
            	<div class="col-50 display-div">
                    <label>Edit Your Details |</label>
                    <form action="profile.php" method="POST">  
	                  <p> <i class="fas fa-user"></i> &nbsp;&nbsp;<input type="text" name="edname" value="<?php echo($myname) ?>"></p>	
	                  <p><i class="fas fa-envelope"></i> &nbsp;&nbsp;<input type="text" name="edmail" value="<?php echo($loggemail) ?>"></p>
	                  <p><i class="fas fa-phone"></i> &nbsp;&nbsp;<input type="text" name="edphone" value="<?php echo($phone) ?>"></p>
	                  <p><i class="fas fa-birthday-cake"></i> &nbsp;&nbsp;<input type="date" name="eddob" value="<?php echo($dob) ?>" ></p>
	          		  <p><i class="fas fa-male"></i><i class="fas fa-female"></i> &nbsp;&nbsp;
	          		  	<input type="text" name="edgender" value="<?php echo($gender) ?>" disabled>
	          		  </p>
	          		
	                  <p><button type="Submit" name="btn-edit">Confirm Edit </button></p>
                    </form>
                </div> 
    
            	<?php }

            	else
            	{
            		$loggemail = $_SESSION['myemail'];
            		$myname = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userName');
            		$phone  = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userPhone');
            		$dob = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userDateOfBirth'); 
            		$country = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userCountry');
            		$gender = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'userGender');		

            	?>

                <div class="col-50 display-div">
                    <label>Your Details |</label> 
                    <a href="profile.php?edit">Edit</a><br><br>  
                    <p><i class="fas fa-user"></i> &nbsp;&nbsp;<?php echo "$myname"; ?></p>	 
                    <p><i class="fas fa-envelope"></i> &nbsp;&nbsp;<?php echo "$loggemail"; ?></p>
                    <p><i class="fas fa-phone"></i> &nbsp;&nbsp;<?php echo "$phone"; ?></p>
                    <p><i class="fas fa-birthday-cake"></i> &nbsp;&nbsp;<?php echo "$dob"; ?></p>
                    <p><i class="fas fa-globe-asia"></i> &nbsp;&nbsp;<?php echo "$country"; ?></p>
                    <p><i class="fas fa-male"></i><i class="fas fa-female"></i> &nbsp;&nbsp;<?php echo "$gender"; ?></p>  
                    <p><a href="profile.php#changepassword" style="color: red;"><i class="fas fa-lock"> &nbsp;</i> Click here to change your password </a></p>
                </div>

	           	<?php } ?>

	           	<?php 

	           			$loggemail = $_SESSION['myemail'];
		                $seller    = GET_ATTRIBUTE('user', 'userEmail', $loggemail, 'sellerStatus');	

            		    if ($seller == 0) 
            		   	{          
            		    	
	           		 ?>	

	                <div class="col-50 display-div">	

	                    <label> Update Your Account as a Seller <span>with only $29</span> |</label> <br>

	                    <form class="payment" action="profile.php" method="POST" id="credit">
							
		                    <label>Choose a Card for payment</label>
		                    <p> <input type="radio" value = "visa" name="rdocard" checked> Visa  &nbsp;&nbsp;&nbsp;&nbsp;
		                    	<input type="radio" value = "Mastercard" name="rdocard"> Mastercard  &nbsp;&nbsp;&nbsp;&nbsp;
		                    	<input type="radio" value = "JCB" name="rdocard"> JCB
		                    </p>			
		                    
		                   	<div class="row">	
			                    <div class="col-lg-6">
			                        <label for="fir">Card Number</label>		
			                        <input type="text" class="cc-number" name="txtcardnumber" placeholder="eg.1111 2222 3333 4444"required>

			                    </div>	

		                    	<div class="col-lg-6">	
		                        	<label for="last">Name On Card</label>
		                       	 	<input type="text" id="last" name="txtnameoncard" required>	
		                    	</div>
	                        </div>	

	                    <div class="row">  		      
		                    <div class="col-lg-6">
		                        <label for="fir">Exp Date</label>	  
		                        <input type="text" id="fir" placeholder="MM/YY" name="txtexpdate" required>
		                    </div>

		                    <div class="col-lg-6">
		                        <label for="last">CVV</label>		
		                        <input type="text" id="last" placeholder="eg.111" name="txtcvv" required>
		                    </div>	 
	                    </div><br>

	                    <p><button name="btn-upgrade">Upgrade Now	</button></p>
                      		
                    </form>	
           	</div> 
           	<?php  } 

           	else if ($seller == 1)  { 

           		$loggemail = $_SESSION['myemail']; 
           		$userid= $myid;

            	$selectdate = "SELECT * FROM income 
            				   WHERE userID = '$userid'
            				   AND incomeStatus = 'Seller Reg'  ";   

            	$runselectdate = mysqli_query($connect, $selectdate);
            	$rowdateget   = mysqli_fetch_array($runselectdate); 
                $date    = $rowdateget['incomeDate'];	
           	?>

           	<div class="col-50 display-div">	

	            <label> You are a PimShop Seller since <span><?php echo "$date"; ?></span> |</label> <br>
 	
	            <br>
	            <center>	
	            	<img src="themes/img/seller2.gif" width="50%;"><br><br><br>
	            	<a href="" class="btn-link">Go to Seller Dashboard</a>
	            </center>
	            
           	</div>
           	<?php  }  ?>
        </div>  
    </div>

        <!-- footer component -->
    <?php include('components/footer.php'); ?>

    <!-- Register Form Section End -->
 </body>	
 </html>		



 </script>