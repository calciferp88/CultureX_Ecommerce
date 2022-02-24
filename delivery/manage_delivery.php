<?php 

	include('delivery_adminheader.php');

	// if orderid is not get
    if (!isset($_GET['manage'])) 
    {
       echo "<script>
               window.location.assign('delivery_adminhome.php');
            </script>";
    }

	$phoneexists = "";
	$emailexists = "";
	$chkemailstaff = ""; 
	$chkemaildisplay = ""; 
	$chkeconpassword = "";

	// retrieve order details
	if (isset($_GET['manage'])&&isset($_GET['orderid'])) {
		
		$orderid   = $_GET['orderid'];
		$orderdate = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'purchaseDate');	
		$postal    = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'postalCode');	
		$address   = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'fullAddress');	
	}


	// on submit
	if (isset($_POST['btn-submit']))
	{	
		$deliveryid      = GET_ID('delivery', 'deliveryID');
    $deliveryman     = $_POST['txtdeliveryman'];
    $deliverydate    = $_POST['txtarrivaldate'];
    $purchaseid      = $_POST['txtorderid'];
    
    // insert into delivery 
    $insertdeli = "INSERT INTO `delivery` 
                   VALUES ('$deliveryid','$purchaseid', '$deliverydate', '$deliveryman')";
    $run = mysqli_query($connect, $insertdeli); 

    // update delivery status
    $updateorder = "UPDATE purchase 
                    SET purchaseStatus = 'Delivering' " ; 
    $runupdate = mysqli_query($connect, $updateorder);

    // update delivery staff status
    $updatestaff    = "UPDATE deliverystaff 
                       SET status = 'Assigned' 
                       WHERE deliveryStaffID = '$deliveryman' "; 
    $runupdatestaff = mysqli_query($connect, $updatestaff);  

    if($runupdatestaff)  
    {  
      echo "<script>
        alert('Delivery is Assigned ! ');
        window.location.assign('delivery_adminhome.php');   
        </script>";  
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
  <title>Manage Delivery | CultureX Delivery</title>
</head>

<body>
  <div id="page-wrapper"><br><br>

    <div class="header">
      <h1 class="page-header">
        Manage Delivery
      </h1>
      <ol class="breadcrumb">
        <li><a href="delivery_adminhome">Home</a></li>
        <li>Manage Delivery</li>
      </ol>

    </div>

    <div id="page-inner">

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-action">
              <p>Order ID : #<?php echo "$orderid"; ?></p>
              <p>Order Date : <?php echo "$orderdate"; ?></p>
              <p>Postal Code : <?php echo "$postal"; ?></p>
              <p>Full Address : <?php echo "address"; ?></p>
            </div>
          </div>

        </div>
      </div>
      <!-- detail section end -->

      <!-- Input form -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <form class="col s12" action="manage_delivery.php?manage&&orderid=<?php echo($orderid) ?>" method="POST">
              <div class="card-content">

                <div class="row">

                  <div class="input-field col s12">
                    <label for="password">Select Delivery Staff</label><br><br>
                    <select style="display: block; border: 1px solid #b3b3b3; height: 40px;" name="txtdeliveryman">
                      <?php
                                $selectitem = "SELECT * FROM deliverystaff 
                                				WHERE deliveryStaffRole = 'Delivery Man' 
                                				AND status = 'free'";
                                $runitem    = mysqli_query($connect, $selectitem);
                                $countitem  = mysqli_num_rows($runitem);
 
                                for ($lop=0;$lop<$countitem;$lop++)
                                {
                                    $rowitem    = mysqli_fetch_array($runitem);
                                    $staffid    = $rowitem['deliveryStaffID'];
									$staff      = GET_ATTRIBUTE('deliveryStaff', 'deliveryStaffID', $staffid, 'deliverystaffName');	
									echo "<option value='$staffid'>$staff</option>";	
                                }
                            ?>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                  <label for="date">Set Arrival Date</label><br><br>
                    <input id="date" type="date" class="validate" name="txtarrivaldate" required min="<?= date('Y-m-d'); ?>">

                  </div>
                </div>

                <input type="hidden" name="txtorderid" value="<?php echo($orderid) ?>">

                <button type="submit" style="padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;" name="btn-submit">
                 	Confirm
                </button>

            </form>
            <div class="clearBoth"></div>
          </div>

        </div>
      </div>
    </div>

    <footer>
      <p>Copyright 2022 &copy; CultureX all rights reserved.
    </footer>
  </div>
  <!-- /. PAGE INNER  -->

  </div>
  <!-- /. PAGE WRAPPER  -->
</body>

</html>