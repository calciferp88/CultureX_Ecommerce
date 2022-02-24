<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="col-lg-3 col-sm-6">
	    <div class="product-item">
	        <div class="pi-pic">
	            <img src="<?php echo($image) ?>" alt="">
	            <div class="sale pp-sale">Sale</div>
	            <div class="icon">
	                <i class="icon_heart_alt"></i>
	            </div>
	            <ul>
	                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
	                <?php echo "<li class='quick-view'>
	                                <a href='sneaker.php?sneakerid=$snid'>Shop Now</a>
	                            </li>"; ?>
	                
	                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>  
	            </ul>  
	        </div>
	        <div class="pi-text">
	            <div class="catagory-name">
	                <?php echo "$brand";?> | <?php echo "$category"; ?>
	            </div>
	            <a href="sneaker.php?sneakerid=<?php echo($snid) ?>" class="name-tag">
	                <h4><?php echo "$snname"; ?></h4>
	            </a>        
	            <div class="product-price">
	                <?php echo "$ $snprice"; ?>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>