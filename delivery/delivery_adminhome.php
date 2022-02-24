<?php

	include('delivery_adminheader.php');

    if ($delistaffrole != 'Admin')
   {
       echo "<script>
           window.location.assign('deliverystaff_task.php');
           </script>";
   }

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard | Quick.com</title>
</head>
<body>
		<div id="page-wrapper">
		 	<div class="header">
                <h1 class="page-header">
                    Pending Delivery
                </h1>
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li>Dashboard</li>
				</ol>

			</div>
        <div id="page-inner">

        	 <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="card">
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Items</th>
                                            <th>City</th>
                                            <th>Postal Code</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $selectorder = "SELECT * FROM purchase WHERE purchaseStatus = 'Pending Delivery' ";
                                        $runorder    = mysqli_query($connect, $selectorder);
                                        $countorder  = mysqli_num_rows($runorder);

                                        for ($d=0;$d<$countorder;$d++)
                                        {
                                            $roworder    = mysqli_fetch_array($runorder);
                                            $orderid     = $roworder['purchaseID'];
                                            $city        = $roworder['city'];
                                            $postal      = $roworder['postalCode'];
                                            $address     = $roworder['fullAddress'];
                                    ?>

                                        <tr class='odd gradeX'>
                                            <td><?php echo "#$orderid"; ?></td>
                                            <td>
                                            	<?php
			                                        $selectitem = "SELECT * FROM purchasesneaker 
			                                        				WHERE purchaseID = '$orderid' ";
			                                        $runitem    = mysqli_query($connect, $selectitem);
			                                        $countitem  = mysqli_num_rows($runitem);

			                                        for ($i=0;$i<$countitem;$i++)
			                                        {
			                                            $rowitem    = mysqli_fetch_array($runitem);
			                                            $snid       = $rowitem['sneakerID'];
      													$sneaker    = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sneakerName');	
      													echo "<p>$sneaker</p>";	
			                                        }
			                                    ?>
                                            </td>
                                            <td><?php echo "$city"; ?></td>
                                            <td><?php echo "$postal"; ?></td>
                                            <td><?php echo "$address"; ?></td>
                                            <td>
                                                <a href='manage_delivery.php?manage&&orderid=<?php echo($orderid) ?>' class='list-edit'>
                                                	Manage
                                                </a>
                                            </td>
                                        </tr>

                                    
                                    <?php
                                        }
                                    ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
