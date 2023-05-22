




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

		<?php if (isset($_COOKIE['email'])): ?>
			<?php
                        if (isset($_COOKIE['type'])) {
                            if ($_COOKIE['type'] == 'admin') { ?>
								<li>
							<a>Welcome,
								<?php echo $_COOKIE['type'] . '  ' . $_COOKIE['email'] . '' ?>
							</a>
						</li>
						<li><a href="logout.php">Logout</a></li>
	
                                
                            <?php } elseif ($_COOKIE['type'] == 'customer') { ?>
								<li>
							<a>Welcome,
								<?php echo $_COOKIE['type'] . '  ' . $_COOKIE['email'] . '' ?>
							</a>
						</li>
						<li><a href="logout.php">Logout</a></li>
                               <?php echo '<li><a href="products.php">Menu</a></li>';
                                echo '<li><a href="cart.php">Cart</a></li>';
                            }
                        }
						?>
	
			<?php else: 
					echo '<li class="nav-item"><a class="nav-link" href="index.php?action=login&#login_form">Login</a></li>';
					echo '<li class="nav-item"> <a class="nav-link" href="index.php?action=register&#login_form">Register</a></li>';
				?>
						
					<?php endif ?>
		
		<li class="selected"><a href="index.php?user=logged_in">home</a></li>
		

<?php
    $hostname="localhost";
    $database="resto";
    $db_login="root";
    $db_pass="";

    $dlink = mysql_connect($hostname, $db_login, $db_pass) or die("Could not connect");
    mysql_select_db($database) or die("Could not select database");


    // Register

    if($_REQUEST['name'] !="" && $_REQUEST['email'] !="" && $_REQUEST['password'] !="" && $_REQUEST['contact'] !="" && $_REQUEST['address'] !=""){
        $query = "select * from user where email='". $_REQUEST['email'] . "'";
        $result = mysql_query($query) or die(mysql_error());
        $num_results = mysql_num_rows($result);

		if($num_results==0){
			$all_query = "select * from user";
			$all_result = mysql_query($all_query) or die(mysql_query());
			$total_all = mysql_num_rows($all_result);
			if($total_all == 0){
				$query="insert into user(email, paswrd, contact, custname, address, usertype, user_date, user_ip) values('".$_REQUEST['email']."','".$_REQUEST['password']."','".$_REQUEST['contact']."','".$_REQUEST['name']."','".$_REQUEST['address']."','admin','".date("Y-m-d h:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result = mysql_query($query) or die(mysql_error());
			} else{
				$query="insert into user(email, paswrd, contact, custname, address, usertype, user_date, user_ip) values('".$_REQUEST['email']."','".$_REQUEST['password']."','".$_REQUEST['contact']."','".$_REQUEST['name']."','".$_REQUEST['address']."','customer','".date("Y-m-d h:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result = mysql_query($query) or die(mysql_error());
			  }
			echo "<meta http-equiv='refresh' content='0;url=index.php?action=login&#login_form'>";
		  }else{
            echo "<meta http-equiv='refresh' content='0;url=index.php?registered=user&register=true&#register'>";
            echo '<script>alert("Account Already Registered")</script>';

        }
    }

    // End of Register

    // Login

    if ($_REQUEST['logging_in'] == true){
      $query = "select * from user where email='". $_REQUEST['email'] ."' and paswrd='". $_REQUEST['password'] ."'";
      $result = mysql_query($query) or die(mysql_error());
      $total_results = mysql_num_rows($result);
	  $row = mysql_fetch_array($result);
      if ($total_results == 0) {

        echo '<meta http-equiv="refresh" content="0;url=index.php?action=register&#login_form">';
		echo '<script>alert("Account not yet Registered!")</script>';

		
      }else{
		setcookie("email", $row['email'], time() + 3600, "/");
		setcookie("type", $row['usertype'], time() + 3600, "/");
        echo '<meta http-equiv="refresh" content="0,url=index.php?user=logged_in">';
      }
    }

    // End of Login

    // Register Form

    if ($_REQUEST['action'] == 'register'){
        print('<h1>Registration Form</h1>');
        print('<form action=index.php method=post>');
        print('Enter Name<input type=text name=name><br>');
        print('Enter Email<input type=text name=email><br>');
        print('Enter Password<input type=text name=password><br>');
        print('Enter Contact<input type=text name=contact><br>');
        print('Enter Address<input type=text name=address><br>');
        print('<input type=submit value=submit>');
        print('</form>');
    }

    // End of Register Form

    // Login Form

    if ($_REQUEST['action'] == 'login'){
      print ('<h1 id="login">Login</h1>');
      print('<form action=index.php?logging_in=true method=post>');
      print('Enter Email<input type=text name=email><br>');
      print("Enter Password<input type=text name=password><br>");
      print('<input type=submit value=submit name=submit>');
      print('</form>');
    }

    // End of Login Form


  ?>
<?php
                  if ($_REQUEST['user'] != "logged_in"){
                   
                  }else if ($_REQUEST['user'] == "logged_in"){
                    // echo '<li><a href="#">Welcome Customer to fiore flowers</a></li>';
                  }
                ?>
				<li><a href="contact.html">contact us</a></li>	
				
				<ul class="navigation">
					

					</li>
					<!-- <li><a href="logout.php">Logout</a></li>	 -->

	
				
				
				
</div>

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
				
		</ul>
		<div class="logo">
			<a href="index.php"><img src="images/logo.gif" alt="" /></a>
		</div>

	
		<div id="calendar">
		<?php $user_type = isset($_COOKIE['type']) ? $_COOKIE['type'] : '';

if ($user_type == 'admin'){
  include 'calendar.php';
}else{}
	?>


	<div id="body">

		<div class="featured">
			<div>
	
				<div class="section">
					<div>
						
					<br>
					<br>
					<br>
					<br>
					<br>
						
					</div>	
				</div>
			</div>
		</div>
		<div class="content">
			<span class="heading"><img src="images/special-occasions-flowers.gif" alt="" /></span>
			<div>
				
					<ul>
						<li>
							<a href="products.php">
							<img src="images/tulips.jpg" alt="" />
							
							
							</a>
						
							<a href="products.php">
							<img src="images/bouquet.jpg" alt="" />
							
							</a>
							
						
							<a href="products.php">
							<img src="images/roses.jpg" alt="" />
							
							</a>
		
						</li>	
						<h1><a href="products.php">view all products</a></h1>
					</ul>
					
				</div>
			</div>
			</div>
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