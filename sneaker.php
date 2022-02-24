  <?php 

	include('components/header.php');

  

    if (isset($_GET['sneakerid']) && $_GET['sneakerid'] != '')
    {
       $_SESSION['sneakerid'] = $_GET['sneakerid'];
       $sneakerid = $_GET['sneakerid'];
       $selectsneaker   = "SELECT * FROM sneaker WHERE sneakerID = '$sneakerid' ";  
       $runsneaker      = mysqli_query($connect, $selectsneaker);
       $rowsneaker      = mysqli_fetch_array($runsneaker);
       // image take out
       $sneakername   = $rowsneaker['sneakerName'];
       $image1   = $rowsneaker['productImage1'];
       $image2   = $rowsneaker['productImage2'];
       $image3   = $rowsneaker['productImage3'];
       $image4   = $rowsneaker['productImage4'];
       $image5   = $rowsneaker['productImage5'];

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

    // Add to cart 
    if(isset($_POST["btn-add-to-cart"]))  
    {  

        // if there is already a shopping cart
        if(isset($_SESSION["shopping_cart"]))  
        { 
            $selleridtest     = $_POST["hidden_seller"];
            $item_array_id    = array_column($_SESSION["shopping_cart"], "item_id");  
            $seller_array_id  = array_column($_SESSION["shopping_cart"], "seller_id");  

            // if items is not already in cart
            if(!in_array($_GET["sneakerid"], $item_array_id))  
            {   
                // if only items are from same seller
                if(in_array($selleridtest, $seller_array_id))
                { 
                    $count = count($_SESSION["shopping_cart"]);  
                    $item_array = array(  
                        'item_id'        =>   $_GET['sneakerid'],  
                        'seller_id'      =>   $_POST['hidden_seller'],    
                        'item_quantity'  =>   $_POST['txtquantity'],
                    );  

                    $_SESSION["shopping_cart"][$count] = $item_array; 

                     echo "  
                           <script>
                           window.location = 'shoppingCart.php'; 
                           </script>
                         ";
                }

                else  
                {  
                    echo "
                    <script> 
                      alert('$seller_id You cannot buy items from different seller at once !');
                      window.location.assign('home.php');
                    </script>";
                } 
            }  


            else  
            {  
                echo "
                <script> 
                  alert('Item Already Exist !');
                  window.location.assign('home.php');
                </script>";
            } 
        }

        else  
        {  
            $item_array = array
            (  
              'item_id'        =>   $_GET['sneakerid'],  
              'seller_id'      =>   $_POST['hidden_seller'],    
              'item_quantity'  =>   $_POST['txtquantity'],  
            );  

             $_SESSION["shopping_cart"][0] = $item_array;  
             echo "  
               <script>
               window.location = 'shoppingCart.php'; 
               </script>";
        }  

    }  

    
 ?>

 <!DOCTYPE html>   
 <html>
 <head> 
 	<title><?php echo "$sneakername"; ?> | CultureX</title>
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
                            <?php 

                                $selectproduct = "SELECT * FROM sneaker WHERE sneakerID = '$sneakerid' ";        
                                $runproduct    = mysqli_query($connect, $selectproduct);  
                                $rowproduct   = mysqli_fetch_array($runproduct);
                                $productid    = $rowproduct['sneakerID']; 
                                $productname  = $rowproduct['sneakerName']; 
                                $productprice = $rowproduct['sneakerPrice']; 
                                $productdesc  = $rowproduct['description']; 
                                $stock        = $rowproduct['inStock']; 
                                $saledate     = $rowproduct['onSaleDate']; 
                                $sale         = $rowproduct['totalSale']; 
                                $image        = $rowproduct['productImage1']; 
                                $sellerid     = $rowproduct['sellerID']; 
                                $brandid      = $rowproduct['brandID']; 
                                $categoryid   = $rowproduct['categoryID'];      
                                $brand    = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');           
                                $category = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName'); 
                                $seller   = GET_ATTRIBUTE('user', 'userID', $sellerid, 'userName');

                             ?>
                            <div class="product-details">
                                <div class="pd-title">
                                    <span><?php echo $category ?></span>
                                    <h3><?php echo $productname ?></h3>
                                </div>
                                
                                <div class="pd-desc">
                                    <h4>$495.00 <!-- <span>629.99</span> --></h4>       
                                    from <b style="color: #e7ab3c"><?php echo "$seller"; ?></b>
                                </div>

                                <div class="pd-tags">
                                    <li><span>Brand</span>: <?php echo "$brand"; ?></li> 
                                </div>

                                 <ul class="pd-tags">

                                    <li><span><?php echo "($stock)"?> items available</span></li>
                                    <li><span>On Sale Since</span>: <?php echo "$saledate"; ?></li>
                                    
                                </ul> 

                                <!-- number box -->
                                <div class="quantity">
                                  <!-- submit item to cart session -->
                                  <form method="POST" action="sneaker.php?action=add&sneakerid=<?php echo($sneakerid) ?>">
                                    <div class="number-input pro-qty">
                                      <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" 
                                        type="button">
                                      </button>
                                      <input required class="quantity" min="1" max="<?php echo($stock) ?>" name="txtquantity" value="1" type="number">
                                      <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus" type="button"></button>
                                    </div>

                                    
                                        <!-- Cart Data -->
                                        <input type="hidden" name="hidden_id" value="<?php echo($sneakerid)?>">
                                        <input type="hidden" name="hidden_seller" value="<?php echo($sellerid)?>">
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
                                                  name='btn-add-to-cart' 
                                                  style='border:none;'>Add To Cart
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
                                                <p><?php echo "$productdesc"; ?></p>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                          <?php 
                                            $sellerid      = $rowproduct['sellerID'];
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
                                                  <label style="color:black; font-weight: bold;"><?php echo "$sellerPhone"; ?></label>
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