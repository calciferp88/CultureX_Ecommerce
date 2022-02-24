<?php 

	include('adminheader.php');

	$checkbrand  = "";
	$brandexists = "";

	if(isset($_POST['btn-register']))
	{	
		$brandid 	 	 = GET_ID('brand', 'brandID');
		$brandname 		 = $_POST['txtbrandname'];

		$checkbrand   = CHECK_ATTRIBUTE('brand', 'brandName', $brandname);

		if($checkbrand) 
		{		
			$brandexists = "*This brand already Exists*";
		}

		else
		{
			$insertbrand = " 			
			INSERT INTO brand 
			VALUES ('$brandid','$brandname','$staffid')";

		    $run = mysqli_query($connect, $insertbrand);					

			if($run)
			{  
				echo "<script>
				alert('$brandname Registered Successfully ! ');
				window.location.assign('managebrand.php');		
				</script>";					 
			}		
						
			else
			{
				echo mysqli_error($connect);
			}
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Brand Register | CultureX Admin</title>
</head>
<body>					
		<div id="page-wrapper"><br><br>

		 	<div class="header"> 
                <h1 class="page-header">
                    Brand Register
                </h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Brand Registered</a></li>
				</ol> 
									
			</div>
           	
           	 <div id="page-inner"> 
			 <div class="row">
			 <div class="col-lg-12">
			 <div class="card">
            <div class="card-content">	

		    <form class="col s12" action="addbrand.php" method="POST" enctype="multipart/form-data">

		    	<div class="row">
			        <div class="input-field col s12">
			          <input type="text" class="validate" name="txtbrandname" required>
			          <label for="BrandName">Brand Name</label>
			          <?php echo "<p style='color:red;'>$brandexists </p>"; ?>
			        </div>
		        </div>

		       <br>

		      <button style="margin-left:-10px;padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;" name="btn-register">Register</button>
 	
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