<?php

	session_start();
	include('scripts\functions.php');
	$connect = mysqli_connect("localhost", "root", "", "CultureXdb");

	$useremail 		 = "";
	$userpassword    = "";
	$passwordalert   = "";
	$emailalert      = "";

	if(isset($_POST['btn-login']))
	{
        $email         = $_POST['txtemail'];
        $password      = $_POST['txtpsw'];
        $chkemailstaff = preg_match('/@culturex.com/', $email);
        $chkemaildeli  = preg_match('/@quick.com/', $email);

        if($chkemailstaff)
        {
            if($email == CHECK_ATTRIBUTE('staff', 'cultureXMail', $email))
            {
                $emailalert = "";
                $hash = md5($password);
                $checkpsw = GET_ATTRIBUTE('staff', 'cultureXMail', $email, 'staffPassword');

                if ($hash == $checkpsw)
                {

                    $_SESSION['staffemail'] = $email;
                    echo "<script>
                        alert('Logged In Successfully ! ');
                        window.location.assign('admin/adminhome.php');
                        </script>";
                }

                else
                {
                    $passwordalert   = "Wrong Password ";
                }
            }

            else
            {
                $emailalert = "This email is not registered";
            }
        }

        // for delivery staff login
        else if($chkemaildeli)
        {
            if($email == CHECK_ATTRIBUTE('deliverystaff', 'quickMail', $email))
            {
                $emailalert = "";
                $hash = md5($password);
                $checkpsw = GET_ATTRIBUTE('deliverystaff', 'quickMail', $email, 'deliveryStaffPassword');

                if ($hash == $checkpsw)
                {

                    $_SESSION['delistaffemail'] = $email;
                    echo "<script>
                        alert('Logged In Successfully ! ');
                        window.location.assign('delivery/delivery_adminhome.php');
                        </script>";
                }

                else
                {
                    $passwordalert   = "Wrong Password";
                }
            }

            else
            {
                $emailalert = "This email is not registered";
            }
        }

        else
        {
            if($email == CHECK_ATTRIBUTE('user', 'userEmail', $email))
            {
                $emailalert = "";
                $hash = md5($password);
                $checkpsw = GET_ATTRIBUTE('user', 'userEmail', $email, 'userPassword');

                if ($hash == $checkpsw)
                {

                    $_SESSION['myemail'] = $email;
                    echo "<script>
                        alert('Logged In Successfully ! ');
                        window.location.assign('home.php');
                        </script>";
                }

                else
                {
                    $passwordalert   = "Wrong Password";
                }
            }

            else
            {
                $emailalert = "This email is not registered";
            }
        }

    }


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Login | CultureX</title>
	<!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <!-- Favicon -->
    <link rel="icon" href="themes/img/culturexLogo_trans.png">
		
    <!-- Css Styles -->
    <link rel="stylesheet" href="themes/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="themes/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="themes/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="themes/css/jquery-ui.min.css" type="text-right/css">
    <link rel="stylesheet" href="themes/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="themes/css/style.css" type="text/css">
    <style type="text/css">

        li a
        {
         font-size: 18px;
         color: #e7ab3c;
         opacity: 100%;
        }

        li a:hover
        {
         color: black;
        }

        .navbar-brand
        {
            font-size: 30px;
            color: black;
            font-weight: bold;
        }

        .navbar-brand span
        {
            color: #e39d1c;
        }

    </style>

</head>

<body>

    <!-- Header Section Begin -->
    <header class="header-section">

        <div style="position: fixed; top: 0px; z-index: 1000; width: 100%;background-color: white; box-shadow: 0px 0px 10px #b3b3b3">
            <!-- Top Nav -->
            <div class="container top-nav" style="">
                <div class="inner-header" style="padding-top: 15px; padding-bottom: 15px; ">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <div class="">
                                <a href="home" class="navbar-brand">
                                    <span>Culture</span>X.
                                </a>
                            </div>
                        </div>



                        </div>
                    </div>
                </div>
            </div>
    <!-- Hero Section End -->
    </header>
    <!-- Header End -->

    <!-- Register Section Begin --><br><br>
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2 class="header-line">Login</h2>
                        <form action="login.php" method="POST">

                            <div class="group-input">
                                <label for="email">Enter Your Email</label>
                                <input type="email" id="email" name="txtemail" required>
                                <p style="color: red;"><?php echo "$emailalert"; ?></p>
                            </div>

                            <div class="group-input">
                                <label for="psw">Enter Your Password</label>
                                <input type="password" id="psw" name="txtpsw" required>
                                <p style="color: red;"><?php echo "$passwordalert"; ?></p>
                            </div>

                            <button type="submit" class="site-btn register-btn" name="btn-login">Login</button>

                        </form>
                        <div class="switch-login">
                            Don't have An account ? <a href="signup.php" class="or-login">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
        <!-- footer component -->
    <?php include('components/footer.php'); ?>

    <!-- Js Plugins -->
    <script src="themes/js/jquery-3.3.1.min.js"></script>
    <script src="themes/js/bootstrap.min.js"></script>
    <script src="themes/js/jquery-ui.min.js"></script>
    <script src="themes/js/jquery.countdown.min.js"></script>
    <script src="themes/js/jquery.nice-select.min.js"></script>
    <script src="themes/js/jquery.zoom.min.js"></script>
    <script src="themes/js/jquery.dd.min.js"></script>
    <script src="themes/js/jquery.slicknav.js"></script>
    <script src="themes/js/owl.carousel.min.js"></script>
    <script src="themes/js/main.js"></script>
</body>

</html>
