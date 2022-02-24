<?php 

	include('components/header.php');

	if (!isset($_SESSION['myemail'])) 
	{
		echo "<script>	
		alert('Please Login First ');
		window.location.assign('login.php');	
		</script>";  
	}

	$totalsneaker = 0;
	$totalsale    = 0;
	$totalincome  = 0;
	$totalincomeo = 0;
	$myemail     = $_SESSION['myemail'];
	$myid        = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');
	$myname      = GET_ATTRIBUTE('user', 'userID', $myid, 'userName');
	$thismonth   = DATE('m');
	$thisyear    = DATE('Y');

	// total sneaker available
	$sneaker = "SELECT * FROM sneaker
				WHERE sellerID = '$myid' ";

	$runsneaker    = mysqli_query($connect, $sneaker);
	$countsneaker  = mysqli_num_rows($runsneaker);   
    for ($i=0; $i < $countsneaker; $i++) 
    { 
	    $rowsneaker   = mysqli_fetch_array($runsneaker);
	    $instock      = $rowsneaker['inStock']; 

	    $totalsneaker =$totalsneaker + ($instock);

	}

	// total sale by seller
	$sale = "SELECT * FROM sneaker
			WHERE sellerID = '$myid' ";

	$runsale    = mysqli_query($connect, $sale);
	$countsale  = mysqli_num_rows($runsale);   
    for ($i=0; $i < $countsale; $i++) 
    { 
	    $rowsale   = mysqli_fetch_array($runsale);
	    $sale      = $rowsale['totalSale']; 

	    $totalsale = $totalsale + $sale;

	}

	// total income of seller this month
	$income = "SELECT * FROM purchase
			WHERE sellerID = '$myid'
			AND purchaseMonth = '$thismonth'
			AND purchaseYear = '$thisyear' ";

	$runincome    = mysqli_query($connect, $income );
	$countincome  = mysqli_num_rows($runincome);   
    for ($i=0; $i < $countincome; $i++) 
    { 
	    $rowincome   = mysqli_fetch_array($runincome);
	    $income      = $rowincome['totalPrice']; 

	    $totalincome = $totalincome + $income - 6;

	}

	// total income of seller overall
	$incomeo = "SELECT * FROM purchase
				WHERE sellerID = '$myid'";

	$runincomeo    = mysqli_query($connect, $incomeo );
	$countincomeo  = mysqli_num_rows($runincomeo);   
    for ($i=0; $i < $countincomeo; $i++) 
    { 
	    $rowincomeo   = mysqli_fetch_array($runincomeo);
	    $incomeo      = $rowincomeo['totalPrice']; 

	    $totalincomeo = $totalincomeo + $incomeo - 6;

	}


	// deliver Item
	if (isset($_GET['confirm'])) {
		
		$purchaseid = $_GET['orderid'];
		$updatepurchase = "UPDATE `purchase` 
						   SET purchaseStatus = 'Pending Delivery'
						   WHERE purchaseID = '$purchaseid' ";
		$runupdate = mysqli_query($connect, $updatepurchase);
		if ($runupdate) 
		{
			echo "<script>	
			window.location.assign('sellerDashboard.php');	
			</script>";  
		}
	}

 ?>

 <!DOCTYPE html>	
 <html>	
 <head>
 <title>Seller Dashboard | CultureX</title>	
 
 </head>
 <body>

 	
 	<!-- Main Section --><br><br>
    <div class="register-login-section spad">

    	<div class="row-dash">
				
			<div class="col-25">
				<label>Total sneakers available</label><br>
				<p><span><?php echo "$totalsneaker"; ?></span> Items</p>
			</div>

			<div class="col-25">
				<label>Total sales on CultureX</label><br>		
				<p><span><?php echo "$totalsale"; ?></span> Sales</p>
			</div>

			<div class="col-25">
				<label>This Month Income</label><br>		
				<p><span><?php echo "$totalincome"; ?></span> USD</p>
			</div>

			<div class="col-25">
				<label>Overall Income</label><br>		
				<p><span><?php echo "$totalincome"; ?></span> USD</p>
			</div>

		</div>
        
        <div class="rowp">

            <div class="col-100 display-div2">

                <h4>Pending Orders</h4>
                <center><p>Please make sure that you have <b>handed items to delivery</b> before confriming</p></center>

                <table>
				 	<tr>
					    <th><p><b>Order ID</b></p></th>	
					    <th><p><b>Total Amount</b></p></th>
					    <th><p><b>Paid with</b></p></th>
					    <th><p><b>Items</b></p></th>
					    <th></th>
				  	</tr>
				   	
				   	<!-- retrieve orders made by loggined user -->
				   	<?php 

				   		$selectorder = "SELECT p.purchaseID
				   						FROM purchase p, user u
									  	WHERE p.sellerID = u.userID
									  	AND p.purchaseStatus = 'Pending'
									  	AND p.sellerID = '$myid'";
                        $runorder = mysqli_query($connect, $selectorder);
                        $countorder = mysqli_num_rows($runorder);

                        for ($mm=0; $mm < $countorder; $mm++)  
                        { 
	                        $roworder    = mysqli_fetch_array($runorder);
	                        $orderid     = $roworder['purchaseID'];  
	                        $orderdate   = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'purchaseDate');
	                        $total       = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'totalPrice');

				   	 ?>
				  	<tr>	 

					    <td><p>Order#<?php echo "$orderid"; ?></p></td>
					    <td><p><?php echo "$orderdate"; ?></p></td>	
					    <td><p><?php echo "$ $total"; ?>.00</p></td>	
					    <td >
					    	<!-- reterieve items in order -->
					    	<?php 
					    		$selectordersneaker = "SELECT * FROM purchasesneaker 
                                        WHERE purchaseID = '$orderid'";
		                        $runordersneaker = mysqli_query($connect, $selectordersneaker);
		                        $countordersneaker = mysqli_num_rows($runordersneaker);
		                        for ($i=0; $i < $countordersneaker; $i++) { 
		                        	$rowordersneaker    = mysqli_fetch_array($runordersneaker);
	                        		$sneakerid          = $rowordersneaker['sneakerID'];
	                      		    $sneaker            = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sneakerName');

		                        	echo "<p>$sneaker</p>";
		                        }

					    	 ?>
					    	
					    	
					    </td>
					    <td>
					    	<p>
					    		<a href="sellerDashboard.php?confirm&&orderid=<?php echo($orderid) ?>" class="btn-link">Confirm</a>
					    		<a href="orderTracker.php?orderid=<?php echo($orderid) ?>" class="btn-link">View Order</a>
					    	</p>
					    </td>
				  	</tr>

				    <?php } ?>

				</table>
				<?php 
				if ($countorder == 0) {
				    	echo "<center><p style='color:red; font-weight:bold;'>You have no Pending Orders</p></center>";
				    }


				 ?>
            </div> 
        </div> 

        <div class="rowp">

            <div class="col-100 display-div2">

                <h4>Completed Orders</h4>

                <table>
				 	<tr>
					    <th><p><b>Order ID</b></p></th>	
					    <th><p><b>Total Amount</b></p></th>
					    <th><p><b>Paid with</b></p></th>
					    <th><p><b>Items</b></p></th>
					    <th></th>
				  	</tr>
				   	
				   	<!-- retrieve orders made by loggined user -->
				   	<?php 

				   		$selectorderc = "SELECT p.purchaseID
				   						FROM purchase p, user u
									  	WHERE p.sellerID = u.userID
									  	AND p.purchaseStatus != 'Pending'
									  	AND p.sellerID = '$myid'";
                        $runorderc = mysqli_query($connect, $selectorderc);
                        $countorderc = mysqli_num_rows($runorderc);

                        for ($op=0; $op < $countorderc; $op++)  
                        { 
	                        $roworderc    = mysqli_fetch_array($runorderc);
	                        $orderidc     = $roworderc['purchaseID'];  
	                        $orderdatec   = GET_ATTRIBUTE('purchase', 'purchaseID', $orderidc, 'purchaseDate');
	                        $totalc       = GET_ATTRIBUTE('purchase', 'purchaseID', $orderidc, 'totalPrice');

				   	 ?>
				  	<tr>	 

					    <td><p>Order#<?php echo "$orderidc"; ?></p></td>
					    <td><p><?php echo "$orderdatec"; ?></p></td>	
					    <td><p><?php echo "$ $totalc"; ?>.00</p></td>	
					    <td >
					    	<!-- reterieve items in order -->
					    	<?php 
					    		$selectordersneakerc = "SELECT * FROM purchasesneaker 
                                        WHERE purchaseID = '$orderidc'";
		                        $runordersneakerc = mysqli_query($connect, $selectordersneakerc);
		                        $countordersneakerc = mysqli_num_rows($runordersneakerc);
		                        for ($os=0; $os < $countordersneakerc; $os++) { 
		                        	$rowordersneakerc    = mysqli_fetch_array($runordersneakerc);
	                        		$sneakeridc          = $rowordersneakerc['sneakerID'];
	                      		    $sneakerc            = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakeridc, 'sneakerName');

		                        	echo "<p>$sneakerc</p>";
		                        }

					    	 ?>
					    	
					    	
					    </td>
					    <td><p><a href="orderTracker.php?orderid=<?php echo($orderidc) ?>" class="btn-link">Track</a></p></td>
				  	</tr>

				    <?php } 

				    
				    ?>

				</table>
				<?php 
				if ($countorderc == 0) {
				    	echo "<center><p style='color:red; font-weight:bold;'>You have no completed orders</p></center>";
				    }


				 ?>
            </div> 
        </div> 


    </div>
        <!-- footer component -->
    <?php include('components/footer.php'); ?>
    <!-- Register Form Section End -->
 </body>	
 </html>		



 </script>