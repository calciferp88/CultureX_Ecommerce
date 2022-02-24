    <?php 

	include('components/header.php');


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Shop | CultureX</title>
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
                            <a href="shop.php">Shop</a>
                </div> </div>   </div> </div>
        </div>                     
        <!-- Breadcrumb Section End -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad" style="margin-top: -45px;">
        <div class="container">

            <!-- main product list -->
            <div class="row">
                   
                <div class="col-lg-12 order-1 order-lg-2"> 
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <form>
                                    <label style="font-weight: bold; font-size: 20px;">Sort by</label>
                                    <select class="input-select" name="sortby" onchange="this.form.submit()">
                                        <option disabled selected>something</option>
                                        <option value="default">Default</option>
                                        <option value="priceH">Higher Price</option>
                                        <option value="priceL">Less Price</option>
                                        <option value="date">New items</option>
                                    </select>
                                </form>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                            </div>
                        </div>
                    </div>


                    <?php 

                      if (isset($_POST['btn-search'])) 
                      {
                        $content = $_POST['txtsearch'];

                     ?>

                       <div class="product-list">

                          <h1><?php echo "Results for $content |"; ?></h1><br>
                          <div class="row">

                              <?php   

                                 $selectproduct = "SELECT * FROM sneaker 
                                                   WHERE sneakerName LIKE '%$content%'
                                                   ORDER BY totalSale DESC";
                                 $runproduct = mysqli_query($connect, $selectproduct);
                                 $countproduct = mysqli_num_rows($runproduct);

                                 for ($i=0; $i < $countproduct; $i++)  
                                { 
                                  $rowproduct  = mysqli_fetch_array($runproduct);
                                  $snid        = $rowproduct['sneakerID'];  
                                  $snname      = $rowproduct['sneakerName'];
                                  $snprice     = $rowproduct['sneakerPrice'];  
                                  $image       = $rowproduct['productImage1'];
                                  $instock     = $rowproduct['inStock'];  
                                  $brandid     = $rowproduct['brandID'];
                                  $categoryid  = $rowproduct['categoryID'];
                                  $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                  $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                  include('components/product.php');
                               } ?>
      
                          </div>
                      </div>

                   <?php } ?>

                    <!-- Search by category -->
                    <?php if (isset($_GET['subcate'])) {
                            $subcategoryid = $_GET['subcate'];  

                            if ($subcategoryid == "men") 
                            {
                           
                    ?>
                            <div class="product-list">

                                <h1><?php echo "For Men |"; ?></h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         WHERE sneakerSubCategory = 'Men'
                                                         ORDER BY totalSale DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                     } ?>
            
                                </div>
                            </div>
                    <?php }  ?>  

                    <?php 

                        if ($subcategoryid == "women") 
                        {
                              

                     ?>


                     <div class="product-list">

                                <h1><?php echo "For Ladies |"; ?></h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         WHERE sneakerSubCategory = 'Women'
                                                         ORDER BY totalSale DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                     } ?>
            
                                </div>
                            </div>

                     <?php } ?>

                    <?php 

                        if ($subcategoryid == "sport") 
                        {
                        
                     ?>

                     <div class="product-list">

                                <h1><?php echo "For Men |"; ?></h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         WHERE sneakerSubCategory = 'Sport'
                                                         ORDER BY totalSale DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                     } ?>
            
                                </div>
                            </div>


                 <?php }} ?>


                    <!-- Search by category -->
                    <?php if (isset($_GET['categoryid'])) {
                            $categoryid = $_GET['categoryid'];  
                             $category   = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');?>
                            <div class="product-list">

                                <h1><?php echo "$category |"; ?></h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         WHERE categoryID = '$categoryid'
                                                         ORDER BY totalSale DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                     } ?>
            
                                </div>
                            </div>
                    <?php } ?>  

                    <!-- Search by Brands -->
                    <?php if (isset($_GET['brandid'])) {
                            $brandid = $_GET['brandid']; 
                            $brand   = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');?>
                            <div class="product-list">

                                <h1><?php echo "$brand |"; ?></h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         WHERE brandID = '$brandid'
                                                         ORDER BY totalSale DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                    } ?>
            
                                </div>
                            </div>
                    <?php } ?>  

                    <!-- Sort BY functions -->
                    <?php if (isset($_GET['sortby'])) {
                            $method = $_GET['sortby']; 
                            if ($method == "priceH") {     
                    ?>       
                            <!-- sort by higher price -->
                            <div class="product-list">

                                <h1>Items sorted by higher price</h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         ORDER BY sneakerPrice DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                    } ?>
            
                                </div>
                            </div>
                    <?php } 

                        if ($method == "priceL") { 
                    ?> 

                            <!-- sort by less price -->
                            <div class="product-list">

                                <h1>Items sorted by Less price</h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         ORDER BY sneakerPrice ASC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                    } ?>
            
                                </div>
                            </div>

                    <?php } 
                        if ($method == "date") { 
                    ?>
                            <!-- sort by less price -->
                            <div class="product-list">

                                <h1>New items</h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker ORDER BY onSaleDate DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                    } ?>
            
                                </div>
                            </div>

                    <?php }  
                         if ($method == "default" && !isset($_POST['btn-search'])) { 
                    ?>

                        <!-- Default sort -->
                        <div class="product-list">

                                    <h1>Best Sellers</h1><br>
                                    <div class="row">

                                        <?php   

                                           $selectproduct = "SELECT * FROM sneaker ORDER BY totalSale DESC";
                                           $runproduct = mysqli_query($connect, $selectproduct);
                                           $countproduct = mysqli_num_rows($runproduct);

                                           for ($i=0; $i < $countproduct; $i++)  
                                          { 
                                            $rowproduct  = mysqli_fetch_array($runproduct);
                                            $snid        = $rowproduct['sneakerID'];  
                                            $snname      = $rowproduct['sneakerName'];
                                            $snprice     = $rowproduct['sneakerPrice'];  
                                            $image       = $rowproduct['productImage1'];
                                            $instock     = $rowproduct['inStock'];  
                                            $brandid     = $rowproduct['brandID'];
                                            $categoryid  = $rowproduct['categoryID'];
                                            $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                            $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                            include('components/product.php');
                                        } ?>
                
                                    </div>
                        </div>
                    <?php }}  ?>

                    <!-- Defaut -->
                    <?php if (empty($_GET) && !isset($_POST['btn-search'])) { ?>
                            <div class="product-list">

                                <h1>Best Sellers</h1><br>
                                <div class="row">

                                    <?php   

                                       $selectproduct = "SELECT * FROM sneaker 
                                                         ORDER BY totalSale DESC";
                                       $runproduct = mysqli_query($connect, $selectproduct);
                                       $countproduct = mysqli_num_rows($runproduct);

                                       for ($i=0; $i < $countproduct; $i++)  
                                      { 
                                        $rowproduct  = mysqli_fetch_array($runproduct);
                                        $snid        = $rowproduct['sneakerID'];  
                                        $snname      = $rowproduct['sneakerName'];
                                        $snprice     = $rowproduct['sneakerPrice'];  
                                        $image       = $rowproduct['productImage1'];
                                        $instock     = $rowproduct['inStock'];  
                                        $brandid     = $rowproduct['brandID'];
                                        $categoryid  = $rowproduct['categoryID'];
                                        $brand       = GET_ATTRIBUTE('brand', 'brandID', $brandid, 'brandName');
                                        $category    = GET_ATTRIBUTE('category', 'categoryID', $categoryid, 'categoryName');
                                        include('components/product.php');
                                    } ?>
            
                                </div>
                            </div>
                    <?php } ?>  

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