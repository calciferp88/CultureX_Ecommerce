<?php 

	session_start();	
	$connect = mysqli_connect("localhost", "root", "", "CultureXdb");
	include('scripts/functions.php');
    $cartitem = '';

    if(!empty($_SESSION["shopping_cart"]))  
    {  
        $total = 0;  
        $cartitem = 0;
        foreach($_SESSION["shopping_cart"] as $keys => $values)  
        {  
          $cartitem = $cartitem + 1;
        }

    }

    // sync all the auctions
    $selectauction = "SELECT * FROM auction WHERE endDate<CURRENT_DATE ";
    $runauction    = mysqli_query($connect, $selectauction); 
    $countauction  = mysqli_num_rows($runauction);

    // if there is an auciton to process
    if($countauction > 0)
    {   
        // get auction information 
        for ($i=0; $i < $countauction; $i++){ 

            $rowauction   = mysqli_fetch_array($runauction);
            $auctionid    = $rowauction['auctionID'];
            $status       = $rowauction['auctionStatus'];
            $bidder       = $rowauction['currentAuctioneer'];
            $sneakeradd   = $rowauction['sneakerID'];

            // if there is not an auctioneer
            if($bidder == NULL){
                $updateauction = "UPDATE auction SET auctionStatus='Expired' WHERE auctionID='$auctionid'";
                $runauction    = mysqli_query($connect, $updateauction);
                $addsn = "UPDATE sneaker 
                        SET inStock = inStock + 1
                        WHERE sneakerID = '$sneakeradd' "; 
                $runaddsn = mysqli_query($connect, $addsn);

                if ($runaddsn){
                }else{  echo mysqli_error($connect);}
            }

            // if there is an auctioneer
            elseif($bidder != NULL && $status=="Active")
            {   
                // update auction status
                $updatepay = "UPDATE auction SET auctionStatus='Payment Pending' WHERE auctionID='$auctionid'";
                $runpay    = mysqli_query($connect, $updatepay);

                $today     = DATE('Y-m-d');
                $now       = DATE('H:i:s');
                $sneakerid = $rowauction['sneakerID'];
                $sneaker   = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sneakerName');
                $notiid    = GET_ID('notification', 'notificationID');
                $noti      = "You won the auction of $sneaker. Proceed checkout to order !";
                // send a notification
                $insertnoti = "INSERT INTO notification 
                            VALUES('$notiid', '$noti', '$today', '$now', 'unseen', '$auctionid', NULL, '$bidder')";
                $runnoti    = mysqli_query($connect, $insertnoti);
                if ($runnoti){
                }else{  echo mysqli_error($connect);}

            }
        }
    }

 ?>	

<!DOCTYPE html>
<html>
<head>
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
 
    <style type="text/css">

    	li a 
    	{  
    	 font-size: 18px;	
    	 color: #e7ab3c;
    	 opacity: 100%;	   
    	}

    	li a:hover
    	{
    	 color: black;
    	}

    	.navbar-brand
    	{	
    		font-size: 30px;
    		color: black;
    		font-weight: bold;
    	}   
        
    	.navbar-brand span 
    	{
    		color: #e39d1c;
    	}

    	.dropdown {
		  position: relative;
		  display: inline-block; 
        }

		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: black;
		  min-width: 150px;
		  border: 0.5px solid #bfbfbf;    
		  z-index: 1;
          border: none;
          box-shadow: 0px 0px 5px white;
		}

		.dropdown-content p{
		  text-align: center;
		  margin: 0px;
		  padding: 10px;
		  font-style: "Muli", sans-serif;

		}

		.dropdown-content p a{
			color: white;
		    font-style: "Muli", sans-serif;
		    font-size: 15px;
            font-weight: bold;
		}

		.dropdown-content p a:hover{
			color: #e39d1c;

		}

		.dropdown:hover .dropdown-content {
		  display: block;
		}

		.account-option:depart-hover
		{
			color: red;
		}

    </style>	

</head> 
   
<body>

      <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">     
    
        <div style="position: fixed; top: 0px; z-index:  1000000; width: 100%;background-color: white;">
            <!-- Top Nav -->
            <div class="container top-nav ">    
                <div class="inner-header" style="padding-top: 15px; padding-bottom: 15px; ">
                    <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="home.php" style="color: #e7ab3c; font-weight: bold; font-size: 25px;">
                                Culture<span style="color: black;">X.</span>
                            </a>
                        </div>  
                    </div>
                    
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>  
                                <div class="input-group">  
                                    <form action="shop.php" method="POST">
                                        <input type="text" placeholder="Search in CultureX" name="txtsearch">
                                        <button type="submit" name="btn-search"><i class="ti-search"></i></button> 
                                    </form> 
                                </div>  
                        </div>
                    </div>  
                    

                    <?php   

                        if (isset($_SESSION['myemail'])) 
                        {
                            $myemail  = $_SESSION['myemail'];
                            $username = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userName');    
                            $myid     = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');       
                     ?>    

                    <!-- shooping cart count -->
                    <div class="col-lg-3 text-right col-md-3"> 
                        <ul class="nav-right">   
                            <li class="heart-icon"> 
                                <a href="notification.php">   
                                    <i class="far fa-bell" style="font-size: 22px;"></i>
                                    <?php 

                                        $selectnoti = "SELECT * FROM notification 
                                                    WHERE userID = '$myid' AND notiStatus = 'unseen' ";
                                        $runnoti = mysqli_query($connect, $selectnoti);
                                        $countnoti = mysqli_num_rows($runnoti);
                                        if ($countnoti > 0) 
                                        {
                                            echo "<span >$countnoti</span>";
                                        }
                                        
                                     ?>
                                </a> 
                            </li> 
                            <li class="heart-icon"> 
                                <a href="shoppingCart.php">   
                                    <i class="fas fa-shopping-cart" style="font-size: 22px;"></i>
                                    <?php 

                                        if(!empty($_SESSION["shopping_cart"])) 
                                        {
                                            echo "<span >$cartitem</span> ";
                                        }

                                        else{
                                            
                                        }

                                     ?>
                                </a> 
                            </li> 

                            <li>  
                                <div class="dropdown">
                                  <span><a href=""><?php echo "$username"; ?> <i class="fas fa-chevron-down"></i></a></span>
                                  <div class="dropdown-content">    
                                    <p><a href="profile.php">My Account</a></p>
                                    <p><a href="orderHistory.php">Order History</a></p>
                                    <p><a href="logout.php">Logout</a></p>
                                  </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <?php } else  {

                     ?>

                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right" >

                            <li class="cart-icon">
                                <a href="signup.php" class="btn-link">  
                                    Sign Up 
                                </a>
                            </li>

                            <li class="cart-icon">
                                <a href="login.php" class="btn-link">
                                     Login
                                </a>
                            </li>   

                    </div>

                <?php } ?>

                </div>  
                </div>
            </div> 

           <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        
                        <span>All Categories</span> &nbsp;<i class="fas fa-chevron-down"></i>
                        <ul class="depart-hover">         

                        <?php 

                                $selectcategory = "SELECT * FROM category";  
                                $runcategory    = mysqli_query($connect, $selectcategory);
                                $countcategory  = mysqli_num_rows($runcategory);

                                for ($i=0;$i<$countcategory;$i++)
                                {
                                    $rowcategory    = mysqli_fetch_array($runcategory);
                                    $cid            = $rowcategory['categoryID'];
                                    $cname          = $rowcategory['categoryName']; 
                                    
                                    echo " <li><a href='shop.php?categoryid=$cid'>$cname</a></li>";

                                }
                         ?>
                            
                            
                        </ul>           
                    </div>
                </div>  

                <nav class="nav-menu mobile-menu">
                    <ul>    
                        <li><a href="home.php">Home</a></li>          
                        <li><a href="shop.php">Shop</a></li>          
                        <li><a href="#">Brands</a> 
                            <ul class="dropdown">
                            <?php 

                                $selectbrand = "SELECT * FROM brand";  
                                $runbrand    = mysqli_query($connect, $selectbrand); 
                                $countbrand  = mysqli_num_rows($runbrand);
                                                                        
                                for ($i=0;$i<$countbrand;$i++)
                                {
                                    $rowbrand    = mysqli_fetch_array($runbrand);    
                                    $brandid            = $rowbrand['brandID'];   
                                    $brandname          = $rowbrand['brandName']; 

                                    echo " <li><a href='shop.php?brandid=$brandid'>$brandname</a></li>";
     
                                }            
                            ?> 
                            </ul>
                        </li> 
                        <li><a href="auction.php">Aucitons</a></li>


                        <!-- Seller tool -->
                        <?php   

                        if (isset($_SESSION['myemail'])) 
                        {
                            $myemail   = $_SESSION['myemail'];   
                            $sellerchk = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'sellerStatus');    

                            if ($sellerchk == 1 ) 
                            {   
                                    
                         ?>
                        <li><a href="#">Seller Tools</a>
                            <ul class="dropdown">       
                                <li><a href="sellerDashboard.php">Dashboard</a></li>
                                <li><a href="addproduct.php">Add Product</a></li>  
                                <li><a href="productlist.php">Product List</a></li>
                                <li><a href="addauction.php">Add Auction</a></li>
                                <li><a href="auctionlist.php">Auction List</a></li>
                                <li><a href="advertise.php">Add Advertisement</a></li>
                                <li><a href="advertisementlist.php">My Advertisements</a></li>
                            </ul>
                        </li>

                    <?php }

                    else {   

                    ?>

                    <li><a href="home.php#contact">CONTACT US</a>
                        </li>
    
                    <?php } } else { ?>

                <?php } ?>

                    </ul>
                </nav>
                <div id="mobile-menu-wrap" style="margin-top: -65px;"></div>  
            </div>
        </div>  
    </div>

    <!-- Hero Section End -->
    </header>


    
    <!-- Header End -->
    <!-- Js Plugins -->
    <script src="themes/js/jquery-3.3.1.min.js"></script>
    <script src="themes/js/bootstrap.min.js"></script>
    <script src="themes/js/jquery-ui.min.js"></script> 
    <script src="themes/js/jquery.countdown.min.js"></script>
    <script src="themes/js/jquery.nice-select.min.js"></script>
    <script src="themes/js/jquery.zoom.min.js"></script>
    <script src="themes/js/jquery.dd.min.js"></script>
    <script src="themes/js/jquery.slicknav.js"></script>
    <script src="themes/js/owl.carousel.min.js"></script>
    <script src="themes/js/main.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="themes/js/dataTables/jquery.dataTables.js"></script>  
    <script src="themes/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();  
            });  
    </script>

    <script type="text/javascript">
      var txtCardNumber = document.querySelector("#txtCardNumber");
      txtCardNumber.addEventListener("input", onChangeTxtCardNumber);

      function onChangeTxtCardNumber(e) {   
          var cardNumber = txtCardNumber.value;
       
          // Do not allow users to write invalid characters
          var formattedCardNumber = cardNumber.replace(/[^\d]/g, "");
          formattedCardNumber = formattedCardNumber.substring(0, 16);
        
          // Split the card number is groups of 4
          var cardNumberSections = formattedCardNumber.match(/\d{1,4}/g);
          if (cardNumberSections !== null) {
              formattedCardNumber = cardNumberSections.join(' '); 
          }
        
          console.log("'"+ cardNumber + "' to '" + formattedCardNumber + "'");
        
          // If the formmattedCardNumber is different to what is shown, change the value
          if (cardNumber !== formattedCardNumber) {
              txtCardNumber.value = formattedCardNumber;
          }
      }
    </script>
    

</body>

</html>	