<?php 

	session_start();	
	$connect = mysqli_connect("localhost", "root", "", "CultureXdb");
	include('scripts/functions.php');

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
		$phone     = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'receiverPhone');


		$buyerid   = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'buyerID');
		$buyer     = GET_ATTRIBUTE('user', 'userID', $buyerid, 'userName');
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
 	      
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

	<!-- Favicon -->
    <link rel="icon" href="themes/img/culturexLogo_trans.png">

    <!-- Css Styles --> 
    <link rel="stylesheet" href="themes/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="themes/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="themes/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/nice-select.css" type="text/css">   
    <link rel="stylesheet" href="themes/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/style.css" type="text/css">	
</head>
<body>
	<div class="container">
<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-0">
					<div class="invoice-container">
						<div class="invoice-header">
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="custom-actions-btns mb-5">
										<a href="#" class="btn btn-primary" onclick="history.back()">
											<i class="fas fa-arrow-left"> </i> Back
										</a>
										<a href="javascript:;" onclick="window.print()" class="btn btn-secondary">
											<i class="fas fa-print"> </i> Print
										</a>
									</div>
								</div>
							</div>
							<!-- Row end -->
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
									<div class="invoice-details">
										<address>
											<?php echo "$buyer"; ?><br>
											<?php echo "$address"; ?><br>
											Contact : <?php echo "$phone"; ?>
										</address>
									</div>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
									<div class="invoice-details">
										<div class="invoice-num">
											<div>OrderID - <b>#<?php echo "$orderid"; ?></b></div>
											<div>Purchase On - <b><?php echo "$date"; ?></b></div>
											<div>Purchase with - <b><?php echo "$card"; ?></b></div>
										</div>
									</div>													
								</div>
							</div>
							<!-- Row end -->
						</div>
						<div class="invoice-body">
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="table-responsive">
										<table class="table custom-table m-0">
											<thead>
												<tr>
													<th>Sneaker</th>
													<th>Price</th>
													<th>Quantity</th>
													<th>Sub Total</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$subtotal = 0;
													$select = "SELECT * FROM purchasesneaker WHERE purchaseID = '$orderid' ";
									                $run    = mysqli_query($connect, $select);
													$count  = mysqli_num_rows($run);

													for ($i=0;$i<$count;$i++)
													{

														$row     = mysqli_fetch_array($run);
														$pid     = $row['sneakerID'];
									                    $sneaker = GET_ATTRIBUTE('sneaker', 'sneakerID', $pid, 'sneakerName');
									                    $price   = GET_ATTRIBUTE('sneaker', 'sneakerID', $pid, 'sneakerPrice');

									                    $brandid   = GET_ATTRIBUTE('sneaker', 'sneakerID', $pid, 'brandID');
									                    $brand   = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');

									                    $categoryid   = GET_ATTRIBUTE('sneaker', 'sneakerID', $pid, 'categoryID');
									                    $category   = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');


								                        $qty     = $row['sneakerQuantity'];
								                        $total   = $qty*$price;

												?>
												<tr>
													<td>
														<?php echo "$sneaker"; ?>
														<p class="m-0 text-muted">
															<?php echo "$brand | $category"; ?>
														</p>
													</td>
													<td>$ <?php echo "$price"; ?></td>
													<td><?php echo "x $qty"; ?></td>
													<td>$<?php echo "$total"; ?>.00</td>
												</tr>
 
												<?php  $subtotal = $subtotal + $total; } ?>
												
												<tr>
													<td>&nbsp;</td>
													<td colspan="2">
														<p>
															Delivery fee<br>
															Service Charges<br>
														</p>
														<h5 class="text-success"><strong>Grand Total</strong></h5>
													</td>			
													<td>
														<p>
															$5.00<br>
															$1.00<br>
														</p>
														<h5 class="text-success"><strong>$<?php echo "$subtotal" + 6 ?>.00</strong></h5>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Row end -->
						</div>
						<div class="invoice-footer"><br>
							<h5>Thank you for Shopping with us</h5><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<style type="text/css">
	body{margin-top:20px;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
}
.invoice-container {
    padding: 1rem;
}
.invoice-container .invoice-header .invoice-logo {
    margin: 0.8rem 0 0 0;
    display: inline-block;
    font-size: 1.6rem;
    font-weight: 700;
    color: #2e323c;
}
.invoice-container .invoice-header .invoice-logo img {
    max-width: 130px;
}
.invoice-container .invoice-header address {
    font-size: 15px;
    color: black;
    font-weight: bold;
    margin: 0;
}
.invoice-container .invoice-details {
    margin: 1rem 0 0 0;
    padding: 1rem;
    line-height: 180%;
    background: #f5f6fa;
}
.invoice-container .invoice-details .invoice-num {
    text-align: right;
    font-size: 15px;
}
.invoice-container .invoice-body {
    padding: 1rem 0 0 0;
}
.invoice-container .invoice-footer {
    text-align: center;
    font-size: 0.7rem;
    margin: 5px 0 0 0;
}

.invoice-status {
    text-align: center;
    padding: 1rem;
    background: #ffffff;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    margin-bottom: 1rem;
}
.invoice-status h2.status {
    margin: 0 0 0.8rem 0;
}
.invoice-status h5.status-title {
    margin: 0 0 0.8rem 0;
    color: #9fa8b9;
}
.invoice-status p.status-type {
    margin: 0.5rem 0 0 0;
    padding: 0;
    line-height: 150%;
}
.invoice-status i {
    font-size: 1.5rem;
    margin: 0 0 1rem 0;
    display: inline-block;
    padding: 1rem;
    background: #f5f6fa;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}
.invoice-status .badge {
    text-transform: uppercase;
}

@media (max-width: 767px) {
    .invoice-container {
        padding: 1rem;
    }
}

.custom-table {
    border: 1px solid #e0e3ec;
}
.custom-table thead {
    background: #e7ab3c;
}
.custom-table thead th {
    border: 0;
    color: #ffffff;
}
.custom-table > tbody tr:hover {
    background: #fafafa;
}
.custom-table > tbody tr:nth-of-type(even) {
    background-color: #ffffff;
}
.custom-table > tbody td {
    border: 1px solid #e6e9f0;
}


.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}

.text-success {
    color: #00bb42 !important;
}

.text-muted {
    color: #9fa8b9 !important;
}

.custom-actions-btns {
    margin: auto;
    display: flex;
    justify-content: flex-end;
}

.custom-actions-btns .btn {
    margin: .3rem 0 .3rem .3rem;
}
</style>
</html>