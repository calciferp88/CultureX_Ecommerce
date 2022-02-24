<?php 

	include('adminheader.php');

	$checkcategory  = "";
	$categoryexists = "";

	if(isset($_POST['btn-register']))
	{	
		$categoryid 	  = GET_ID('category', 'categoryID');
		$categoryname     = $_POST['txtcategoryname'];


		$checkcategory   = CHECK_ATTRIBUTE('category', 'categoryName', $categoryname);

		if($checkcategory) 
		{		
			$categoryexists = "*This Category already Exists*";
		}    

		else
		{
			$insertcategory = " 			
			INSERT INTO category 
			VALUES ('$categoryid','$categoryname', '')";

		    $run = mysqli_query($connect, $insertcategory);					

			if($run)
			{  
				echo "<script>
				alert('$categoryname Registered Successfully ! ');
				window.location.assign('addcategory.php');		
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
	<title>Category Register | CultureX Admin</title>
</head>
<body>					
		<div id="page-wrapper"><br><br>

		 	<div class="header"> 
                <h1 class="page-header">
                    Category Register
                </h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Category Registere</a></li>
				</ol> 
									
			</div>

           	 <div id="page-inner"> 
			 <div class="row">
			 <div class="col-lg-12">
			 <div class="card">
            <div class="card-content">	

		    <form class="col s12" action="addcategory.php" method="POST" enctype="multipart/form-data">

		    	<div class="row">
			        <div class="input-field col s12">
			          <input type="text" class="validate" name="txtcategoryname" required>
			          <label for="CategoryName">Category Name</label>
			          <?php echo "<p style='color:red;'>$categoryexists </p>"; ?>
			        </div>
		        </div>

		       

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