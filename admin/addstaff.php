<?php 

	include('adminheader.php');

	$phoneexists = "";
	$emailexists = "";
	$chkemailstaff = ""; 
	$chkemaildisplay = ""; 
	$chkeconpassword = "";

	if(isset($_POST['btn-register']))
	{	
		$staffid 	 	 = GET_ID('staff', 'staffID');
		$staffname 		 = $_POST['txtstaffname'];
		$culturexmail     = $_POST['txtpimshopmail'];
		$staffemail      = $_POST['txtemail'];
		$staffphone      = $_POST['txtphone'];
		$staffgender      = $_POST['txtgender'];
		$staffrole        = $_POST['txtrole'];
		$staffpassword    = $_POST['txtpassword']; 
		$conpassword      = $_POST['txtconpassword'];
		$checkstaffemail   = CHECK_ATTRIBUTE('staff', 'staffEmail', $staffemail);
		$checkstaffphone   = CHECK_ATTRIBUTE('staff', 'staffPhone', $staffphone);
		$checkculturex     = CHECK_ATTRIBUTE('staff', 'cultureXMail', $culturexmail);


		if($staffemail != $checkstaffemail) 
		{		
			if($staffphone != $checkstaffphone)		         	  
			{
				
				$chkemailstaff = preg_match('/@culturex.com/', $culturexmail);

				if ($chkemailstaff) 
				{	
					if ($culturexmail != $checkculturex) 
					{
						if($staffpassword == $conpassword)
						{ 
							$hash = md5($staffpassword);
							$insertstaff = " 			
							INSERT INTO staff 
							VALUES ('$staffid','$staffname', '$staffemail', '$culturexmail', '$staffrole', '$staffphone', '$staffgender', '$hash', '')";

							$run = mysqli_query($connect, $insertstaff);					

							if($run)
							{  
								echo "<script>
								alert('Staff Registered Successfully ! ');
								window.location.assign('adminhome.php');		
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
				    	$chkemaildisplay = "*CultureX Username already exist*"; 
				    }

					
			    }

			    else
			    {
			    	$chkemaildisplay = "*CultureX Username must end with @culturex.com*"; 
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
	<title>Staff Register | CultureX Admin</title>
</head>
<body>					
		<div id="page-wrapper"><br><br>

		 	<div class="header"> 
                <h1 class="page-header">
                    Staff Register
                </h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Staff Register</a></li>
				</ol> 
									
			</div>
           	
           	 <div id="page-inner"> 
			 <div class="row">
			 <div class="col-lg-12">
			 <div class="card">
            <div class="card-content">	

		    <form class="col s12" action="addstaff.php" method="POST" >

		    	<div class="row">
			        <div class="input-field col s12">
			          <input type="text" class="validate" name="txtstaffname" required>
			          <label for="txtstaffname">Staff Name</label>
			        </div>
		        </div>

		        <div class="row">
			        <div class="input-field col s12">
			          <input type="text" class="validate" name="txtpimshopmail" required>
			          <label for="StaffName">Create CultureX User Name (eg. example@culturex.com)</label>
			          <?php echo "<p style='color:red;'>$chkemaildisplay </p>"; ?>
			        </div>
		        </div>

		      <div class="row">
		        <div class="input-field col s6">
		          <input type="text" class="validate" name="txtemail" required>
		          <label for="first_name">Email</label>
		          <?php echo "<p style='color:red;'>$emailexists </p>"; ?>
		        </div>
		        <div class="input-field col s6">
		          <input type="text" class="validate" name="txtphone" required>
		          <label for="last_name">Phone</label>
		          <?php echo "<p style='color:red;'>$phoneexists </p>"; ?>
		  	      </div>	
		      </div> 


			<div class="row">
		        <div class="input-field col s12">
		          <label for="password">Select Role</label><br><br>
		          <select style="display: block; border: 1px solid #b3b3b3; height: 40px;" name="txtrole">
		          	<option>System Admin</option>
		          	<option>General Staff</option>
		          </select>
		        </div>
		      </div>

		      <div class="row">
		        <div class="input-field col s12">
		          <label for="password">Select Gender</label><br><br>	
		          <select style="display: block; border: 1px solid #b3b3b3; height: 40px;" name="txtgender">
		          	<option>Male</option>	
		          	<option>Female</option>
		          </select>
		        </div>
		      </div>  
		 		
		      <div class="row">	
		        <div class="input-field col s12">
		          <input id="password" type="password" class="validate" name="txtpassword" required>
		          <label for="password">Password</label>
		        </div>
		      </div>

		      <div class="row">	
		        <div class="input-field col s12">
		          <input id="password" type="password" class="validate" name="txtconpassword" required>
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