<?php 
	
	include('components/header.php');
	$myemail = $_SESSION['myemail'];
	$myid    = GET_ATTRIBUTE('user', 'userEmail', $myemail, 'userID');

  if (isset($_GET['deleteauid'])) 
  {
    $deleteauid = $_GET['deleteauid'];
    $deleteau   = "DELETE FROM auction WHERE auctionID = '$deleteauid' ";
    $rundeleteau = mysqli_query($connect, $deleteau);
    if ($rundeleteau)
    {
      echo "<script>
        alert('Your auction is removed');
      </script>";
    }
  }
 ?>


		
<!DOCTYPE html>
<html>
<head>
	<title></title>



	<style type="text/css">

       	.table-div .table-responsive table
       	{
       		width: 90%;
       		margin: 50px;
       	}

       	td .edit
       	{
       		color: green;
       		cursor: pointer;

       	}

       	td .delete
       	{
       		color: red;
       		cursor: pointer;
       	}

       	td .edit:hover
       	{
       	    color: green;
       	}

       	td .delete:hover
       	{
       	    color: red;
       	}

	</style>
	
</head>

<body>
	<br><br><br><br>
	<!-- Breadcrumb Section Begin --> 
	<div class="breacrumb-section"> <div
	class="container"> <div class="row"> <div class="col-lg-12"> <div
	class="breadcrumb-text product-more">   <a href="./index.html"><i
	class="fa fa-home"></i> Home</a> <a href="./shop.html">Seller Tools</a>
	<span>My Items</span>         </div> </div>   </div> </div>
	</div>     <!-- Breadcrumb Section End -->


      <div class="rowp">

        <div class="col-100 display-div2">

        <h4>My Active Auctions</h4>

          <table>

            <tr>
              <th>Sneaker</th>  
              <th>Current Bid</th>
              <th>Headshot Price</th>
              <th>Auctioneer</th>
              <th>End In</th>
              <th></th>
            </tr>

            <?php   

               $selectmyauction = "SELECT * FROM auction a, sneaker s 
                              WHERE a.sneakerID = s.sneakerID
                              AND s.sellerID = '$myid'
                              AND a.auctionStatus = 'Active' ";
               $runmyauction   = mysqli_query($connect, $selectmyauction);
               $countmyauction = mysqli_num_rows($runmyauction);            

              for ($i=0; $i < $countmyauction; $i++)  
              { 
                $rowmyauction    = mysqli_fetch_array($runmyauction);
                $myauctionid     = $rowmyauction['auctionID'];  
                $myauctionend    = $rowmyauction['endDate'];  
                $myhaedshot      = $rowmyauction['headshotPrice'];  
                $mycurrentbid    = $rowmyauction['currentBid'];  
                $myauctionerid   = $rowmyauction['currentAuctioneer'];  
                $myauctioneer    = GET_ATTRIBUTE('user', 'userID', $myauctionerid, 'userName');  
                $mysneakerid     = $rowmyauction['sneakerID'];  
                $mysneaker       = GET_ATTRIBUTE('sneaker', 'sneakerID', $mysneakerid, 'sneakerName'); 

                echo "   
                <tr>   
                  <td>$mysneaker</td>
                  <td>$ $mycurrentbid</td> 
                  <td>$myhaedshot</td>  
                  <td>$myauctioneer</td> 
                  <td>$myauctionend</td>
                  <td>
                      <a href='auctionlist.php?deleteauid=$myauctionid' class='btn-link'> DELETE </a>
                  </td>
                </tr>";

                
              } 
                  
            ?>
          
          </table>  
          <?php 
             if ($countmyauction == 0) 
              {
                echo "<p ><center class='text-danger'>*You have no active auctions*</center></p>";
              }
         ?> 
        </div>     
      </div> 

      <div class="rowp">

        <div class="col-100 display-div2">

        <h4>Expired and Completed Auctions</h4>

          <table>

            <tr>
              <th>Sneaker</th>  
              <th>Current Bid</th>
              <th>Headshot Price</th>
              <th>Auctioneer</th>
              <th>Status</th>
            </tr>

            <?php   

               $selectmyauction = "SELECT * FROM auction a, sneaker s 
                              WHERE a.sneakerID = s.sneakerID
                              AND s.sellerID = '$myid'
                              AND a.auctionStatus != 'Active' ";
               $runmyauction   = mysqli_query($connect, $selectmyauction);
               $countmyauction = mysqli_num_rows($runmyauction);            

              for ($i=0; $i < $countmyauction; $i++)  
              { 
                $rowmyauction    = mysqli_fetch_array($runmyauction);
                $myauctionid     = $rowmyauction['auctionID'];  
                $myauctionend    = $rowmyauction['endDate'];  
                $myhaedshot      = $rowmyauction['headshotPrice'];  
                $mycurrentbid    = $rowmyauction['currentBid'];  
                $myauctionerid   = $rowmyauction['currentAuctioneer'];  
                $myauctionstt    = $rowmyauction['auctionStatus'];
                $myauctioneer    = GET_ATTRIBUTE('user', 'userID', $myauctionerid, 'userName');  
                $mysneakerid     = $rowmyauction['sneakerID'];  
                $mysneaker       = GET_ATTRIBUTE('sneaker', 'sneakerID', $mysneakerid, 'sneakerName'); 

                echo "   
                <tr>   
                  <td>$mysneaker</td>
                  <td>$ $mycurrentbid</td> 
                  <td>$myhaedshot</td>  
                  <td>$myauctioneer</td> 
                  <td>$myauctionstt</td>
                </tr>";

                
              } 
                  
            ?>
          
          </table>  
          <?php 
             if ($countmyauction == 0) 
              {
                echo "<p ><center class='text-danger'>*You have no active auctions*</center></p>";
              }
         ?> 
        </div>     
      </div> 
          <!-- footer component -->
    <?php include('components/footer.php'); ?>            
             

</body>


 <script>
	var loadFile1 = function(event) {
		var image1 = document.getElementById('output1');
		image1.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile2 = function(event) {
		var image2 = document.getElementById('output2');
		image2.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile3 = function(event) {
		var image3 = document.getElementById('output3');
		image3.src = URL.createObjectURL(event.target.files[0]);
	};

	var loadFile4 = function(event) {
		var image4 = document.getElementById('output4');
		image4.src = URL.createObjectURL(event.target.files[0]);    
	};

	var loadFile5 = function(event) {
		var image5 = document.getElementById('output5');
		image5.src = URL.createObjectURL(event.target.files[0]);
	};



</script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>

    <script src="assets/js/jquery-1.10.2.js"></script>		
	
	<!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/materialize/js/materialize.min.js"></script>
	
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	
	
	<script src="themes/js/easypiechart.js"></script>
	<script src="themes/js/easypiechart-data.js"></script>
	
	<script src="themes/js/Lightweight-Chart/jquery.chart.js"></script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="themes/js/dataTables/jquery.dataTables.js"></script>
    <script src="themes/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();  
            });
    </script>
	
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script> 

</body>

</html>