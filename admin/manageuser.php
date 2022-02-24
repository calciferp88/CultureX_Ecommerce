<?php 

    include('adminheader.php');

 ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>User List | CultureX Admin</title>   
    </head>
    <body>                  
      <div id="page-wrapper" ><br><br>
            <div class="header"> 
                            <h1 class="page-header">
                                CultureX Users
                            </h1>
                            <ol class="breadcrumb">   
                          <li><a href="#">Home</a></li> 
                          <li class="active">Manage Users</li>
                        </ol> 
                                                
            </div>
            
            <div id="page-inner">   
                
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="card">
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="usertable">
                                    
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>From</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $selectuser = "SELECT * FROM user";
                                        $runuser = mysqli_query($connect, $selectuser);
                                        $countuser = mysqli_num_rows($runuser);

                                        for ($i=0;$i<$countuser;$i++)
                                        {
                                            $rowuser    = mysqli_fetch_array($runuser);
                                            $userid     = $rowuser['userID']; 
                                            $username   = $rowuser['userName'];
                                            $usermail   = $rowuser['userEmail'];
                                            $phone      = $rowuser['userPhone'];
                                            $seller     = $rowuser['sellerStatus'];    
                                            $country    = $rowuser['userCountry'];

                                            if ($seller == 1) 
                                            {
                                                $status ="Seller";
                                            }
                                            else if ($seller==0) {
                                                $status = "User";
                                            }

                                            echo "
                                            
                                                <tr class='odd gradeX'>
                                                    <td>$userid</td>   
                                                    <td>$username</td>
                                                    <td>$usermail</td>
                                                    <td>$phone</td>
                                                    <td>$status</td>
                                                    <td>$country</td>
                                                </tr>   
                                            
                                            ";
                                        }
                                    ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
           
         
               <footer><p>Copyright 2022 &copy; CultureX all rights reserved.</footer>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
</body>
</html>     