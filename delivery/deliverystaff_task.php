<?php

	include('delivery_adminheader.php');

    if ($delistaffrole != 'Delivery Man')
   {
       echo "<script>
                window.location.assign('delivery_adminhome.php');
           </script>";
   }

   if (isset($_GET['complete'])) {

        $orderid = $_GET['orderid'];

        $updateorder = "UPDATE `purchase`
                       SET purchaseStatus = 'Completed' 
                       WHERE purchaseID = '$orderid' ";

        $updatestaff = "UPDATE `deliverystaff`
                       SET status = 'Free' 
                       WHERE deliveryStaffID = '$myid' ";

        $runupdate  = mysqli_query($connect, $updateorder);
        $runupdate2 = mysqli_query($connect, $updatestaff);

        if ($runupdate2) 
        {
           echo "<script>
               alert('Delivery Completed ! ');
               window.location.assign('deliverystaff_task.php');
               </script>";
        }

   }

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Delivery | Quick.com</title>
    <style type="text/css">
        .viewform{
            padding: 30px;
        }

        .viewform p{
            font-size: 20px;
        }

        .viewform p span{
            font-weight: bold;
            color: #e7ab3c;
        }

        .btn-link{
            background-color: #e7ab3c;
            padding:15px;
            margin-top: 30px;
            color: white;
            font-size: 17px;
        }

        .btn-link:hover{
            background-color: #c78d22;
            padding:15px;
            text-decoration:none;
            color: white;
        }
    </style>
</head>
<body>
		<div id="page-wrapper">

		 	<div class="header">

                <h1 class="page-header">
                    Orders to deliver
                </h1>

			</div>

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                        <div class="card-action">
                          <b>Your Tasks</b>
                        </div>
                        <div class="card-image">
                          <ul class="collection">

                            <?php 

                                // select staff's tasks 
                                $delivery = "SELECT * 
                                             FROM delivery d, purchase p
                                             WHERE p.purchaseStatus = 'Delivering' 
                                             AND p.purchaseID = d.purchaseID
                                             AND d.deliveryStaffID = '$myid' ";

                                $rundelivery   = mysqli_query($connect, $delivery);
                                $countdelivery = mysqli_num_rows($rundelivery);
                                for ($i=0; $i < $countdelivery; $i++) { 

                                $rowdelivery   = mysqli_fetch_array($rundelivery);
                                $deliveryid    = $rowdelivery['deliveryID'];
                                $arrival       = $rowdelivery['arrivalDate'];

                                $orderid = GET_ATTRIBUTE('delivery', 'deliveryID', $deliveryid, 'purchaseID');
                                $receiver = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'receiverName');
                                $receiveremail = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'receiverEmail');
                                $receiverphone = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'receiverPhone');
                                $postal = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'postalCode');
                                $city = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'city');
                                $address = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'fullAddress');
                             ?>
                                <div class="viewform">
                                    
                                    <p> <span>Arrival Date</span> : <?php echo "$arrival"; ?> </p>
                                    <p> <span>Receiver Name</span> : <?php echo "$receiver"; ?> </p>
                                    <p> <span>Receiver Email</span> : <?php echo "$receiveremail"; ?> </p>
                                    <p> <span>Receiver Phone</span> : <?php echo "$receiverphone"; ?> </p>
                                    <p> <span>Postal Code</span> : <?php echo "$postal"; ?> </p>
                                    <p> <span>City</span> : <?php echo "$city"; ?> </p>
                                    <p> <span>Full Address</span> : <?php echo "$address"; ?> </p><br><br>

                                    <a href="deliverystaff_task.php?complete&&orderid=<?php echo($orderid) ?>" class="btn-link">
                                        Complete Order
                                    </a>

                                </div>
                            <?php } ?>

                          </ul>
                          <?php if ($countdelivery == 0)
                         {
                            echo "<p><center style='color:red; font-size:20px;'>*You don't have any delivery assigned*</center></p>";
                        } ?><br>
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
