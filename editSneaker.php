<?php 
	
	include('components/header.php');
	$myemail = $_SESSION['myemail'];
	$myid    = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');

  
     $sneakerid       = $_GET['snid'];
     $selectsneaker   = "SELECT * FROM sneaker WHERE sneakerID = '$sneakerid' ";  
     $runsneaker      = mysqli_query($connect, $selectsneaker);
     $rowsneaker      = mysqli_fetch_array($runsneaker);

     $snname      = $rowsneaker['sneakerName'];   

     $categoryid  = $rowsneaker['categoryID'];
     $brandid     = $rowsneaker['brandID'];

     $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
     $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');

     $footwid    = $rowsneaker['sneakerSubCategory'];
     if($footwid == 'Men'){
        $footw = 'For Men';
     }else if($footwid == 'Women'){
        $footw = 'For Women';
     }else if($footwid == 'Sport'){
        $footw = 'Sport Wear';
     }

     // image take out
     $image1   = $rowsneaker['productImage1'];
     $image2   = $rowsneaker['productImage2'];
     $image3   = $rowsneaker['productImage3'];
     $image4   = $rowsneaker['productImage4'];
     $image5   = $rowsneaker['productImage5'];

     // set placeholder for null images
     if ($image2 == '') {
       $image2 = "themes/img/upload2.webp";
     }else if ($image3 == '') {
       $image3 = "themes/img/upload2.webp";
     }else if ($image4 == '') {
       $image4 = "themes/img/upload2.webp";
     }else if ($image5 == '') {
       $image5 = "themes/img/upload2.webp";
     }else if ($image1 == '') {
       $image1 = "themes/img/upload2.webp";
      }

     // normal retrieve
     $price   = $rowsneaker['sneakerPrice'];
     $instock = $rowsneaker['inStock'];
     $desc    = $rowsneaker['description'];


  // update data 
  if (isset($_POST['btn-edit-sneaker'])) 
  {
        // Image upload cubrid_error_code()
        // $image1ed = $_FILES['txtimage1']['name'];
        // $folder = "ImagesUploaded/";   
        // if ($image1ed) 
        // {  
        //   $filename1 = $folder."_".$image1ed;
        //   $copied = copy($_FILES['txtimage1']['tmp_name'], $filename1);

        //   if (!$copied)     
        //   {                         
        //     exit("Problem Occured. Cannot upload image");
        //   }
        // }

        // Image upload cubrid_error_code()
        // $image2ed = $_FILES['txtimage2']['name'];
        // $folder = "ImagesUploaded/";   
        // if ($image2ed) 
        // {  
        //   $filename2 = $folder."_".$image2ed;     
        //   $copied = copy($_FILES['txtimage2']['tmp_name'], $filename2);

        //   if (!$copied)     
        //   {                             
        //     exit("Problem Occured. Cannot upload image");
        //   }
        // }

        // Image upload cubrid_error_code()
        // $image3ed = $_FILES['txtimage3']['name'];
        // $folder = "ImagesUploaded/";   
        // if ($image3ed) 
        // {      
        //   $filename3 = $folder."_".$image3ed;
        //   $copied = copy($_FILES['txtimage3']['tmp_name'], $filename3);

        //   if (!$copied)     
        //   {                             
        //     exit("Problem Occured. Cannot upload image");
        //   }
        // }

        // Image upload cubrid_error_code()
        // $image4ed = $_FILES['txtimage4']['name'];
        // $folder = "ImagesUploaded/";   
        // if ($image4ed)    
        // {  
        //   $filename4 = $folder."_".$image4ed;
        //   $copied = copy($_FILES['txtimage4']['tmp_name'], $filename4);

        //   if (!$copied)     
        //   {                             
        //     exit("Problem Occured. Cannot upload image");
        //   }
        // }

        // Image upload cubrid_error_code()
        // $image5ed = $_FILES['txtimage5']['name'];
        // $folder = "ImagesUploaded/";   
        // if ($image5ed) 
        // {               
        //   $filename5 = $folder."_".$image5ed;
        //   $copied = copy($_FILES['txtimage5']['tmp_name'], $filename5);

        //   if (!$copied)     
        //   {                             
        //     exit("Problem Occured. Cannot upload image");
        //   }
        // }

        // Get ID form email, and name
        $sneakerided          = $_POST['txtsnid'];        
        $productnameed        = $_POST['txtproductname'];
        $productpriceed       = $_POST['txtproductprice'];
        $subcategoryed        = $_POST['txtsubcategory'];
        $descriptioned        = $_POST['txtdesc'];
        $quantityed           = $_POST['txtproductquantity'];
        $productbranded       = $_POST['txtbrand'];
        $productcategoryed    = $_POST['txtcategory'];

        $updatesneaker = "
        UPDATE `sneaker` 
        SET `sneakerName`='$productnameed',`sneakerPrice`='$productpriceed',`sneakerSubCategory`='$subcategoryed',`description`='$descriptioned',`inStock`='$quantityed',`brandID`='$productbranded',`categoryID`='$productcategoryed' WHERE `sneakerID` = '$sneakerided'
        ";

        $runsneaker = mysqli_query($connect, $updatesneaker);                    

        if($runsneaker)
        {  
            echo "<script>
            alert('$productnameed is Updated !');
            window.location.assign('productlist.php');        
            </script>";                   
        }       
                        
        else { echo mysqli_error($connect); }
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Edit Sneaker | CultureX</title>
</head>

<body>	


  <!-- Register Section Begin --><br><br><br><br><br>
    <div class="register-login-section spad">  
    <!-- Breadcrumb Section Begin --> 
    <div class="breacrumb-section"> <div
    class="container"> <div class="row"> <div class="col-lg-12"> <div
    class="breadcrumb-text product-more">   <a href="./index.html"><i
    class="fa fa-home"></i> Home</a> <a href="./shop.html">Seller Tools</a>
    <span>Edit Sneaker</span>         </div> </div>   </div> </div>
    </div>     <!-- Breadcrumb Section End -->  
        <div class="container">
            <div class="row">      
                <div class="col-lg-6 offset-lg-3"> 
                    <div class="register-form"><br>
                        <h2 class="header-line">Add Product</h2>

                        <form action="editSneaker.php" method="POST" enctype="multipart/form-data"> 

                            <input type="hidden" name="txtsnid" value="<?php echo($sneakerid) ?>">
                            
                            <div class="group-input">   
                                <label for="productname">Sneaker Name</label>
                                <input type="text" id="productname" name="txtproductname" value="<?php echo($snname) ?>">
                            </div> 
  
                            <!-- Multiple Image upload -->
                            <!-- <div class="group-input">

                                <label for="productquantity">Sneaker Images</label>

                                    <div class="row-up"> 

                                        <div class="col-20-up"> 
                                            <img id="output1" width="80" height="80" style="cursor: pointer;" 
                                            src="<?php echo($image1) ?>">
                                            <input type="file"  accept="image/*" name="txtimage1" id="file1"  onchange="loadFile1(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;" value="<?php echo($image1) ?>"> 
                                        </div>
 
                                        <div class="col-20-up">             
                                            <img id="output2" width="80" height="80" style="cursor: pointer;" src="<?php echo($image2) ?>">
                                            <input type="file"  accept="image/*" name="txtimage2" id="file2"  onchange="loadFile2(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;" value="<?php echo($image2) ?>">
                                        </div>

                                            <div class="col-20-up">     
                                                <img id="output3" width="80" height="80" style="cursor: pointer;" 
                                                src="<?php echo($image3) ?>">
                                                <input type="file"  accept="image/*" name="txtimage3" id="file3"  onchange="loadFile3(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;" value="<?php echo($image3) ?>">
                                            </div> 

                                        <div class="col-20-up">     
                                            <img id="output4" width="80" height="80" style="cursor:
                                             pointer;" src="<?php echo($image4) ?>">
                                            <input type="file"  accept="image/*" name="txtimage4" id="file4"  onchange="loadFile4(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;" value="<?php echo($image4) ?>">
                                        </div>

                                        <div class="col-20-up"> 
                                            <img id="output5" width="80" height="80" style="cursor:
                                             pointer;" src="<?php echo($image5) ?>">
                                            <input type="file"  accept="image/*" name="txtimage5" id="file5"  onchange="loadFile5(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;" value="<?php echo($image5) ?>">
                                        </div>
                                    </div>
                            </div>   -->

                            <div class="row group-input">

                                <div class="input-field col s6">
                                    <label for="Category">Category</label>
                                    <select name="txtcategory">
                                      <option value="<?php echo($categoryid) ?>"><?php echo "$category"; ?></option>
                                    <?php

                                        $selectcategory = "SELECT * FROM category WHERE categoryID != '$categoryid' ";
                                        $runcategory = mysqli_query($connect, $selectcategory);
                                        $countcategory = mysqli_num_rows($runcategory);  

                                        for ($i=0;$i<$countcategory;$i++)
                                        {
                                            $rowcategory   = mysqli_fetch_array($runcategory);
                                            $categoryid    = $rowcategory['categoryID'];
                                            $categoryname  = $rowcategory['categoryName'];

                                            echo"<option value='$categoryid'>$categoryname</option>";
                                        }

                                    ?>
                                    </select>
                                </div>

                                <div class="input-field col s6">
                                    <label for="Brand">Brand</label>
                                    <select name="txtbrand">
                                      <option value="<?php echo($brandid) ?>"><?php echo "$brand"; ?></option>
                                    <?php

                                        $selectbrand = "SELECT * FROM  brand WHERE brandID != '$brandid' ";
                                        $runbrand = mysqli_query($connect, $selectbrand);
                                        $countbrand = mysqli_num_rows($runbrand);

                                        for ($i=0;$i<$countbrand;$i++)
                                        {
                                            $rowbrand   = mysqli_fetch_array($runbrand);
                                            $brandid    = $rowbrand['brandID'];
                                            $brandname  = $rowbrand['brandName']; 

                                            echo"<option value='$brandid'>$brandname</option>";
                                        }
                                                
                                    ?>
                                </select>
                                </div>  
                            </div> 
    
                            <div class="group-input">
                                <label for="productprice">Footwear type</label>
                                <select name="txtsubcategory">
                                    <option value="<?php echo($footwid) ?>"><?php echo "$footw"; ?></option>
                                    <option value='Men'>For Men</option>
                                    <option value='Women'>For Women</option>
                                    <option value='Sport'>Sport Wear</option>
                                </select>
                            </div>   

                            <div class="group-input">
                                <label for="productprice">Price In US$</label>
                                <input type="number" 
                                       id="productprice" 
                                       name="txtproductprice" 
                                       value="<?php echo($price) ?>"
                                       required>
                            </div>  

                            <div class="group-input">
                                <label for="productquantity">Instock Quantity</label>
                                <input type="number" 
                                       id="productquantity" 
                                       name="txtproductquantity" 
                                       value="<?php echo($instock) ?>"
                                       required>
                            </div>

                            <div class="group-input">
                                <label for="productdescription">Additional Information</label>    
                                <textarea id="productdescription"  
                                          name="txtdesc" 
                                          required>
                                    <?php echo "$desc"; ?>
                                </textarea>
                            </div>  

                            <button type="submit" class="site-btn register-btn" name="btn-edit-sneaker">
                              Update
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
                        
        <!-- footer component -->
    <?php include('components/footer.php'); ?>

</body>



 <script>
	var loadFile1 = function(event) {
		var image1 = document.getElementById('output1');
		image1.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile2 = function(event) {
		var image2 = document.getElementById('output2');
		image2.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile3 = function(event) {
		var image3 = document.getElementById('output3');
		image3.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile4 = function(event) {
		var image4 = document.getElementById('output4');
		image4.src = URL.createObjectURL(event.target.files[0]);    
	};

	var loadFile5 = function(event) {
		var image5 = document.getElementById('output5');
		image5.src = URL.createObjectURL(event.target.files[0]);
	};



</script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>

    <script src="assets/js/jquery-1.10.2.js"></script>		
	
	<!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/materialize/js/materialize.min.js"></script>
	
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	
	
	<script src="themes/js/easypiechart.js"></script>
	<script src="themes/js/easypiechart-data.js"></script>
	
	<script src="themes/js/Lightweight-Chart/jquery.chart.js"></script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="themes/js/dataTables/jquery.dataTables.js"></script>
    <script src="themes/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();  
            });
    </script>
	
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script> 

</body>

</html>