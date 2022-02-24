<?php 

    include('adminheader.php');

    if (isset($_POST['btn-edit'])) 
    {
        $categoryided       = $_POST['txtcategoryid'];
        $categorynameedit   = $_POST['txtcategoryname'];

        $updatecategory = "
        UPDATE `category` 
        SET `categoryName`='$categorynameedit'
        WHERE `categoryID`='$categoryided'
        ";

        $run = mysqli_query($connect, $updatecategory);                    

        if($run)
        {  
            echo "<script>
            alert('$categorynameedit Updated !');
            window.location.assign('managecategory.php');        
            </script>";                   
        }       
                        
        else { echo mysqli_error($connect); }
    }   

  

 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Category List | CultureX Admin</title>   
</head>
<body>                  
  <div id="page-wrapper" ><br><br>
        <div class="header"> 
            <h1 class="page-header">Category List </h1>
            <ol class="breadcrumb">   
                <li><a href="#">Home</a></li> 
                <li class="active">Manage Category</li>
            </ol>   
        </div>
        
        <div id="page-inner">   

            <?php 

                if (isset($_GET['edit'])) 
                { 
                    $categoryided    = $_GET['categoryid'];
                    $selectcategoryedit = "SELECT * FROM category WHERE categoryID = '$categoryided' ";  
                    $runcategoryedit    = mysqli_query($connect, $selectcategoryedit);
                    $rowcategoryedit    = mysqli_fetch_array($runcategoryedit);

                    $categoryname    = $rowcategoryedit['categoryName'];

                    echo "
                            <form class='edit-form' action='managecategory.php' method='POST' >

                                <input type='hidden' class='validate' name='txtcategoryid' value='$categoryided' required>

                                <div class='row'>
                                    <label for='CategoryName'>Category Name</label>
                                    <div class='input-field col s12'>
                                      <input type='text' class='validate' name='txtcategoryname' value='$categoryname' required>
                                    </div>
                                </div>


                                <button style='padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;' type='submit' name='btn-edit'>Confirm</button>
                                <button style='padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;' type='reset'>Reset</button>

                            </form><br><br> ";
                }

                if (isset($_GET['delete']))
                    {
                        $categoryidde         = $_GET['categoryid'];
                        $deletecategorydelete = "DELETE FROM category WHERE categoryID = '$categoryidde' ";  
                        $runcategorydelete    = mysqli_query($connect, $deletecategorydelete);
                        if($runcategorydelete)
                        {  
                            echo "<script>
                            alert('Category Deleted !');
                            window.location.assign('managecategory.php');        
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
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $selectcategory = "SELECT * FROM category";
                                        $runcategory = mysqli_query($connect, $selectcategory);
                                        $countcategory = mysqli_num_rows($runcategory);

                                        for ($i=0;$i<$countcategory;$i++)
                                        {
                                            $rowcategory   = mysqli_fetch_array($runcategory);
                                            $categoryid    = $rowcategory['categoryID'];
                                            $categoryname  = $rowcategory['categoryName'];

                                            echo "
                                            
                                                <tr class='odd gradeX'>
                                                    <td>$categoryid</td>
                                                    <td>$categoryname</td>
                                                  
                                                    <td> 
                                                        <a href='managecategory.php?edit&&categoryid=$categoryid' class='list-edit'>Edit |</a> 
                                                        <a href='managecategory.php?delete&&categoryid=$categoryid' class='list-delete'>Delete</a> 
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