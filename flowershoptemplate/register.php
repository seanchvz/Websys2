<?php
			$hostname="localhost";
			$database="resto";
			$db_login="root";
			$db_pass="";

			$dlink = mysql_connect($hostname, $db_login, $db_pass) or die("Could not connect");
			mysql_select_db($database) or die("Could not select database");

            $error_message = "";
            $success_message = "";
            
            if(isset($_REQUEST['uname'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['contact'], $_REQUEST['address'])) {

                // Check if email already exists in database
                $query = "select * from user where email='". $_REQUEST['email']."'";
                $result = mysql_query($query) or die(mysql_error());
                $total_results = mysql_num_rows($result);

            
                if($total_results == 0) {
                    $query = "INSERT INTO user(email, paswrd, contact, custname, address, usertype, user_date, user_ip) 
                            VALUES ('".$_REQUEST['email']."','".$_REQUEST['password']."','".$_REQUEST['contact']."','".$_REQUEST['uname']."','".$_REQUEST['address']."','customer','".date("Y-m-d h:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
                            
                            
                    $result = mysql_query($query) or die(mysql_error());
                    echo "meta http-equiv='refresh' content='0;url=login.php'>";
                    //$success_message = "Registration Successful";
                    echo "<script>alert('Registration Successful')</script>";
                } else {
                    //$error_message = "Email already exists. Please choose another email.";
                    echo "<script>alert('Email already registered.')</script>";
                }
            }
            
            if($_REQUEST['action'] == 'register') {
                if(!empty($error_message)) {
                    print('<p style="color:red">'.$error_message.'</p>');
                } else if(!empty($success_message)) {
                    print('<p style="color:green">'.$success_message.'</p>');
                }
            }
            ?>
<!DOCTYPE html>
<!-- Template by freewebsitetemplates.com -->
<html>
<head>
<meta charset="utf-8" />
<title>Flower Shop</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="css/ie6.css" media="all" />
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" media="all" />
<![endif]-->
</head>
<body>
	<div id="header">
		<ul>
			<li class="selected"><a href="index.php">home</a></li>
			<li><a href="flowers.html">our flowers</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="register.php">register</a></li>
			<li><a href="contact.html">contact us</a></li>		
		</ul>
		<div class="logo">
			<a href="index.html"><img src="images/logo.gif" alt="" /></a>
		</div>
	</div>





                  <div id="footer">
		<div>
			<div class="connect">
				<h4>Follow us:</h4>
				<ul>
					<li class="facebook"><a href="http://facebook.com/freewebsitetemplates" target="_blank">facebook</a></li>
					<li class="twitter"><a href="http://twitter.com/fwtemplates" target="_blank">twitter</a></li>		
				</ul>
			</div>
			<p>Copyright &copy; 2012. All rights reserved.</p>
		</div>
	</div>
</body>
</html>