  <?php 

	  include('components/header.php');

    $today = date_create(date('Y-m-d'));
    $now   = strtotime(date('H:i:s')); 

    if (isset($_GET['auctionid']) && $_GET['auctionid'] != '')
    {
      $auid            = $_GET['auctionid'];
      // get aution  info
      $snid         = GET_ATTRIBUTE('auction', 'auctionID', $auid, 'sneakerID'); 
      $headshot     = GET_ATTRIBUTE('auction', 'auctionID', $auid, 'headshotPrice');   
      $current      = GET_ATTRIBUTE('auction', 'auctionID', $auid, 'currentBid');   
      $enddate      = date_create(GET_ATTRIBUTE('auction', 'auctionID', $auid, 'endDate'));  
      $endtime      = strtotime(GET_ATTRIBUTE('auction', 'auctionID', $auid, 'endTime'));  
      $increment    = GET_ATTRIBUTE('auction', 'auctionID', $auid, 'increment');   
      $mininput     = $current + $increment;  

      // get sneaker info
      $sneakerName  = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sneakerName');
      $sneakerPrice = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sneakerPrice');
      $subcategory  = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sneakerSubCategory');
      $desc         = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'description');
      $brandid      = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'brandID');
      $categoryid   = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'categoryID');
      $brand        = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');  
      $category     = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');

      // seller
      $sellerid  = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sellerID');
      $seller    = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userName');

      // Get 5 images
      $image1        = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'productImage1');
      $image2        = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'productImage2');
      $image3        = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'productImage3');
      $image4        = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'productImage4');
      $image5        = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'productImage5');

      // difference only in  year
      $interval = date_diff($today, $enddate);

     // set placeholder for null images
     if ($image2 == '') {
       $image2 = "themes/img/upload2.webp";
     }else if ($image3 == '') {
       $image3 = "themes/img/upload2.webp";
     }else if ($image4 == '') {
       $image4 = "themes/img/upload2.webp";
     }else if ($image5 == '') {
       $image5 = "themes/img/upload2.webp";
     }else if ($image1 == '') {
       $image1 = "themes/img/upload2.webp";
      }
    }

    else
    {
        echo "<script>
            window.location.assign('home.php');
          </script>";
    }   

    // Place bidding 
    if(isset($_POST["btn-place-bid"]))  
    {   
        $mymail = $_SESSION['myemail'];
        $addbid = $_POST["txtaddbid"];

        $headshot = GET_ATTRIBUTE('auction', 'auctionID', $auid, 'headshotPrice'); 
        // if buyer give headshot price
        if ($addbid == $headshot) 
        { 
          $mymail = $_SESSION['myemail'];
          $myid = GET_ATTRIBUTE('user', 'userEmail', $mymail, 'userID');
          $addcus = GET_ATTRIBUTE('user', 'userEmail', $mymail, 'userID');
          // update auction status
          $updatepay2 = "UPDATE auction 
                        SET auctionStatus='Payment Pending', currentBid = '$headshot', currentAuctioneer = '$addcus', currentAuctioneer='$myid'
                        WHERE auctionID='$auid'";
          $runpay2    = mysqli_query($connect, $updatepay2);

          $today     = DATE('Y-m-d');
          $now       = DATE('H:i:s');
          $sneakerid = GET_ATTRIBUTE('auction', 'auctionID', $auid, 'sneakerID');
          $sneaker   = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sneakerName');
          // noti
          $notiid    = GET_ID('notification', 'notificationID');
          $noti      = "You won the auction of $sneaker. Proceed checkout to order !";
          // send a notification
          $insertnoti = "INSERT INTO notification 
                      VALUES('$notiid', '$noti', '$today', '$now', 'unseen', '$auid', NULL, '$myid')";
          $runnoti    = mysqli_query($connect, $insertnoti);
          if ($runnoti){
            echo "<script>
            alert('You won the auction');
            window.location.assign('checkout.php?auctioncheckout=$auid')
          </script>";
          }else{  echo mysqli_error($connect);}



          
          
        }
        else{
          $addcus = GET_ATTRIBUTE('user', 'userEmail', $mymail, 'userID');
          $placebid = "UPDATE auction 
                       SET currentBid = '$addbid', currentAuctioneer = '$addcus' 
                       WHERE auctionID = '$auid' "; 
          $runbid   = mysqli_query($connect, $placebid);
          if ($runbid)
          {
            echo "<script>
                alert('Your bid is placed successfully !');
                window.location.assign('auction.php');
            </script>" ;
          }
        }
        

    }  

    
 ?>

 <!DOCTYPE html>   
 <html>
 <head> 
 	<title>Shop | PimShop</title>
 	<style type="text/css">

      .img-display
      {
          width: 250px; 
          height: 250px;   
          background-size: cover; 
          background-repeat: no-repeat;    
          background-position: center;  
      } 

      .slider-container {
        height: 350px;
        width: 350px;
        position: relative;
        overflow: hidden;
        text-align: center;
      }

      .menu {   
        position: relative;
        z-index: 9000;
        margin-top: 280px;
      }

      .menu label {
        cursor: pointer;
        display: inline-block;
        width: 1px;     
        height: 1px;
        background: #ffd485;
        border-radius: 50px;
      }

      .menu label:hover,
      .menu label:focus 
      {
        background: #e7ab3c;
      } 

      .slide {
        width: 100%;
        height: 100%;   
        position: absolute;
        top: 0;
        left: 100%;
        z-index: 10;
        object-fit: cover;
        transition: left 0s 0.75s;
      }
      [id^="slide"]:checked + .slide {
        left: 0;
        z-index: 100;
        transition: left 0.65s ease-out;
      }

      .slide-div
      {
        width: 400px;
        height: 400px;
        background-size: cover;         
        background-repeat: no-repeat;    
        background-position: center;  
      }

        .number-input {
        border: 2px solid #ddd;
        display: inline-flex;
      }
 	</style>      
 </head>
 
 <body>
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details" style="margin-top: 120px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="slider-container">
                                  
                                  <input id="slide-dot-1" type="radio" name="slides" checked>
                                  <img src="<?php echo($image1) ?>" class="slide slide-1 slide-div">

                                  <input id="slide-dot-2" type="radio" name="slides">
                                  <img src="<?php echo($image2) ?>" class="slide slide-2 slide-div">

                                  <input id="slide-dot-3" type="radio" name="slides">
                                  <img src="<?php echo($image3) ?>" class="slide slide-3 slide-div">

                                  <input id="slide-dot-3" type="radio" name="slides">
                                  <img src="<?php echo($image4) ?>" class="slide slide-3 slide-div">

                                  <input id="slide-dot-3" type="radio" name="slides">
                                  <img src="<?php echo($image5) ?>" class="slide slide-1 slide-div">
                                  <div class="menu">
                                    <label for="slide-dot-1"></label>
                                    <label for="slide-dot-2"></label>     
                                    <label for="slide-dot-3"></label>
                                    <label for="slide-dot-2"></label>     
                                    <label for="slide-dot-3"></label>
                                  </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            
                            <div class="product-details">
                                <div class="pd-title">
                                    <span><?php echo $category ?></span>
                                    <h3><?php echo $sneakerName ?></h3>
                                </div>
                                
                                <div class="pd-desc">
                                    Brand <b style="color: #e7ab3c"><?php echo "$brand"; ?></b><br>
                                    from <b style="color: #e7ab3c"><?php echo "$seller"; ?></b>
                                </div>

                                 <ul class="pd-tags">

                                    <li><span><?php echo $interval->format('%a days left') . "\n"; ?></span></li>
                                    <li><span>Current Bid</span>: $ <?php echo "$current"; ?></li>
                                    <li><span>Headshot Bid</span>: $ <?php echo "$headshot"; ?></li>
                                    <li><span>Minimum increment</span>: $ <?php echo "$increment"; ?></li>
                                    
                                </ul> 

                                <ul class="pd-tags">
                                    <li class="text-danger">*You have to bid at least $ <?php echo "$mininput"; ?>*</li>
                                </ul> 

                                <!-- number box -->
                                <div class="quantity">
                                  <!-- submit item to cart session -->
                                  <form method="POST" action="auction_sneaker.php?auctionid=<?php echo($auid) ?>">
                                    <div class="number-input2">
                                    <input class="txtaddbid" 
                                          min="<?php echo($mininput) ?>" 
                                          max="<?php echo($headshot) ?>" 
                                          name="txtaddbid"
                                          placeholder="$ <?php echo($mininput) ?>"
                                          type="number" required>
                                    </div>
                                        <!-- Cart Data -->
                                        <?php 

                                          if (isset($_SESSION['myemail']))
                                          { 
                                            $mymail = $_SESSION['myemail'];
                                            $myid = GET_ATTRIBUTE('user', 'userEmail', $mymail, 'userID');
                                            if ($sellerid == $myid) 
                                            {
                                               echo "<p class='primary-btn pd-cart btn-link'>
                                                    You cannot buy your product.
                                                  </p>";
                                            }

                                            else{ 
                                              echo "
                                              <button type='submit' 
                                                  class='primary-btn pd-cart btn-link' 
                                                  name='btn-place-bid' 
                                                  style='border:none;'>Place Bid
                                              </button>
                                              ";  
                                            }
                                          }

                                          else
                                          {
                                            echo "<a href='login.php' class='primary-btn pd-cart btn-link'>
                                                    Please login first.
                                                  </a>";
                                          }

                                        ?>
                                        
                                    </form>

                                </div>

                            </div>
                        </div>  
                    </div>
                    
                    <div class="product-tab">
                        <div class="tab-item ">
                            <ul class="nav" role="tablist">

                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">Description</a>
                                </li>    


                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Seller Contact</a>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">  

                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5>Sneaker Description</h5>
                                                <p><?php echo "$desc"; ?></p>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                          <?php 
                                            $sellername    = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userName');
                                            $sellerEmail   = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userEmail');
                                            $sellerPhone   = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userPhone');
                                            $country       = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userCountry');
                                            $sellername    = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userName');


                                          ?>
                                            <div class="col-lg-12">
                                                <div><h5>Seller Information</h5></div>
                                                <div style="font-size: 17px;">
                                                  <label style="font-weight: bold;">
                                                  Name : </label>
                                                  <label style="color:black; font-weight: bold;"><?php echo "$sellername"; ?></label>
                                                </div>

                                                <div style="font-size: 17px;">
                                                  <label style="font-weight: bold;">
                                                  Email : </label>
                                                  <label style="color:black; font-weight: bold;"><?php echo "$sellerEmail"; ?></label>
                                                </div>

                                                <div style="font-size: 17px;">
                                                  <label style="font-weight: bold;">
                                                  Phone : </label>
                                                  <label style="color:black; font-weight: bold;"><?php echo "$sellerPhone"; ?></label>
                                                </div>

                                                <div style="font-size: 17px;">
                                                  <label style="font-weight: bold;">
                                                  From  : </label>
                                                  <label style="color:black; font-weight: bold;"><?php echo "$country"; ?></label>
                                                </div>

                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
        <!-- footer component -->
    <?php include('components/footer.php'); ?>

  

 </body>

 </html> 		