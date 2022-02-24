<?php 

	include('delivery_adminheader.php');

	$phoneexists = "";
	$emailexists = "";
	$chkemailstaff = ""; 
	$chkemaildisplay = ""; 
	$chkeconpassword = "";

	if(isset($_POST['btn-register']))
	{	
		$staffid 	 	   = GET_ID('deliverystaff', 'deliveryStaffID');
		$staffname 		   = $_POST['txtdelistaffname'];
		$quickmail         = $_POST['txtquickmail'];
		$staffemail        = $_POST['txtdeliemail'];
		$staffphone        = $_POST['txtdeliphone'];
		$staffrole         = $_POST['txtdelirole'];
		$staffpassword     = $_POST['txtdelipassword']; 
		$conpassword       = $_POST['txtdeliconpassword'];
		$checkstaffemail   = CHECK_ATTRIBUTE('deliverystaff', 'deliveryStaffEmail', $staffemail);
		$checkstaffphone   = CHECK_ATTRIBUTE('deliverystaff', 'deliveryStaffPhone', $staffphone);

		if($staffemail != $checkstaffemail) 
		{		
			if($staffphone != $checkstaffphone)		         	  
			{
	
				$chkemailstaff = preg_match('/@quick.com/', $quickmail);

				if ($chkemailstaff) 
				{	

					if($staffpassword == $conpassword)
					{ 
						$hash = md5($staffpassword);
						$insertstaff = " 			
						INSERT INTO deliverystaff 
						VALUES ('$staffid','$staffname', '$staffemail', '$quickmail', '$staffphone', '$staffrole', '$hash', 'Free')";

						$run = mysqli_query($connect, $insertstaff);					

						if($run)
						{  
							echo "<script>
							alert('Staff Registered Successfully ! ');
							window.location.assign('manage_deliverystaff.php');		
							</script>";					 
						}		
							
						else
						{
							echo mysqli_error($connect);
						}
					}

					else
				    {
				    	$chkeconpassword = "*Password are not match*"; 
				    }
			    }

			    else
			    {
			    	$chkemaildisplay = "*Quick Username must end with @quick.com*"; 
			    }
			}


			else
			{
				$phoneexists = "*Phone Number Already Exists*";
			}

		}

		else
		{
			$emailexists = "*Staff Email Already Exists*";
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Delivery Staff Register | <Quick class="com"></Quick></title>
</head>
<body>					
		<div id="page-wrapper"><br><br>

		 	<div class="header"> 
                <h1 class="page-header">
                    Delivery Staff Register
                </h1>
				<ol class="breadcrumb">
					<li><a href="delivery_adminhome.php">Home</a></li>
					<li>Staff Register</li>
				</ol> 
									
			</div>
           	
           	 <div id="page-inner"> 
			 <div class="row">
			 <div class="col-lg-12">
			 <div class="card">
            <div class="card-content">	

		    <form class="col s12" action="add_deliverystaff.php" method="POST" >

		    	<div class="row">
			        <div class="input-field col s12">
			          <input type="text" class="validate" name="txtdelistaffname" required>
			          <label for="txtdelistaffname">Delivery Staff Name</label>
			        </div>
		        </div>

		        <div class="row">
			        <div class="input-field col s12">
			          <input type="text" class="validate" name="txtquickmail" required>
			          <label for="StaffName">Create Quick User Name (eg. example@quick.com)</label>
			          <?php echo "<p style='color:red;'>$chkemaildisplay </p>"; ?>
			        </div>
		        </div>

		      <div class="row">
		        <div class="input-field col s6">
		          <input type="text" class="validate" name="txtdeliemail" required>
		          <label for="first_name">Contact Email</label>
		          <?php echo "<p style='color:red;'>$emailexists </p>"; ?>
		        </div>
		        <div class="input-field col s6">
		          <input type="text" class="validate" name="txtdeliphone" required>
		          <label for="last_name">Delivery Staff Phone</label>
		          <?php echo "<p style='color:red;'>$phoneexists </p>"; ?>
		  	      </div>	
		      </div> 


			<div class="row">
		        <div class="input-field col s12">
		          <label for="password">Select Role</label><br><br>
		          <select style="display: block; border: 1px solid #b3b3b3; height: 40px;" name="txtdelirole">
		          	<option>Admin</option>
		          	<option>Delivery Man</option>
		          </select>
		        </div>
		      </div>

		      <div class="row">	
		        <div class="input-field col s12">
		          <input id="password" type="password" class="validate" name="txtdelipassword" required>
		          <label for="password">Set a Password</label>
		        </div>
		      </div>

		      <div class="row">	
		        <div class="input-field col s12">
		          <input id="password" type="password" class="validate" name="txtdeliconpassword" required>
		          <label for="txtconpassword">Confirm Password</label>
		          <?php echo "<p style='color:red;'>$chkeconpassword </p>"; ?>
		        </div>
		      </div>

		      <button style="padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;" name="btn-register">Register</button>
 	
		    </form>
	<div class="clearBoth"></div>
  	</div>

    </div>
 </div>	
	 </div>		
            
			<footer><p>Copyright 2022 &copy; CultureX all rights reserved.</footer>
			</div>
             <!-- /. PAGE INNER  -->
			
					
        </div>
        <!-- /. PAGE WRAPPER  -->
</body>
</html> 	