<?php

    include('components/header.php');


	$productname = "";
    $productprice = "";
    $productquantity = "";
    $productbrand = "";
    $productsubcategory = "";
    $uploaddate = "";
    $status = "";
    $productexist = "";
    $filename1= "";
    $filename2= "";
    $filename3= "";
    $filename4= "";
    $filename5= "";

	if(isset($_POST['btn-upload-product']))
	{

        // Image upload cubrid_error_code()
        $image1 = $_FILES['txtimage1']['name'];
        $folder = "ImagesUploaded/";
        if ($image1)
        {
          $filename1 = $folder."_".$image1;
          $copied = copy($_FILES['txtimage1']['tmp_name'], $filename1);

          if (!$copied)
          {
            exit("Problem Occured. Cannot upload image");
          }
        }

        // Image upload cubrid_error_code()
        $image2 = $_FILES['txtimage2']['name'];
        $folder = "ImagesUploaded/";
        if ($image2)
        {
          $filename2 = $folder."_".$image2;
          $copied = copy($_FILES['txtimage2']['tmp_name'], $filename2);

          if (!$copied)
          {
            exit("Problem Occured. Cannot upload image");
          }
        }

        // Image upload cubrid_error_code()
        $image3 = $_FILES['txtimage3']['name'];
        $folder = "ImagesUploaded/";
        if ($image3)
        {
          $filename3 = $folder."_".$image3;
          $copied = copy($_FILES['txtimage3']['tmp_name'], $filename3);

          if (!$copied)
          {
            exit("Problem Occured. Cannot upload image");
          }
        }

        // Image upload cubrid_error_code()
        $image4 = $_FILES['txtimage4']['name'];
        $folder = "ImagesUploaded/";
        if ($image4)
        {
          $filename4 = $folder."_".$image4;
          $copied = copy($_FILES['txtimage4']['tmp_name'], $filename4);

          if (!$copied)
          {
            exit("Problem Occured. Cannot upload image");
          }
        }

        // Image upload cubrid_error_code()
        $image5 = $_FILES['txtimage5']['name'];
        $folder = "ImagesUploaded/";
        if ($image5)
        {
          $filename5 = $folder."_".$image5;
          $copied = copy($_FILES['txtimage5']['tmp_name'], $filename5);

          if (!$copied)
          {
            exit("Problem Occured. Cannot upload image");
          }
        }

        // Get ID form email, and name
        $selleremail = $_SESSION['myemail'];
        $sellerid = GET_ATTRIBUTE('user', 'userEmail', $selleremail, 'userID');
        $productid          = GET_ID('sneaker', 'sneakerID');
        $productname        = $_POST['txtproductname'];
        $productprice       = $_POST['txtproductprice'];
        $subcategory        = $_POST['txtsubcategory'];
        $description        = $_POST['txtdesc'];
        $quantity           = $_POST['txtproductquantity'];
        $today              = DATE('Y-m-d');
        $totalsale          = 0;
        $productbrand       = $_POST['txtbrand'];
        $productcategory    = $_POST['txtcategory'];

        $insertproduct = "INSERT INTO sneaker
        VALUES ('$productid','$productname', '$productprice', '$subcategory', '$description', '$quantity', '$today', 0,
                '$filename1','$filename2','$filename3','$filename4','$filename5','$sellerid', '$productbrand', '$productcategory')";

        $run = mysqli_query($connect, $insertproduct);
        if($run){
          echo "<script>
          alert('Insert Successful');
          window.location.assign('productlist.php');
          </script>";
        }
        else{
          echo mysqli_error($connect);
        }


	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Sneaker | CultureX </title>

    <style type="text/css">

        li a
        {
         font-size: 18px;
         color: #e7ab3c;
         opacity: 100%;
        }

        li a:hover
        {
         color: black;
        }

        .navbar-brand
        {
            font-size: 30px;
            color: black;
            font-weight: bold;
        }

        .navbar-brand span
        {
            color: #e39d1c;
        }

    </style>

</head>

<body>
    <!-- Register Section Begin --><br><br>
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form"><br>
                        <h2 class="header-line">Add Product</h2>

                        <form action="addproduct.php" method="POST" enctype="multipart/form-data">

                            <div class="group-input">
                                <label for="productname">Enter Sneaker Name</label>
                                <input type="text" id="productname" name="txtproductname" required style="margin-left: 0px;">
                            </div>

                            <!-- Multiple Image upload -->
                            <div class="group-input">

                                <label for="productquantity">
                                    Sneaker Image (*Please provide 5 images of your sneaker*)
                                </label>

                                    <div class="row-up">

                                        <div class="col-20-up">
                                            <img id="output1" width="80" height="80" style="cursor: pointer;" src="themes/img/upload2.webp">
                                            <input type="file"  required accept="image/*" name="txtimage1" id="file1"  onchange="loadFile1(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;">
                                        </div>

                                        <div class="col-20-up">
                                            <img id="output2" width="80" height="80" style="cursor: pointer;" src="themes/img/upload2.webp">
                                            <input type="file"  required accept="image/*" name="txtimage2" id="file2"  onchange="loadFile2(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;">
                                        </div>

                                            <div class="col-20-up">
                                                <img id="output3" width="80" height="80" style="cursor: pointer;" src="themes/img/upload2.webp">
                                                <input type="file"  required accept="image/*" name="txtimage3" id="file3"  onchange="loadFile3(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;">
                                            </div>

                                        <div class="col-20-up">
                                            <img id="output4" width="80" height="80" style="cursor:
                                             pointer;" src="themes/img/upload2.webp">
                                            <input type="file"  required accept="image/*" name="txtimage4" id="file4"  onchange="loadFile4(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;">
                                        </div>

                                        <div class="col-20-up">
                                            <img id="output5" width="80" height="80" style="cursor:
                                             pointer;" src="themes/img/upload2.webp">
                                            <input type="file"  required accept="image/*" name="txtimage5" id="file5"  onchange="loadFile5(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;">
                                        </div>
                                    </div>
                            </div>

                            <div class="row group-input">

                                <div class="input-field col s6">
                                    <label for="Category">Choose Category</label>
                                    <select name="txtcategory">
                                    <?php

                                        $selectcategory = "SELECT * FROM category";
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
                                    <label for="Brand">Choose Brand</label>
                                    <select name="txtbrand">
                                    <?php

                                        $selectbrand = "SELECT * FROM  brand";
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
                                <label for="productprice">Select footwear type</label>
                                <select name="txtsubcategory">
                                    <option value='Men'>For Men</option>
                                    <option value='Women'>For Women</option>
                                    <option value='Sport'>Sport Wear</option>
                                </select>
                            </div>

                            <div class="group-input">
                                <label for="productprice">Enter Price In US$</label>
                                <input type="number" id="productprice" name="txtproductprice" required>
                            </div>

                            <div class="group-input">
                                <label for="productquantity">Enter Instock Quantity</label>
                                <input type="number" id="productquantity" name="txtproductquantity" required>
                            </div>

                            <div class="group-input">
                                <label for="productdescription">Enter Additional Information</label>
                                <textarea id="productdescription"  name="txtdesc" required></textarea>
                            </div>

                            <button type="submit" class="site-btn register-btn" name="btn-upload-product">Upload Now</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    <!-- footer component -->
    <?php include('components/footer.php'); ?>

 <!-- text Editor Link  -->


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
</body>

</html>
