<?php 

    include('adminheader.php');

    if (isset($_POST['btn-edit'])) 
    {
        $brandidedit       = $_POST['txtbrandid'];
        $brandnameedit     = $_POST['txtbrandname'];

        $updatebrand = "
        UPDATE `brand` 
        SET `brandName`= '$brandnameedit'
        WHERE `brandID`='$brandidedit'
        ";

        $run = mysqli_query($connect, $updatebrand);                    

        if($run)
        {  
            echo "<script>
            alert('$brandName Updated !');
            window.location.assign('managebrand.php');        
            </script>";                   
        }       
                        
        else { echo mysqli_error($connect); }
    }   



 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Brand List | CultureX Admin</title>   
</head>
<body>                  
  <div id="page-wrapper" ><br><br>
        <div class="header"> 
                        <h1 class="page-header">Brand List </h1>
                        <ol class="breadcrumb">   
                          <li><a href="#">Home</a></li> 
                          <li class="active">Manage Brand</li>
                        </ol> 
                                            
        </div>
        
        <div id="page-inner">   

            <?php 

                if (isset($_GET['edit'])) 
                { 
                    $brandided       = $_GET['brandid'];
                    $selectbrandedit = "SELECT * FROM brand WHERE brandID = '$brandided' ";  
                    $runbrandedit    = mysqli_query($connect, $selectbrandedit);
                    $rowbrandedit    = mysqli_fetch_array($runbrandedit);

                    $brandname    = $rowbrandedit['brandName'];

                    echo "
                            <form class='edit-form' action='managebrand.php' method='POST' >

                                <input type='hidden' class='validate' name='txtbrandid' value='$brandided' required>

                                <div class='row'>
                                    <label for='StaffName'>Brand Name</label>
                                    <div class='input-field col s12'>
                                      <input type='text' class='validate' name='txtbrandname' value='$brandname' required>
                                    </div>
                                </div>

                                <button style='padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;' type='submit' name='btn-edit'>Confirm</button>
                                <button style='padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;' type='reset'>Reset</button>

                            </form><br><br> ";
                }

                if (isset($_GET['delete']))
                    {
                        $brandidde         = $_GET['brandid'];
                        $deletebranddelete = "DELETE FROM brand WHERE brandID = '$brandidde' ";  
                        $runbranddelete    = mysqli_query($connect, $deletebranddelete);
                        if($runbranddelete)
                        {  
                            echo "<script>
                            alert('Brand Deleted !');
                            window.location.assign('managebrand.php');        
                            </script>";                   
                        }       
                                                        
                        else { echo mysqli_error($connect); }
                        
                    }

             ?> 
    
                
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="card">
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Brand Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $selectbrand = "SELECT * FROM brand";
                                        $runbrand = mysqli_query($connect, $selectbrand);
                                        $countbrand = mysqli_num_rows($runbrand);

                                        for ($i=0;$i<$countbrand;$i++)
                                        {
                                            $rowbrand   = mysqli_fetch_array($runbrand);
                                            $brandid    = $rowbrand['brandID'];
                                            $brandname  = $rowbrand['brandName'];

                                            echo "
                                            
                                                <tr class='odd gradeX'>
                                                    <td>$brandid</td>
                                                    <td>$brandname</td>
                                                   
                                                    <td> 
                                                        <a href='managebrand.php?edit&&brandid=$brandid' class='list-edit'>Edit |</a> 
                                                        <a href='managebrand.php?delete&&brandid=$brandid' class='list-delete'>Delete</a> 
                                                    </td>
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