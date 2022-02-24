<?php

    include('components/header.php');

    $day1 = '';
    $day2 = '';
    $day3 = '';

	if(isset($_POST['btn-advertise']))
	{  
        // Get image file
        $adimage = $_FILES['txtadimage']['name'];
        $folder  = "ImagesUploaded/";
        if ($adimage)
        {
          $filename = $folder."_".$adimage;
          $copied   = copy($_FILES['txtadimage']['tmp_name'], $filename);

          if (!$copied)
          {
            exit("Problem Occured. Cannot upload image");
          }
        }

        $advertiseid = GET_ID('advertisement', 'advertisementID');
        $startdate   = $_POST['txtadstartdate'];
        $plan        = $_POST['txtplan'];
        $cardtype    = $_POST['txtcardtype'];
        $cardnumber  = $_POST['txtcardnumber'];

        // get my id
        $myemail = $_SESSION['myemail'];
        $myid    = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');

        // for income        
        $incomedate       = DATE('Y-m-d');
        $incomeday        = DATE('d');
        $incomemonth      = DATE('m');
        $incomeyear       = DATE('Y'); 
        $incomeid         = GET_ID('income', 'incomeID');

        if ($plan == '1') 
        {
            $amt = '20';
            $day1  = $startdate;
        }

        else if ($plan == '2') 
        {
            $amt = '35';
            $day1  = $startdate;
            $day2  = date('Y-m-d', strtotime($day1 .' +1 day'));
        }

        else if ($plan == '3') 
        {
            $amt = '50';
            $day1  = $startdate;
            $day2  = date('Y-m-d', strtotime($day1 .' +1 day'));
            $day3  = date('Y-m-d', strtotime($day2 .' +1 day'));
        }

        $selectad = "SELECT * FROM advertisement 
               WHERE day1 = '$startdate' 
               OR    day2 = '$startdate'
               OR    day3 = '$startdate'";

        $runad = mysqli_query($connect, $selectad);
        $countad = mysqli_num_rows($runad);

        if ($countad < 10) 
        {
            $insertads = "INSERT INTO advertisement
                        VALUES('$advertiseid', '$myid', '$filename', '$startdate', '$plan', '$day1', '$day2', '$day3')";
            $runads = mysqli_query($connect, $insertads);

            $insertincome = "INSERT INTO income 
                        VALUES('$incomeid', '$incomedate', '$incomeday', '$incomemonth', '$incomeyear', '$amt', '$cardtype', '$cardnumber', 'Advertising', '$myid')";
            $runincome = mysqli_query($connect, $insertincome);

            if ($runincome) {
               echo "<script>alert('Your Ads is submitted !');</script>
                    window.location.assign('home.php');";
            }else{echo mysqli_error($connect);}
        }
        else{
            echo "<script>alert('Advertisement Full. Please choose different date');</script>";
        }
	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Advertise | CultureX </title>

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
                        <h2 class="header-line"> Advertisement</h2>

                        <form action="advertise.php" method="POST" enctype="multipart/form-data">

                            <div class="group-input">
                                <h5>Choose an image for your advertisement<span class="text-danger">*</span></h5><br>
                                <img id="output1" width="80" height="80" style="cursor: pointer;" src="themes/img/upload2.webp">
                                <input type="file" required accept="image/*" name="txtadimage" id="file1"  onchange="loadFile1(event)" style="opacity:0;margin-left: -100px;z-index: -1; color: transparent;"> 
                            </div> 

                            <div class="row group-input">

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="enddate">Advertisement Start Date<span class="text-danger">*</span></label>
                                        <input type="date" min="<?= date('Y-m-d'); ?>" id="enddate" name="txtadstartdate" required style="margin-left: -2px;">
                                    </div>                                              
                                </div>

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="productprice">Advertisement Plan <span class="text-danger">*</span></label>
                                        <select name="txtplan">
                                            <option value='1'>1 Day for $20</option>
                                            <option value='2'>2 Days for $35</option>
                                            <option value='3'>3 Days for $50</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <h2 class="header-line"> Payment</h2>
                            <div class="group-input">
                                <label for="productprice">Card Type<span class="text-danger">*</span></label>
                                <select name="txtcardtype">
                                    <option value='Visa'>Visa</option>
                                    <option value='Discovery'>Discovery</option>
                                    <option value='Imax'>Imax</option>
                                </select>
                            </div>  

                            <div class="row group-input">

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="headshotp">Card Number</label>
                                        <input type="text" id="txtCardNumber" name="txtcardnumber" required>
                                    </div>
                                </div>

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="headshotp">Card Holder Name</label>
                                        <input type="text" id="headshotp" name="txtheadshotp" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row group-input">

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="headshotp">Expire Date</label>
                                        <input type="text" id="headshotp" name="txtheadshotp" required>
                                    </div>
                                </div>

                                <div class="input-field col s6">
                                    <div class="group-input">
                                        <label for="headshotp">CVV</label>
                                        <input type="text" id="headshotp" name="txtheadshotp" required>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="site-btn register-btn" name="btn-advertise">Confirm Advertisement</button>

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

<script type="text/javascript">
  var txtCardNumber = document.querySelector("#txtCardNumber");
  txtCardNumber.addEventListener("input", onChangeTxtCardNumber);

  function onChangeTxtCardNumber(e) {   
      var cardNumber = txtCardNumber.value;
   
      // Do not allow users to write invalid characters
      var formattedCardNumber = cardNumber.replace(/[^\d]/g, "");
      formattedCardNumber = formattedCardNumber.substring(0, 16);
    
      // Split the card number is groups of 4
      var cardNumberSections = formattedCardNumber.match(/\d{1,4}/g);
      if (cardNumberSections !== null) {
          formattedCardNumber = cardNumberSections.join(' '); 
      }
    
      console.log("'"+ cardNumber + "' to '" + formattedCardNumber + "'");
    
      // If the formmattedCardNumber is different to what is shown, change the value
      if (cardNumber !== formattedCardNumber) {
          txtCardNumber.value = formattedCardNumber;
      }
  }
</script>

</body>

</html>
