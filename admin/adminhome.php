<?php 

	include('adminheader.php');

	$thismonth   = DATE('m');
	$thisyear    = DATE('Y');
	$totalincome = 0;
	$totalitem   = 0;
	$totalseller = 0;

	// total income
	$selincome = "SELECT * FROM income
			   WHERE incomeMonth = '$thismonth'
			   AND incomeYear = '$thisyear' ";

	$runincome    = mysqli_query($connect, $selincome);
	$countincome  = mysqli_num_rows($runincome);   
    for ($i=0; $i < $countincome; $i++) 
    { 
	    $rowincome   = mysqli_fetch_array($runincome);
	    $income      = $rowincome['incomeAmount']; 

	    $totalincome = $totalincome + $income;
	}

	// total sale
	$selsale = "SELECT * FROM purchase
			    WHERE purchaseMonth = '$thismonth'
			    AND purchaseYear = '$thisyear' ";

	$runsale    = mysqli_query($connect, $selsale);
	$countsale  = mysqli_num_rows($runsale);   

	// total available items
	$selitem = "SELECT * FROM sneaker";
	$runitem    = mysqli_query($connect, $selitem);
	$countitem  = mysqli_num_rows($runitem);  
    for ($i=0; $i < $countitem; $i++) 
    { 
	    $rowitem   = mysqli_fetch_array($runitem);
	    $item      = $rowitem['inStock']; 

	    $totalitem = $totalitem + $item;
	}

	// total seller
	$selseller = "SELECT * FROM user
			   WHERE sellerStatus = 1";

	$runseller    = mysqli_query($connect, $selseller);
	$countseller  = mysqli_num_rows($runseller);   

  // Pie chart data 
  $selpie1 = "SELECT * FROM income
         WHERE incomeStatus = 'Seller Reg' ";
  $runpie1    = mysqli_query($connect, $selpie1);
  $countpie1  = mysqli_num_rows($runpie1);   

  $selpie2 = "SELECT * FROM income
         WHERE incomeStatus = 'Ordering' ";
  $runpie2    = mysqli_query($connect, $selpie2);
  $countpie2  = mysqli_num_rows($runpie2);   

  $selpie3 = "SELECT * FROM income
         WHERE incomeStatus = 'Advertisin' ";
  $runpie3    = mysqli_query($connect, $selpie3);
  $countpie3  = mysqli_num_rows($runpie3);   

   
 ?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard | CultureX Admin</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
  <div id="page-wrapper">
    <div class="header"><br><br> 
      <h1 class="page-header">
        Admin Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Dashboard</a></li>
      </ol>

    </div>
    <div id="page-inner">

      <div class="dashboard-cards">
        <div class="row">

          <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="card horizontal cardIcon waves-effect waves-dark">
              <div class="card-image red">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <div class="card-stacked red">
                <div class="card-content">
                  <h3>$ <?php echo "$totalincome"; ?>.00</h3>
                </div>
                <div class="card-action">
                  <strong>THIS MONTH PROFIT <br><br></strong>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="card horizontal cardIcon waves-effect waves-dark">
              <div class="card-image orange">
                <i class="material-icons dp48">shopping_cart</i>
              </div>
              <div class="card-stacked orange">
                <div class="card-content">
                  <h3><?php echo "$countsale"; ?></h3>
                </div>
                <div class="card-action"><br>
                  <strong>SALES THIS MONTH<br><br></strong>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="card horizontal cardIcon waves-effect waves-effect-dark">
              <div class="card-image blue">
                <i class="material-icons dp48">equalizer</i>
              </div>
              <div class="card-stacked blue">
                <div class="card-content">
                  <h3><?php echo "$totalitem"; ?></h3>
                </div>
                <div class="card-action">
                  <strong>AVAILABLE PRODUCTS <br></strong><br>

                </div>
              </div>
            </div>

          </div>
          <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="card horizontal cardIcon waves-effect waves-dark">
              <div class="card-image green">
                <i class="material-icons dp48">supervisor_account</i>
              </div>
              <div class="card-stacked green">
                <div class="card-content">
                  <h3><?php echo "$countseller"; ?></h3>
                </div>
                <div class="card-action">
                  <strong>SELLER REGISTERATIONS <br><br></strong>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>  

      <!-- chart -->
       <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-action">
              <b><center>CultureX Income Statistics</center></b>
            </div>
            <div class="card-image">             
              <center><canvas id="myChart" style="width:100%;max-width:600px"></canvas></center>
            </div><br><br>
          </div>

        </div>
      </div>
      <!-- Advertisement List -->
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-action">
              <b>Advertisement from Sellers</b>
            </div>
            <div class="card-image">
              <ul class="collection">

                <?php 

                  $getads = "SELECT * FROM advertisement ORDER BY startDate DESC";
                  $runads = mysqli_query($connect, $getads);
                  $countads = mysqli_num_rows($runads);
                  for ($ads=0; $ads < $countads ; $ads++) 
                  { 
                    $rowads   = mysqli_fetch_array($runads);
                    $adsid    = $rowads['advertisementID'];
                    $adsimg   = $rowads['advertiseImage'];
                    $adster   = $rowads['advertiserID'];
                    $start    = $rowads['startDate'];
                    $length   = $rowads['advertiseLength'];
                    $sellerid = GET_ATTRIBUTE('user', 'userID', $adster, 'userName');

                 ?>

                <!--  list start -->
                <li class="collection-item avatar">
                  <i class="material-icons circle green">track_changes</i>
                  <span class="title">Start from : <?php echo "$start"; ?></span>
                  <p>by <?php echo "$sellerid"; ?> <br>
                    duration : <?php echo "$length"; ?> Day(s)
                  </p>
                  <img src="../<?php echo($adsimg) ?>" style="width: 500px;">
                </li>
                <!-- list end -->

              <?php } ?>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Purchases List -->
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-action">
              <b>Recent Purchases</b>
            </div>
            <div class="card-image">
              <ul class="collection">

                <?php 

                  $getordery = "SELECT * FROM purchase ORDER BY purchaseID DESC";
                  $runordery = mysqli_query($connect, $getordery);
                  $countordery = mysqli_num_rows($runads);
                  for ($ordery=0; $ordery < $countordery ; $ordery++) 
                  { 
                    $rowordery   = mysqli_fetch_array($runordery);
                    $orderid     = $rowordery['purchaseID'];
                    $card        = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'cardType');
                    $total       = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'totalPrice');

                    $sellerid    = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'sellerID');
                    $seller      = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userName');

                    $buyerid    = GET_ATTRIBUTE('purchase', 'purchaseID', $orderid, 'buyerID');
                    $buyer      = GET_ATTRIBUTE('user', 'userID', $buyerid, 'userName');


                 ?>

                <!--  list start -->
                <li class="collection-item avatar">
                  <i class="material-icons circle green">track_changes</i>
                  <span class="title">Order#<?php echo "$orderid"; ?></span>
                  <p>purchase with <b><?php echo "$card"; ?></b> </p>
                  <p>Total : <b><?php echo "$ $total"; ?>.00</b> </p>
                  <p>Seller : <b><?php echo "$seller"; ?></b> </p>
                  <p>Buyer : <b><?php echo "$buyer"; ?> </p></b><br>
                  <a href="../receipt.php?orderid=<?php echo($orderid) ?>" class="btn btn-primary">View Receipt</a>
                </li>
                <!-- list end -->

              <?php } ?>
              </ul>
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

<script>
  var xValues = ["Seller Registration", "Ordering", "Advertising"];
  var yValues = [<?php echo "$countpie1"; ?>, <?php echo "$countpie2"; ?>, <?php echo "$countpie3"; ?>];
  var barColors = [
    "#58FF33",
    "#FCEA37",
    "#5DD5FF" 
  ];

  new Chart("myChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: ""
      }
    }
  });
</script>


</html>