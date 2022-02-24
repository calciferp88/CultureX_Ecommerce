<?php 

  include('components/header.php');
  // get buyer id 
  $myemail = $_SESSION['myemail'];
  $myid = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');
  $makeseen = "UPDATE notification SET `notiStatus` = 'seen' WHERE `userID` = '$myid'; ";
  $runseen  = mysqli_query($connect, $makeseen);

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Notifications | CultureX</title>
</head>
<body>

    <!-- Breadcrumb Section Begin --> 
    <h4 class="top-heading">Your notifications</h4>                     
    <!-- Breadcrumb Section End -->
    
    <div class="container">



     <?php 

      $takenoti = "SELECT * FROM notification
              WHERE userID = '$myid'
              ORDER BY notiDate DESC";
      $runnotitake   = mysqli_query($connect, $takenoti);
      $countnotitake = mysqli_num_rows($runnotitake);

      for ($im=0; $im <$countnotitake ; $im++) 
      {
          $notirow   = mysqli_fetch_array($runnotitake);
          $notiid    = $notirow['notificationID'];
          $noti      = $notirow['notification'];
          $notidate  = $notirow['notiDate'];
          $notitime  = $notirow['notiTime'];
          $auccid    = $notirow['auctionID'];
          $austt     = GET_ATTRIBUTE('auction', 'auctionID', $auccid, 'auctionStatus');
      
   ?>

    <!-- notification lines -->
    <div class="card noti-card">
      <div class="card-body noti-body">
        <p><?php echo "$noti"; ?></p>
        <span><?php echo "$notidate | $notitime"; ?></span>
      </div>
      <?php 

        if ($austt == 'Payment Pending'){
          echo "<a href='checkout.php?auctioncheckout=$auccid' class='noti-link'>View</a>";
        }

       ?>
      
    </div>

    <?php } ?>

    <?php if ($countnotitake==0): ?>
      <br><br>
      <div class="alert alert-primary" role="alert">
      You don't have any alert yet.
    </div>
    <?php endif ?>
    
    
    </div>
        <!-- footer component -->
    <?php include('components/footer.php'); ?>

</body>
</html>