<?php 

	include('components/header.php');

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Home | CultureX </title>
 	<style type="text/css">

        .search
        {
            position: absolute;
            z-index: 100000;
            left: 40%;
            top: 50%;
        }

        #myBtn {
          display: none;
          position: fixed;
          bottom: 20px;
          right: 30px;
          z-index: 99;
          font-size: 18px;
          border: none;
          outline: none;
          background-color: #e7ab3c;
          color: white;
          cursor: pointer;
          padding: 15px;
          border-radius: 4px;
        }

        #myBtn:hover {
          background-color: #555;
        }

        html {
          scroll-behavior: smooth;
        }
		
 	</style>
 </head>
 
 <body>

    <!-- advertisement component -->
    <?php include('components/advertisement.php'); ?>

	<!-- Banner Section Begin -->
    <div class="banner-section spad">

        <div class="container-fluid">
            <div class="product-list">
            <h1 style="">Shop by Sneaker Types |</h1><br>
            </div>
            <div class="row">   
                <div class="col-lg-4">
                    <div class="single-banner">
                        <a href="shop.php?subcate=men">
                            <img src="themes/img/banner-1.jpg" alt="">
                            <div class="inner-text">
                                <h4>Men’s</h4>
                            </div>
                        </a>
                    </div>   
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <a href="shop.php?subcate=women">
                            <img src="themes/img/banner-2.jpg" alt="">
                            <div class="inner-text">   
                                <h4>Women’s</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">     
                        <img src="themes/img/banner-6.jpg" alt="">
                        <div class="inner-text">
                            <a href="shop.php?subcate=sport"><h4>Sport</h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad" style="margin-top: -45px;">
        <div class="container">

            <!-- main product list -->
            <div class="row">
                   
                <div class="col-lg-12 order-1 order-lg-2"> 
                    <div class="product-show-option">
                       
                    </div>
                    <!-- Defaut -->
                    <div class="product-list">

                        <h1 style="">Trending</h1><br>
                        <div class="row">

                            <?php   

                               $selectproduct = "SELECT * FROM sneaker 
                                                 ORDER BY totalSale DESC
                                                 LIMIT 16";
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
                   

                    <!-- Sort by   -->

                    <!-- footer loading -->
                    <div class="loading-more">
                        <a href="shop.php">
                            More Sneakers
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- Product Shop Section End -->

        <!-- Deal Of The Week Section Begin-->
    <section class="deal-of-week set-bg spad" style="background-image: url('themes/img/time-bg.jpg');">
        <div class="container">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>Get Limited Edition Nike Bag just with $ 350.00 only this week. </p>
                    <div class="product-price">
                        $350.00
                        <span>/ HanBag</span>
                    </div>
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span>56</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span>12</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span>40</span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span>52</span>
                        <p>Secs</p>
                    </div>
                </div>
                <a href="#" class="primary-btn">Shop Now</a>
            </div>
        </div>
    </section>
    <!-- Deal Of The Week Section End -->

        <!-- Map Section Begin -->
    <div class="map spad">
        <center>
            <div class="contact-title">
                <h4>Our location !</h4>
                <p>We are warmly welcome all of our customers to our shop !</p>
            </div>
        </center>
        <div class="container">
            <div class="map-inner">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d283.8424571953353!2d96.19311415181835!3d16.83063803621489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c193287651d4f5%3A0x3f650220619ad802!2sPagoda%20Street%20Bus%20Stop!5e0!3m2!1sen!2smm!4v1645722625589!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <div class="icon" >
                    <i class="fa fa-map-marker"></i>
                </div><div  id="contact"></div>
            </div>
        </div>
    </div>
    <!-- Map Section Begin -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h4>Contacts Us</h4>
                        <p>Contact CultureX for more information about our sneakers. We have 24/7 service for our beloved customers.</p>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="ci-text">
                                <span>Address:</span>
                                <p>55B Lay Daung Kan Road, Thingangyun, Yangon</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="ci-text">
                                <span>Phone:</span>
                                <p>+95 9796465647</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="ci-text">
                                <span>Email:</span>
                                <p>service.culturex@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Leave A Comment</h4>
                            <p>Our staffs will call back later and answer your questions.</p>
                            <form action="#" class="comment-form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Your name" style="margin-left: 0px;">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Your email">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Your message"></textarea>
                                        <button type="submit" class="site-btn">Send message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->



    <!-- Faq Section Begin -->
    <div class="faq-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-title">
                        <h4>Frequently Asked Questions</h4>
                        <p>Following are FQAs that we are used to be asked by our customers.</p>
                    </div>
                    <div class="faq-accordin">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading active">
                                    <a class="active" data-toggle="collapse" data-target="#collapseOne">
                                        Do we need to pay monthly or anaually for seller accounts ?
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>
                                            Not actually. It will cause only $29 for parmanent seller accounts.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">
                                        How is service changes for ordering sneakers on CultureX ?
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>
                                            Our service charges cost only $1 for each order. How cool !
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">
                                        Which delivery service do you use for orders ?
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>We are partners with Quick delivery service. It is one of the best delivery service in Yangon. Fast and Loyal !<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Faq Section End -->

    <!-- Scroll to top -->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

    <!-- footer component -->
    <?php include('components/footer.php'); ?>

    <script>
        var slideIndex = 0;

        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}    
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 3000); // Change image every 2 seconds
        }

        window.onload = showSlides;
    </script>

    <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
  

 </body>
 </html> 		