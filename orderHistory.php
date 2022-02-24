<?php 

	include('components/header.php');

	if (!isset($_SESSION['myemail'])) 
	{
		echo "<script>	
		alert('Please Login First ');
		window.location.assign('login.php');	
		</script>";  
	}

	$myemail = $_SESSION['myemail'];
	$myid    = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');
	$myname  = GET_ATTRIBUTE('user', 'userID', $myid, 'userName');

	$countordersneaker=0;

 ?>

 <!DOCTYPE html>	
 <html>	
 <head>
 <title>Profile | PimShop</title>	
 
 </head> 
 <body>
 	
 	<!-- Main Section --><br><br>
    <div class="register-login-section spad">
        
        <div class="rowp">

            <div class="col-100 display-div2">

                <h4><b><?php echo "$myname"; ?>'s</b> Order History</h4>

                <table>
				 	<tr>
					    <th><p><b>OrderID</b></p></th>	
					    <th><p><b>Order Date</b></p></th>
					    <th><p><b>Total Amount</b></p></th>
					    <th><p><b>Items</b></p></th>
					    <th></th>
				  	</tr>
				   	
				   	<!-- retrieve orders made by loggined user -->
				   	<?php 

				   		$selectorderc = "SELECT * FROM purchase 
                                        WHERE buyerID = '$myid'
                                        ORDER BY purchaseDate DESC";
                        $runorderc = mysqli_query($connect, $selectorderc);
                        $countorderc = mysqli_num_rows($runorderc);

                        for ($i=0; $i < $countorderc; $i++)  
                        { 
	                        $roworder    = mysqli_fetch_array($runorderc);
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
		                        for ($oh=0; $oh < $countordersneaker; $oh++) { 
		                        	$rowordersneaker    = mysqli_fetch_array($runordersneaker);
	                        		$sneakerid          = $rowordersneaker['sneakerID'];
	                      		    $sneaker            = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sneakerName');

		                        	echo "<p>$sneaker</p>";
		                        }

					    	 ?>
					    	
					    </td>
					    <td><p><a href="orderTracker.php?orderid=<?php echo($orderid) ?>" class="btn-link">Track</a></p></td>
				  	</tr>

				    <?php } ?>
				    <?php if ($countordersneaker==0): ?>
					<div class="alert alert-primary" role="alert" style="margin: 30px;">
			          You don't have orders done.
			        </div>
				<?php endif ?>
				</table>
				
	         	
            </div>
           
        </div> 

    </div>
        <!-- footer component -->
    <?php include('components/footer.php'); ?>

    <!-- Register Form Section End -->
 </body>	
 </html>		



 </script>