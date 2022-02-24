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

	if(isset($_POST['btn-upload-auction']))
	{
        // Get ID form email, and name
        $selleremail        = $_SESSION['myemail'];
        $sellerid           = GET_ATTRIBUTE('user', 'userEmail', $selleremail, 'userID');
        $auctionid          = GET_ID('auction', 'auctionID');
        $enddate            = $_POST['txtenddate'];
        $endtime            = $_POST['txtendtime'];
        $reserve            = $_POST['txtreserveprice'];
        $headshot           = $_POST['txtheadshotp'];
        $increment          = $_POST['txtincrement'];
        $sneaker            = $_POST['txtsneaker'];
        $curinstock         = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneaker, 'inStock');
        $leftinstock        = $curinstock - 1;

        $insertauction = "INSERT INTO `auction`
        VALUES ('$auctionid','$enddate', '$endtime', '$reserve', '$headshot', '$increment', '$reserve', NULL, '$sneaker', 'Active') ";

        $reduce = "UPDATE sneaker 
                    SET inStock = '$leftinstock'
                    WHERE sneakerID = '$sneaker' "; 
        $runreduce = mysqli_query($connect, $reduce);

        $runauction = mysqli_query($connect, $insertauction);
        if($runauction){
          echo "<script>
          alert('Your auction is started !');
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
                        <h2 class="header-line">Add Auction</h2>

                        <form action="addauction.php" method="POST">

                            <div class="group-input">
                                <label for="productprice">Select your sneakers to Auction <span class="text-danger">*</span></label>
                                <select name="txtsneaker">
                                    <?php 
                                        // Get ID form email, and name
                                        $selleremail = $_SESSION['myemail'];
                                        $sellerid = GET_ATTRIBUTE('user', 'userEmail', $selleremail, 'userID');
                                        $sneakerselect = "SELECT * FROM sneaker 
                                                          WHERE sellerID = '$sellerid'
                                                          AND inStock>0 ";
                                        $runsneaker = mysqli_query($connect, $sneakerselect);
                                        $countsneaker = mysqli_num_rows($runsneaker);
                                        for ($i=0;$i<$countsneaker;$i++)
                                        {
                                            $rowsneaker   = mysqli_fetch_array($runsneaker);
                                            $sneakerid    = $rowsneaker['sneakerID'];
                                            $sneakername  = $rowsneaker['sneakerName'];
                                            echo "<option value='$sneakerid'>$sneakername</option>";
                                        }

                                     ?>
                                    
                                </select>
                            </div>

                            <div class="row group-input">

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="enddate">Enter End Date for Auction</label>
                                        <input type="date" id="enddate" name="txtenddate"  required style="margin-left: -2px;">
                                    </div>                                              
                                </div>

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="endtime">Enter End Time for Auction</label>
                                        <input type="time" id="endtime" name="txtendtime" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row group-input">

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="reservep">Enter Reserve Price</label>
                                        <input type="number" id="reservep" name="txtreserveprice"  required >
                                    </div>                                              
                                </div>

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="headshotp">Enter Headshot Price</label>
                                        <input type="number" id="headshotp" name="txtheadshotp" required>
                                    </div>
                                </div>

                            </div>

                            <div class="group-input">
                                <label for="increment">Enter Minimum increment for Auction</label>
                                <input type="number" id="increment" name="txtincrement"  required>
                            </div>  

                            <button type="submit" class="site-btn register-btn" name="btn-upload-auction">Upload Now</button>

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
