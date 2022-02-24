<?php 

    include('adminheader.php');

    if (isset($_POST['btn-edit'])) 
    {
        $staffidedit       = $_POST['txtstaffid'];
        $staffnameedit     = $_POST['txtstaffname'];
        $pimshopmailedit   = $_POST['txtpimshopmail'];
        $staffemailedit    = $_POST['txtemail'];    
        $staffphoneedit    = $_POST['txtphone']; 
        $staffpasswordedit  = $_POST['txtpassword'];
        $hash = md5($staffpasswordedit); 

        if($staffpasswordedit == '')
        {

            $updatestaff = "
            UPDATE `staff`  
            SET `staffName`='$staffnameedit', `cultureXMail`='$pimshopmailedit',`staffEmail`='$staffemailedit' ,`staffPhone`='$staffphoneedit' WHERE `staffID`='$staffidedit'
            ";

            $run = mysqli_query($connect, $updatestaff);                    

            if($run)
            {  
                echo "<script>
                alert('Staff Information Updated ! ');
                window.location.assign('managestaff.php');        
                </script>";                   
            }       
                            
            else { echo mysqli_error($connect); }
        }

        else{
            $updatestaff = "
            UPDATE `staff`  
            SET `staffName`='$staffnameedit', `cultureXMail`='$mailedit',`staffEmail`='$staffemailedit' ,`staffPhone`='$staffphoneedit', `staffPassword` ='$hash' WHERE `staffID`='$staffidedit'
            ";

            $run = mysqli_query($connect, $updatestaff);                    

            if($run)
            {  
                echo "<script>
                alert('Staff Information Updated ! Including Password ');
                window.location.assign('managestaff.php');        
                </script>";                   
            }       
                            
            else { echo mysqli_error($connect); }
        }


        
    }   

 ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Staff List | CultureX Admin</title>   
    </head>
    <body>                  
      <div id="page-wrapper" ><br><br>
            <div class="header"> 
                            <h1 class="page-header">
                                Staffs List
                            </h1>
                            <ol class="breadcrumb">   
                          <li><a href="#">Home</a></li> 
                          <li class="active">Manage Staff</li>
                        </ol> 
                                                
            </div>
            
            <div id="page-inner">   

                <?php 

                    if (isset($_GET['edit'])) 
                    { 
                        $staffided       = $_GET['staffid'];
                        $selectstaffedit = "SELECT * FROM staff WHERE StaffID = '$staffided' ";  
                        $runstaffedit    = mysqli_query($connect, $selectstaffedit);
                        $rowstaffedit    = mysqli_fetch_array($runstaffedit);

                        $staffname     = $rowstaffedit['staffName'];
                        $cultureXMail   = $rowstaffedit['cultureXMail'];
                        $staffemail    = $rowstaffedit['staffEmail'];     
                        $staffphone    = $rowstaffedit['staffPhone'];
                        $staffpassword = $rowstaffedit['staffPassword'];
                        echo "
                                <form class='edit-form' action='managestaff.php' method='POST' >

                                    <input type='hidden' class='validate' name='txtstaffid' value='$staffided  ' required>

                                    <div class='row'>
                                        <label for='StaffName'>Staff Name</label>
                                        <div class='input-field col s12'>
                                          <input type='text' class='validate' name='txtstaffname' value='$staffname' required>
                                        </div>
                                    </div>

                                    <div class='row'>
                                          <label for='StaffName'>CultureX User Name</label>
                                        <div class='input-field col s12'>
                                          <input type='text' class='validate' name='txtpimshopmail' value='$cultureXMail' required>
                                        </div>
                                    </div>
      
                                    <div class='row'>   
                                    <label for='password'>Email & Phone</label><br>
                                        <div class='input-field col s6'>
                                          <input type='text' class='validate' name='txtemail' value='$staffemail' required>
                                        </div>

                                    <div class='input-field col s6'>
                                      <input type='text' class='validate' name='txtphone' value='$staffphone' required>
                                    </div>    
                                </div> 

                                <div class='row'>
                                      <label for='txtpassword'>Password</label><br>
                                    <p style='color: #e7ab3c;'>Leave this field empty if you don't want to update password.</p>
                                    <div class='input-field col s12'>
                                      <input type='text' class='validate' name='txtpassword'>
                                    </div>      
                                </div>
                            

                                <button style='padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;' type='submit' name='btn-edit'>Confirm</button>
                                <button style='padding: 10px; width: 100px; background-color: #e7ab3c; border: none; color: white;' type='reset'>Reset</button>

                            </form><br><br> ";
                }

                if (isset($_GET['delete'])) 
                    {
                        $staffidde         = $_GET['staffid'];
                        $deletestaffdelete = "DELETE FROM staff WHERE staffID = '$staffidde' ";  
                        $runstaffdelete    = mysqli_query($connect, $deletestaffdelete);
                        if($runstaffdelete)
                        {  
                            echo "<script>
                            alert('Staff Deleted !');
                            window.location.assign('managestaff.php');        
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
                                <table class="table table-striped table-bordered table-hover" id="usertable">
                                    
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Staff Name</th>
                                            <th>CultureX Username</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $selectstaff = "SELECT * FROM staff";
                                        $runstaff = mysqli_query($connect, $selectstaff);
                                        $countstaff = mysqli_num_rows($runstaff);

                                        for ($i=0;$i<$countstaff;$i++)
                                        {
                                            $rowstaff    = mysqli_fetch_array($runstaff);
                                            $staffid     = $rowstaff['staffID']; 
                                            $staffname   = $rowstaff['staffName'];
                                            $pimshopmail = $rowstaff['cultureXMail'];
                                            $staffemail   = $rowstaff['staffEmail'];    
                                            $staffphone   = $rowstaff['staffPhone'];
                                            $staffaddress = $rowstaff['staffGender'];
                                            $staffrole    = $rowstaff['staffRole'];

                                            echo "
                                            
                                                <tr class='odd gradeX'>
                                                    <td>$staffid</td>   
                                                    <td>$staffname</td>
                                                    <td>$pimshopmail</td>
                                                    <td>$staffemail</td>
                                                    <td>$staffphone</td>
                                                    <td>$staffrole</td>
                                                    <td> 
                                                        <a href='managestaff.php?edit&&staffid=$staffid' class='list-edit'>Edit |</a> 
                                                        <a href='managestaff.php?delete&&staffid=$staffid' class='list-delete'>Delete</a> 
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