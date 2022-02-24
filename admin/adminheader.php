<?php 
    session_start();
    include('assets\scripts\functions.php');
    $connect = mysqli_connect("localhost", "root", "", "CultureXdb");

    if (isset($_SESSION['staffemail'])) 
    {
       $mymail = $_SESSION['staffemail'];
       $staffname = GET_ATTRIBUTE('staff', 'cultureXMail', $mymail, 'staffName');
       $staffrole = GET_ATTRIBUTE('staff', 'cultureXMail', $mymail, 'staffRole');    
       $staffid   = GET_ATTRIBUTE('staff', 'cultureXMail', $mymail, 'staffID'); 
   }

    else
    {
        echo "<script>
               alert('You do not have access permission to Admin Page ! ');
               window.location.assign('../login.php');
               </script>";
    }

 ?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" >

    <!-- Favicon -->
    <link rel="icon" href="assets/img/culturexLogo_trans.png">

    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
    
      
    </style>
</head>		

<body >			
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">	
                <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span>    
                </button>		 
                <a class="navbar-brand waves-effect waves-dark" href="adminhome.php"> <strong>CultureX.com</strong></a>
									 	
		     <div id="sideNav" href=""><i class="material-icons dp48"><tbody></tbody>c</i></div>
            </div>

            <ul class="nav navbar-top-links navbar-right">   
				  <li><a class="dropdown-button waves-effect " href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b><?php echo "$staffname"; ?></b> <i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </nav>	

			<!-- dropdown1down Structure -->						  	
			<ul id="dropdown1" class="dropdown-content">
				<li>
                    <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>
			
			
	   <!-- Side Nav -->	
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">

                <ul class="nav" id="main-menu">	

                	<!-- DashBoard -->
                    <li>
                        <a href="adminhome.php" class="waves-effect ">  
                        	<i class="fas fa-tachometer-alt"></i> Dashboard   
                        </a>
                    </li> 


                    <?php 

                        if ($staffrole == 'Admin') 
                        {   
                            echo "
                                <li>
                                    <a class='waves-effect'><i class='fas fa-users'></i> Manage Staffs<span class='fa arrow'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a href='managestaff.php'><i class='fas fa-list'></i> Staff List</a>
                                        </li>
                                        <li>
                                            <a href='addstaff.php'><i class='fas fa-user-plus'></i> Register Staffs</a>
                                        </li>
                                        
                                    </ul>   
                                </li>

                                
                            ";
                        }
                     ?>		 

                     <!-- users -->
                     <li>
                        <a class='waves-effect' href='manageuser.php'><i class='fas fa-users'></i> CultureX Users</a>  
                    </li>
                   

                    <!-- Brand -->
                    <li>
                        <a href="#" class="waves-effect "><i class="fa fa-flag"></i>Manage Brands<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level" >

                            <li>
                                <a href="managebrand.php"><i class="fas fa-list"></i> Brand List</a>
                            </li>

                            <li>
                                <a href="addbrand.php"><i class="fas fa-plus"></i> Add Brand</a>
                            </li>

                        </ul>
                    </li>

                    <li> 		
                        <a href="#" class="waves-effect "><i class="fas fa-layer-group"></i> Manage Category<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="managecategory.php"><i class="fas fa-list"></i> Category List</a>
	                        </li>

                            <li>
                                <a href="addcategory.php"><i class="fas fa-plus"></i> Add Category</a>
                            </li>
                        </ul>		 		            
                    </li>

                </ul>	

            </div>

        </nav>
        <!--NAV SIDE  -->  


    <!-- WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>		
	
	<!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/materialize/js/materialize.min.js"></script>
	
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	
	
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	
	<script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#usertable').dataTable();
            });
    </script>
	
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script> 
 

</body>

</html>     