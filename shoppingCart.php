<?php 

    include('components/header.php');

    // navigate to home if shopping cart is empty
    if(empty($_SESSION["shopping_cart"])) {
        echo "
            <script> 
              alert('Your cart is empty');
              window.location.assign('home.php');
            </script>";
    }

    // Delete From Cart
    if(isset($_GET["action"]))  
    {  
        if($_GET["action"] == "delete")  
        {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {    
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo 
                     '
                     <script>
                     window.location="shoppingCart.php";  
                     </script>';  
                }  
           }      
        }   

        else if($_GET["action"] == "deleteall")   
        {  
           unset($_SESSION["shopping_cart"]); 
           echo 
            "
             <script>
                alert('Your cart is empty now !');
                window.location='home.php';  
             </script>";  
        }     
    }  

?>

<html lang="zxx">

<head>
    <title>Shopping Cart | CultureX</title>
</head>


<body>  

    <!-- Breadcrumb Section Begin --> 
    <div class="breadcrumb-section"> 
        <div class="container"> 
            <div class="row">   
                <div class="col-lg-12">         
                    <div class="breadcrumb-text product-more">   
                        <a href="home.php"><i class="fa fa-home"></i> Home</a> 
                        <a href="shop.php"><i class="fas fa-store-alt"></i> Shop</a> 
                        <a href="shoppingCart.php"><i class="fas fa-shopping-cart"></i> Shopping Cart</a>
                    </div> 
                </div>   
            </div> 
        </div>
    </div>                     
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php   
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
                                    
                                ?>

                                    <tr>
                                        <td class="cart-pic first-row"><img src="<?php echo($sneakerimg) ?>" alt=""></td>
                                        <td class="cart-title first-row">
                                            <h5>
                                                <a href="sneaker.php?sneakerid=<?php echo($sneakerid) ?>" 
                                                   style="color: #545454; font-weight: bold;">
                                                   <?php echo "$sneakername"; ?>
                                                </a>
                                            </h5>
                                            <h5 style="margin-top: 10px;">
                                                <p style="color:#e7ab3c;"><?php echo "$brand | $category"; ?></p>  
                                            </h5>
                                            
                                        </td>
                                        <td class="p-price first-row">$ <?php echo "$sneakerprice"; ?>.00</td>
                                        <td class="qua-col first-row">
                                            x <?php echo "$quantity"; ?>
                                        </td>
                                        <td class="total-price first-row">$ <?php echo "$subtotal"; ?>.00</td>
                                        <td class="close-td first-row">
                                            <a href="shoppingCart.php?action=delete&id=<?php echo $values["item_id"]; ?>" class="trash">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php } }?>
                               
                            </tbody>
                        </table>
                    </div>  
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="shop.php" class="primary-btn continue-shop">Continue shopping 
                                </a>
                                <a href="shoppingCart.php?action=deleteall" class="primary-btn up-cart">Clear Cart 
                                    &nbsp;<i class="fas fa-trash-alt"> </i></a>
                            </div>    
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>$ <?php echo "$total"; ?>.00</span></li>
                                    <li class="subtotal">Delivery fee <span>$5.00</span></li>
                                    <li class="subtotal">Service Charges <span>$1.00</span></li>
                                    <li class="cart-total">Total <span>$ <?php echo "$grandtotal"; ?>.00</span></li>
                                </ul>
                                <a href="checkout.php" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

        <!-- footer component -->
    <?php include('components/footer.php'); ?>
</body>

</html>