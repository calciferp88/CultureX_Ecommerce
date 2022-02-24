<?php 
	
	session_start();
	include('scripts\functions.php');
	$connect = mysqli_connect("localhost", "root", "", "CultureXdb");

	$userid 	 	 = "";         
	$username 		 = "";
	$useremail 		 = "";
	$userphone 		 = "";
	$userdob 		 = "";
	$usercountry     = "";
	$usergender      = "";
	$userpassword    = "";   
	$userpasswordcon = "";
	$passwordcheck   = "";
	$emailexists     = "";
	$phoneexists     = "";

	if(isset($_POST['btn-register']))
	{	
		$userid 	 	 = GET_ID('user', 'userID');
		$username 		 = $_POST['txtname']; 
		$useremail 		 = $_POST['txtemail'];
		$userphone 		 = $_POST['txtphone'];
		$userdob 		 = $_POST['txtdob'];
		$usercountry     = $_POST['txtcountry'];
		$usergender      = $_POST['txtgender'];
		$userpassword    = $_POST['txtpsw'];
		$userpasswordcon = $_POST['txtpsw-com'];
		$checkuseremail  = CHECK_ATTRIBUTE('user', 'userEmail', $useremail);
		$checkuserphone  = CHECK_ATTRIBUTE('user', 'userPhone', $userphone);

		if($useremail != $checkuseremail) 
		{
			if($userphone != $checkuserphone)         
			{
				if ($userpassword == $userpasswordcon) 
				{
					$hash = md5($userpassword);
					$insertuser = "
					INSERT INTO user 
					VALUES ('$userid','$username', '$useremail', '$userphone', '$hash', '$userdob', '$usercountry','$usergender',  'false', '')";

					$run = mysqli_query($connect, $insertuser);

					if($run)
					{  
                        $_SESSION['myemail'] = $useremail;  
						echo "<script>
						alert('Registered Successfully ! ');
						window.location.assign('home.php');
						</script>";
					}
					
					else
					{
						echo mysqli_error($connect);
					}  
				}

				else
				{
					$passwordcheck = "Passwords are not match ! Try Again";

				}
			}

			else
			{
				$phoneexists = "*Phone Number Already Exists*";
			}

		}

		else
		{
			$emailexists = "*Email Already Exists*";
		}

	}


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign Up | CultureX</title>
	<!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">

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
    <!-- Favicon -->
    <link rel="icon" href="themes/img/culturexLogo_trans.png">

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

        /* The message box is shown when the user clicks on the password field */
        #message {
          display:none;
          color: #000;
          position: relative;
          padding: 20px;
          margin-top: 10px;
          box-shadow: 0px 0px 8px #b3b3b3;
          border-radius: 5px;
        }

        #message h3{
            font-size: 20px;
        }

        #message p {
          padding: 10px 35px;
          font-size: 18px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
          color: green;
        }

        .valid:before {
          position: relative;
          left: -35px;
          content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
          color: red;
        }

        .invalid:before {
          position: relative;
          left: -35px;
          content: "✖";
        }

    </style>


</head>

<body>

    <!-- Header Section Begin -->
    <header class="header-section"> 
      	
      	<div style="position: fixed; top: 0px; z-index: 1000; width: 100%;background-color: white; box-shadow: 0px 0px 10px #b3b3b3">
	
	        <div class="container top-nav">
	            <div class="inner-header" style="padding-top: 15px; padding-bottom: 15px; ">
	                <div class="row">
	                   <div class="col-lg-2 col-md-2">     
                            <div class="">  
                                <a href="home.php" class="navbar-brand">
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
                        <h2 class="header-line">Register</h2>    
                        <form action="signup.php" method="POST">   

                            <div class="group-input">
                                <label for="username">Enter Your Name</label>
                                <input type="text" id="username" name="txtname" style="margin-left: 0px;" required>
                            </div>  

                            <div class="group-input">
                                <label for="email">Enter Your Email</label>            
                                <input type="email" id="emailexistsail" name="txtemail" required>
                                <p style="color: red;"><?php echo "$emailexists"; ?> </p>   
                            </div>
        
                            <div class="group-input"> 
                                <label for="phone">Enter Your Phone Number</label>
                                <input type="number" id="phone" name="txtphone" required>   
                                <p style="color: red;"><?php echo "$phoneexists"; ?></p>     
                            </div>  
 
                            <div class="group-input"> 
                                <label for="psw">Enter Your Password</label>   
                                <input 
                                    type="password" 
                                    id="psw" name="txtpsw" 
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    required>  
                                    <div id="meter_wrapper"> 
                                       <div id="meter"></div>    
                                    </div>   
                                <br>    
                                <span id="pass_type"></span>
                                <p style="color: red;"><?php echo "$passwordcheck"; ?></p>  
                            </div>  

                            <div id="message">
                              <h3>Your password must match following rules:</h3>
                              <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                              <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                              <p id="number" class="invalid">A <b>number</b></p>
                              <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                            </div>
        
                            <div class="group-input">   
                                <label for="psw-com">Confirm Your Password</label>
                                <input type="password" id="psw-com" name="txtpsw-com" required>
                            </div>	 

                            <div class="group-input">
                                <label for="dob">Choose Date Of Birth</label>
                                <input type="date" id="dob" name="txtdob"  max="<?= date('Y-m-d'); ?>" required style="margin-left: 0px;">
                            </div>  
    
                            <div class="group-input"> 
                                <label for="country">Choose Your Country</label>  
                                <select id="country" name="txtcountry">
                                    <option>Myanmar</option> 
                                    <option>Singapore</option>
                                    <option>Thailand</option>  
                                    <option>Malaysia</option> 
                                    <option>Laos</option>
                                    <option>China</option> 
                                    <option>Philipenes</option>
                                    <option>India</option> 
                                </select>
                            </div>

                            <div class="group-input"> 
                                <label for="gender">Choose Your Gender</label>  
                                <select id="gender" name="txtgender" required>
                                    <option>Male</option> 
                                    <option>Female</option>
                                    <option>Rather not say</option>  
                                </select>
                            </div>

                            <button type="submit" class="site-btn register-btn" name="btn-register">REGISTER</button>

                        </form>
                        <div class="switch-login">		
                            Have An account ? <a href="login.php" class="or-login">Login</a>
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

                
<script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
      document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
      document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
      // Validate lowercase letters
      var lowerCaseLetters = /[a-z]/g;
      if(myInput.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
      } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
      }
      
      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if(myInput.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
      } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      if(myInput.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
      } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
      }
      
      // Validate length
      if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
      } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
      }
    }
</script>
</body>

</html>