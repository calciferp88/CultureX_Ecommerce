<?php 

	include('components/header.php');

    // navigate to home if shopping cart is empty
    if (isset($_GET['auctioncheckout']))
    {
        $auctionidcheck = $_GET['auctioncheckout'];
    }

    else{

        if(empty($_SESSION["shopping_cart"])) {
        echo "
            <script> 
              alert('You have no item to checkout');
              window.location.assign('home.php');
            </script>";
        }
    }
    

	// when checkout 
	if (isset($_POST['btn-checkout'])){

        // get buyer id 
        $myemail = $_SESSION['myemail'];
        $buyerid = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');
        // get from inputs
        $purchaseid       = GET_ID('purchase', 'purchaseID');
        $purchasedate     = DATE('Y-m-d');
        $purchaseday      = DATE('d');
        $purchasemonth    = DATE('m');
        $purchaseyear     = DATE('Y');  
        $grandtotal       = $_POST['txtRtotal'];
        $cardtype         = $_POST['txtRcard'];
        $cardnumber       = $_POST['txtRcardnumber'];
        $recievername     = $_POST['txtRname'];
        $recieveremail    = $_POST['txtRemail'];
        $recieverphone    = $_POST['txtRphone'];
        $recieverpostal   = $_POST['txtRpostalcode'];
        $recievercity     = $_POST['txtRcity'];
        $recieveraddress  = $_POST['txtRaddress'];
        $incomeid         = GET_ID('income', 'incomeID');   


        // if this checkout is for auction
        if (isset($_GET['auctioncheckout']))
        {    
            $sellerid    = $_POST['txtsellerhid'];
            // insert purchase
            $insertpurchase = "INSERT INTO `purchase` 
                               VALUES ('$purchaseid','$purchasedate', '$purchaseday', '$purchasemonth', '$purchaseyear', '$grandtotal', '$cardtype', '$cardnumber','$recievername', '$recieveremail', '$recieverphone', '$recieverpostal','$recievercity', '$recieveraddress', 'Pending', '$buyerid', '$sellerid')";

            $runpurchase = mysqli_query($connect, $insertpurchase);

            // insert income
            $insertincome = "INSERT INTO income 
                             VALUES('$incomeid', '$purchasedate', '$purchaseday', '$purchasemonth', '$purchaseyear',
                             '1', '$cardtype', '$cardnumber', 'Ordering', '$buyerid')";

            $runinsertincome = mysqli_query($connect, $insertincome);

            // update auction status
            $updateauctioncheck       = "UPDATE auction SET auctionStatus='Purchased' WHERE auctionID='$auctionidcheck'";
            $runupdateauctioncheck    = mysqli_query($connect, $updateauctioncheck);
            $sneakerid                = $_POST['txtsneakerhid'];
            // insert into dummy
            $insertdummy =  "INSERT INTO purchasesneaker  
                               VALUES ('$purchaseid','$sneakerid', '1')";
            $rundummy    = mysqli_query($connect, $insertdummy); 

            $reduce = "UPDATE `sneaker`  
                    SET `totalSale` = `totalSale` + 1  
                    WHERE `sneakerID` = '$sneakerid'  ";    
                             
            $runreduce = mysqli_query($connect, $reduce); 

            if($runpurchase)
            { 
                echo "
                <script>
                  alert('Your Order is Successful');
                  window.location.assign('home.php');
                </script>";
            } 

            else
            {
                echo mysqli_error($connect);
            }
        }

        // for normal order
        else{

            // insert purchase
            $insertpurchase = "INSERT INTO `purchase` 
                               VALUES ('$purchaseid','$purchasedate', '$purchaseday', '$purchasemonth', '$purchaseyear', '$grandtotal', '$cardtype', '$cardnumber','$recievername', '$recieveremail', '$recieverphone', '$recieverpostal','$recievercity', '$recieveraddress', 'Pending', '$buyerid', NULL)";

            $runpurchase = mysqli_query($connect, $insertpurchase);

            // insert income
            $insertincome = "INSERT INTO income 
                             VALUES('$incomeid', '$purchasedate', '$purchaseday', '$purchasemonth', '$purchaseyear',
                             '1', '$cardtype', '$cardnumber', 'Ordering', '$buyerid')";

            $runinsertincome = mysqli_query($connect, $insertincome);
            // insert into dummy table for each item 
            foreach($_SESSION["shopping_cart"] as $keys => $values) 
            {  

              $sneakerid  = $values["item_id"]; 
              $quantity   = $values["item_quantity"]; 
              $sellerid   = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sellerID'); 


              $insertdummy =  "INSERT INTO purchasesneaker  
                               VALUES ('$purchaseid','$sneakerid', '$quantity')";
              $rundummy    = mysqli_query($connect, $insertdummy); 

              $reduce = "UPDATE `sneaker`  
                        SET `inStock` = `inStock`-'$quantity', `totalSale` = `totalSale` + '$quantity'  
                        WHERE `sneakerID` = '$sneakerid'  ";    
                             
                $runreduce = mysqli_query($connect, $reduce); 

                $setseller = "UPDATE `purchase`  
                    SET `sellerID` = '$sellerid'  
                    WHERE `purchaseID` = '$purchaseid'";    
                             
                $runsellerset = mysqli_query($connect, $setseller); 

            }

            if($runsellerset)
            {

                unset($_SESSION["shopping_cart"]); 
                echo "
                <script>
                  alert('Your Order is Successful');
                  window.location.assign('home.php');
                </script>";
       
            } 

            else
            {
                echo mysqli_error($connect);
            }

        }
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout | CultureX</title>
</head>
<body>

	<!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad" style="margin-top: 70px;">

    	<h4 class="page-heading" 
        	style="border-bottom: 3px solid #e7ab3c;padding:20px; text-align: center; font-weight: bold; width:250px; margin:0px auto;">CHECKOUT FORM 
        </h4>

        <div class="container" style="margin-top: 30px;">

            <?php 
                if(isset($_GET['auctioncheckout'])){ 
                    echo "<form action='checkout.php?auctioncheckout=$auctionidcheck' method='POST' class='checkout-form'>";
                }
                else{
                    echo "<form action='checkout.php' method='POST' class='checkout-form'>";
                }?>
            

            	<!-- billing and address entry -->
                <div class="row" style="box-shadow: 0px 0px 10px #b3b3b3;">
                    <div class="col-lg-6 checkout-widget" style="padding: 15px; margin-top: 30px;  ">
                        
                        <h4>Payment Details</h4>
                        <div class="row">

                            <div class="col-lg-12 payment">
                                <label for="card">Street Address<span>*</span></label>
                                
                                <select name="txtRcard" required>
                                	<option value="visa">Visa</option>
                                	<option value="discovery">discovery</option>
                                	<option value="imax">Imax</option>
                                </select>		                 

                            </div>
                            <div class="col-lg-12">
                                <label for="fir">Card Number<span>*</span></label>
                                <input style="width: 95%;" type="text" id="txtCardNumber" name="txtRcardnumber" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="hii">Card Holder Name<span>*</span></label>
                                <input type="text-align" style="width: 95%; margin-left: 20px;" id="hii" name="txtRcardholder" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="cun-name">Expire Date</label>
                                <input type="text" id="cun-name">
                            </div>
                            <div class="col-lg-6">
                                <label for="cun">CVV<span>*</span></label>
                                <input type="text" id="cun">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 checkout-widget" style="padding: 15px; margin-top: 30px; margin-bottom: 30px; border-left: 1px solid #c7c7c7">
                        
                        <h4>Delivery Address</h4>
                        <div class="row">
                        	<div class="col-lg-12">
                                <label for="rec-name">Receiver Name<span>*</span></label>
                                <input type="text" id="rec-name" name="txtRname" style="width: 95%;"  required>
                            </div>
                            <div class="col-lg-6">
                                <label for="fir">Receiver Email<span>*</span></label>
                                <input type="text" name="txtRemail" id="fir">
                            </div>
                            <div class="col-lg-6">
                                <label for="last">Receiver Phone<span>*</span></label>
                                <input type="text" name="txtRphone" id="last" required>
                            </div>
                            
                            <div class="col-lg-6">
                                <label for="cun">Postal Code<span>*</span></label>
                                <input type="text" name="txtRpostalcode" id="cun">
                            </div>
                            <div class="col-lg-6">
                                <label for="street">City<span>*</span></label>
                                <input type="text" name="txtRcity" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Full address<span>*</span></label>
                                <input type="text" name="txtRaddress" id="zip" style="width: 95%;height: 100px;" >
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px; box-shadow: 0px 0px 10px #b3b3b3;">
                    <div class="col-lg-12 checkout-widget" style="padding: 15px; margin: 0px auto; ">
                        
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Price & Quantity</span></li>
                                    <?php   

                                        // if this is checkout for auction
                                        if(isset($_GET['auctioncheckout'])){  
                                            $auctionidcheck = $_GET['auctioncheckout']; 
                                            $selectauctioncheck = "SELECT * FROM auction WHERE auctionID = '$auctionidcheck' ";
                                            $runauctioncheck = mysqli_query($connect, $selectauctioncheck);
                                            $fetchauction = mysqli_fetch_array($runauctioncheck);
                                            $sneakerid    = $fetchauction['sneakerID'];
                                            $sneakername  = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sneakerName'); 
                                            $seller       = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sellerID'); 
                                            $price        = $fetchauction['currentBid'];
                                            $purchaser    = $fetchauction['currentAuctioneer'];
                                            $grandtotal   = $price+1+5;

                                            echo "
                                            <li class='fw-normal'>$sneakername 
                                                <span>1 x $ $price.00</span>
                                                <input type='hidden' name='txtRtotal' value='$grandtotal'>
                                                <input type='hidden' name='txtsneakerhid' value='$sneakerid'>
                                                <input type='hidden' name='txtsellerhid'  value='$seller'>
                                            </li>";
                                        }
                                        // if this is not for aution 
                                        else{
                                            // if shopping cart is not empty
                                            if(!empty($_SESSION["shopping_cart"]))   
                                            {  
                                               $total = 0;  
                                              
                                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                               {  
                                                    $sneakerid    = $values["item_id"];
                                                    $quantity     = $values["item_quantity"];
                                                    $sneakername  = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sneakerName'); 
                                                    $sneakerprice = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'sneakerPrice'); 
                                                    $sneakerimg   = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'productImage1');

                                                    $categoryid   = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'categoryID');
                                                    $category     = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');

                                                    $brandid   = GET_ATTRIBUTE('sneaker', 'sneakerID', $sneakerid, 'brandID');
                                                    $brand     = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');

                                                    $subtotal = $quantity*$sneakerprice;
                                                    $total = $total + $subtotal;
                                                    $grandtotal = $total+1+5;
                                            
                                                    echo "
                                                    <li class='fw-normal'>'$sneakername'
                                                        <span>$quantity x $ $sneakerprice .00</span>
                                                        <input type='hidden' name='txtRtotal' value='$grandtotal'>
                                                    </li>";
                                                }
                                            }   
                                        }
                                    ?>
                                </ul>
                                <div>
                                	<p style="float: right;"><b>TOTAL PRICE: $<?php echo "$grandtotal"; ?>.00</b></p>
                                </div><br><br>
                                
                                	
                                

                                <div class="order-btn">
                                    <button type="submit" name="btn-checkout" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </form>

        </div>

    </section>
    <!-- Shopping Cart Section End -->
        <!-- footer component -->
    <?php include('components/footer.php'); ?>
</body>
</html>

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