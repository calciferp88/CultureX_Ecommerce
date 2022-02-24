    <?php 

	include('components/header.php');

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Auctions | PimShop</title>
 	<style type="text/css">

        .input-select
        {
            padding: 10px;
            margin-right:10px;
            border:1px solid #bfbfbf;
        }

        .img-display
        {
            width: 250px; 
            height: 250px;   
            background-size: cover; 
            background-repeat: no-repeat;    
            background-position: center;  
        } 

        .input-option{
            padding: 30px;
        }

        .snname{
            font-weight: bold;
        }


 	</style>      
 </head>
  
 <body>

        <!-- Breadcrumb Section Begin --> 
        <div class="breadcrumb-section"> 
            <div class="container"> 
                <div class="row">   
                    <div class="col-lg-12">     
                        <div class="breadcrumb-text product-more">   
                            <a href="home.php"><i class="fa fa-home"></i> Home</a> 
                            <a href="auction.php">Auctions</a>
                </div> </div>   </div> </div>
        </div>                     
        <!-- Breadcrumb Section End -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad" style="margin-top: -45px;">
        <div class="container">

            <!-- main product list -->
            <div class="row">
                   
                <div class="col-lg-12 order-1 order-lg-2"> 

                    <!-- Defaut -->
                    <?php if (empty($_GET)) { ?>
                            <div class="product-list">

                                <h1>Active Auctions |</h1><br>
                                <div class="row">

                                    <?php      

                                        $today = date_create(date('Y-m-d'));
                                        $now   = strtotime(date('H:i:s')); 

                                       $selectauction = "SELECT * FROM auction 
                                                         WHERE auctionStatus = 'Active' 
                                                         AND endDate >= CURRENT_DATE";
                                       $runauction   = mysqli_query($connect, $selectauction);
                                       $countauction = mysqli_num_rows($runauction);

                                       for ($i=0; $i < $countauction; $i++)  
                                      { 
                                        $rowauction   = mysqli_fetch_array($runauction);
                                        $auid         = $rowauction['auctionID'];  
                                        $snid         = $rowauction['sneakerID'];  
                                        $headshot     = $rowauction['headshotPrice'];  
                                        $current      = $rowauction['currentBid'];  
                                        $enddate      = date_create($rowauction['endDate']);  
                                        $endtime      = strtotime($rowauction['endTime']);  
                                        $sneakerName  = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sneakerName');
                                        $sneakerPrice = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sneakerPrice');
                                        $subcategory  = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'sneakerSubCategory');
                                        $image        = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'productImage1');
                                        $brandid      = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'brandID');
                                        $categoryid   = GET_ATTRIBUTE('sneaker', 'sneakerID', $snid, 'categoryID');
                                        $brand        = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');  
                                        $category     = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        // difference only in  year
                                        $interval = date_diff($today, $enddate);
                                        
                                        
                                     ?>

                                     <div class="col-lg-3 col-sm-6">
                                            <div class="product-item">
                                                <div class="pi-pic">
                                                    <img src="<?php echo($image) ?>" alt="">
                                                    <div class="sale pp-sale">Auction</div>
                                                    <div class="icon">
                                                        <i class="icon_heart_alt"></i>
                                                    </div>
                                                    <ul>
                                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                                        <?php echo "<li class='quick-view'>
                                                                        <a href='auction_sneaker.php?auctionid=$auid'>Auction Now</a>
                                                                    </li>"; 

                                                        ?>
                                                        
                                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>  
                                                    </ul>  
                                                </div>
                                                <div class="pi-text">
                                                    <div class="catagory-name">
                                                        <?php echo "$brand";?> | <?php echo "$category"; ?>
                                                    </div>

                                                    <a href="sneaker.php?sneakerid=<?php echo($snid) ?>" class="">
                                                        <h5 class="snname"><?php echo "$sneakerName"; ?></h5>
                                                        <h6><?php echo $interval->format('%a days left') . "\n"; ?></h6>
                                                    </a>        

                                                    <div class="product-price">
                                                        Current Bid <?php echo "$ $current"; ?><br>
                                                        Headshot Price <?php echo "$ $headshot"; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
            
                                </div>
                            </div>
                    <?php } ?>  

                    <?php if ($countauction==0): ?>
                        <br><br>
                      <div class="alert alert-primary" role="alert">
                      Currently no active auction.
                    </div>
                    <?php endif ?>
                    

                    <!-- Sort by   -->

                    <!-- footer loading -->
                    <div class="loading-more">
                        <div class="spinner">
                            <i class="icon_loading" style="transform: rotate(35deg)"></i>
                        </div>
                        <a href="#">
                            Loading More
                        </a>
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