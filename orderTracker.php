<?php 

	include('components/header.php');

	if (!isset($_SESSION['myemail'])) 
	{
		echo "<script>	
		alert('Please Login First ');
		window.location.assign('login.php');	
		</script>";  
	}

	$subtotal     = 0;

	$myemail = $_SESSION['myemail'];
	$myid = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');

	if (!isset($_GET['orderid']))   
	{	
		echo "<script>	
		window.location.assign('home.php');	
		</script>";  
	}

	else{
		$orderid   = $_GET['orderid'];
		$date      = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'purchaseDate');
		$total     = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'totalPrice');
		$card      = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'cardType');
		$address   = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'fullAddress');
		$status    = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'purchaseStatus');
	}

 ?>

 <!DOCTYPE html>	
 <html>	
 <head>
 	<title>Profile | PimShop</title>	
 </head> 
 <style type="text/css">
 	.widget-head{
 		font-size: 20px;
 		font-weight: bold;
 	}

 	.status-div{
 		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 30%;
		padding-top: 20px;
 	}

 	.widget-desc{
 		text-align: center;
 		font-size: 18px;
 	}

 	.widget-desc span{
 		color: #e69500;
 		font-weight: bold;
 		font-size: 20px;
 	}

 	.display-div .btn-link{
 		margin: 0px auto;
 	}

 	.receipt-div h4{
 		font-size: 18px;
 		font-weight: bold;
 		padding: 10px;
 	}

 	.receipt-div h4 span{
 		padding-left: 20px;
 		font-weight: lighter;
 	}

 	
 </style>
 <body>
 	
 	<!-- Register Section Begin --><br><br>   
    <div class="register-login-section spad"> 

            <div class="rowp">

                <div class="col-50 display-div"><br><br>


                	<?php 

                		// Pending for seller acception 
                		if($status == "Pending") 
                		{
                			echo "
                				<center>
				                    <img class='status-div' src='themes/gif/orderpending.gif'>
				                    <p class='widget-desc'>Waiting for <span>Seller's Approval</span></p><br>
				                    <a href='receipt.php?orderid=$orderid' class='btn-link'>View Receipt</a>
			                    </center>
                			";
                		}

                		// Pending delivery arrangement 
                		else if($status == "Pending Delivery"){
                			echo "
                			<center>
			                    <img class='status-div' src='themes/gif/handed.gif' style='width: 300px;'>
			                    <p class='widget-desc'>Your order is handed to <span>Delivery Service</span></p>
			                    <p class='widget-desc'>Delivery staff will be <span>Contact you</span> soon</p><br>
			                    <a href='receipt.php?orderid=$orderid' class='btn-link'>View Receipt</a>
                    		</center>
                			";
                		}

                		// delivering items
                		else if($status == "Delivering"){
                			echo "
                				<center>
				                    <img class='status-div' src='themes/gif/delivering2.gif'><br>
				                    <p class='widget-desc'>Delivering <span>your items</span></p>
				                    <p class='widget-desc'>Please be ready to <span>Pick Up</span></p><br>
				                    <a href='receipt.php?orderid=$orderid' class='btn-link'>View Receipt</a>
			                    </center>
                			";
                		}

                		// order completed
                		else if($status == "Completed"){
                			echo "
                				<center>
				                    <img class='status-div' src='themes/gif/complete.gif'><br>
				                    <p class='widget-desc'>Your order is<span> Completed</span></p>
				                    <p class='widget-desc'><span>Enjoy your items</span></p><br>
				                    <a href='receipt.php?orderid=$orderid' class='btn-link'>View Receipt</a>
			                    </center>
                			";
                		}


                	 ?>

                </div>

           	<div class="col-50 display-div receipt-div">		

	            <label class="widget-head"> Order Details |</label> 
	            <h4>Order ID : <span>#<?php echo "$orderid"; ?></span></h4>
	            <h4>Date : <span><?php echo "$date"; ?></span></h4>
	            <h4>Purchase with : <span><?php echo "$card"; ?></span></h4>
	            <h4>Deliver to : <span><?php echo "$address"; ?></span></h4>
	            <hr>

	            <!-- table -->
	            <div style="height: 200px; overflow-y: auto;">

		            <table>
							

			            <?php 

				                $select = "SELECT * FROM purchasesneaker WHERE purchaseID = '$orderid' ";
				                $run    = mysqli_query($connect, $select);
								$count  = mysqli_num_rows($run);

								for ($i=0;$i<$count;$i++)
								{

									$row     = mysqli_fetch_array($run);
									$pid     = $row['sneakerID'];
				                    $sneaker = GET_ATTRIBUTE('sneaker', 'sneakerID', $pid, 'sneakerName');
				                    $price   = GET_ATTRIBUTE('sneaker', 'sneakerID', $pid, 'sneakerPrice');
			                        $qty     = $row['sneakerQuantity'];
			                        $total   = $qty*$price;
			             ?> 

			                <tr >
			                	<td width="50%"><?php echo "$sneaker"; ?></td>
			                	<td width="20%">x <?php echo "$qty"; ?></td>
			                	<td width="30%"><b><span><?php echo "$total"; ?></span>.00</b> USD</td>
			                </tr>
			            <?php 

			            $subtotal = $subtotal + $total;

						}  ?>

			                <tr >
			                	<td style="border-bottom: none;"><span><b>Total</b></span></td>
			                	<td style="border-bottom: none;"></td>
			                	<td style="border-bottom: none;"> <span><b><?php echo "$subtotal" + 6; ?></b>.00 USD</span>
			                </tr>
					</table>

				</div>
	            
           	</div>
        </div>  
    </div>			
        <!-- footer component -->
    <?php include('components/footer.php'); ?>	

    <!-- Register Form Section End -->
 </body>	
 </html>		 



 </script>