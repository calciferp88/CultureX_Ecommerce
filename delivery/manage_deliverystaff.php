    <?php

    include('delivery_adminheader.php');

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
            UPDATE `deliverystaff`
            SET `deliverystaffName`='$staffnameedit', `deliveryStaffEmail`='$staffemailedit',`quickMail`='$pimshopmailedit' ,`deliveryStaffPhone`='$staffphoneedit' WHERE `deliveryStaffID`='$staffidedit';
            ";

            $run = mysqli_query($connect, $updatestaff);

            if($run)
            {
                echo "<script>
                alert('Delivery Staff Information Updated ! ');
                window.location.assign('manage_deliverystaff.php');
                </script>";
            }

            else { echo mysqli_error($connect); }
        }

        else{
            $updatestaff = "
            UPDATE `deliverystaff`
            SET `deliverystaffName`='$staffnameedit', `deliveryStaffEmail`='$staffemailedit',`quickMail`='$pimshopmailedit', `deliveryStaffPhone`='$staffphoneedit', `deliveryStaffPassword` = '$hash' WHERE `deliveryStaffID`='$staffidedit';
            ";

            $run = mysqli_query($connect, $updatestaff);

            if($run)
            {
                echo "<script>
                alert('Staff Information and Password updated');
                window.location.assign('manage_deliverystaff.php');
                </script>";
            }

            else { echo mysqli_error($connect); }
        }



    }

 ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Staff List | Quick.com</title>
    </head>
    <body>
      <div id="page-wrapper" ><br><br>
            <div class="header">
                            <h1 class="page-header">
                                Delivery Staffs List
                            </h1>
                            <ol class="breadcrumb">
                          <li><a href="delivery_adminhome.php">Home</a></li>
                          <li class="active">Manage Delivery Staff</li>
                        </ol>

            </div>

            <div id="page-inner">

                <?php

                    if (isset($_GET['edit']))
                    {
                        $staffided       = $_GET['staffid'];
                        $selectstaffedit = "SELECT * FROM deliverystaff WHERE deliveryStaffID = '$staffided' ";
                        $runstaffedit    = mysqli_query($connect, $selectstaffedit);
                        $rowstaffedit    = mysqli_fetch_array($runstaffedit);

                        $staffname     = $rowstaffedit['deliverystaffName'];
                        $cultureXMail  = $rowstaffedit['quickMail'];
                        $staffemail    = $rowstaffedit['deliveryStaffEmail'];
                        $staffphone    = $rowstaffedit['deliveryStaffPhone'];
                        $staffpassword = $rowstaffedit['deliverystaffRole'];
                        echo "
                                <form class='edit-form' action='manage_deliverystaff.php' method='POST' >

                                    <input type='hidden' class='validate' name='txtstaffid' value='$staffided' required>

                                    <div class='row'>
                                        <label for='StaffName'>Staff Name</label>
                                        <div class='input-field col s12'>
                                          <input type='text' class='validate' name='txtstaffname' value='$staffname' required>
                                        </div>
                                    </div>

                                    <div class='row'>
                                          <label for='StaffName'>Quick Delivery User Name</label>
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
                        $deletestaffdelete = "DELETE FROM deliverystaff WHERE deliveryStaffID = '$staffidde' ";
                        $runstaffdelete    = mysqli_query($connect, $deletestaffdelete);
                        if($runstaffdelete)
                        {
                            echo "<script>
                            alert('Delivery Staff Deleted !');
                            window.location.assign('manage_deliverystaff.php');
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
                                            <th>Staff Name</th>
                                            <th>Quick Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $selectstaff = "SELECT * FROM deliverystaff";
                                        $runstaff = mysqli_query($connect, $selectstaff);
                                        $countstaff = mysqli_num_rows($runstaff);

                                        for ($i=0;$i<$countstaff;$i++)
                                        {
                                            $rowstaff    = mysqli_fetch_array($runstaff);
                                            $staffid     = $rowstaff['deliveryStaffID'];
                                            $staffname   = $rowstaff['deliverystaffName'];
                                            $quickmail   = $rowstaff['quickMail'];
                                            $staffemail   = $rowstaff['deliveryStaffEmail'];
                                            $staffphone   = $rowstaff['deliveryStaffPhone'];
                                            $staffrole    = $rowstaff['deliverystaffRole'];
                                            $staffstatus  = $rowstaff['status'];

                                            echo "

                                                <tr class='odd gradeX'>
                                                    <td>$staffid</td>
                                                    <td>$staffname</td>
                                                    <td>$quickmail</td>
                                                    <td>$staffemail</td>
                                                    <td>$staffrole</td>
                                                    <td>$staffstatus</td>
                                                    <td>
                                                        <a href='manage_deliverystaff.php?edit&&staffid=$staffid' class='list-edit'>Edit |</a>
                                                        <a href='manage_deliverystaff.php?delete&&staffid=$staffid' class='list-delete'>Delete</a>
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
