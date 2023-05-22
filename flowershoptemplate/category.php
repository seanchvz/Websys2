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
	
         
		<ul>
		<?php if (!isset($_COOKIE['email'])): ?>
						<?php else: ?>
						<li>
							<a>Welcome,
								<?php echo $_COOKIE['type'] . '  ' . $_COOKIE['email'] . '' ?>
							</a>
						</li>
						<li><a href="logout.php">Logout</a></li>
	
					<?php endif ?>
		<div id="login_form">
		<li class="selected"><a href="index.php">home</a></li>
		<?php
                        if (isset($_COOKIE['type'])) {
                            if ($_COOKIE['type'] == 'admin') {
                                echo '<li><a href="calendar.php">Calendar</a></li>';
                            } elseif ($_COOKIE['type'] == 'customer') {
                                echo '<li><a href="products.php">Products</a></li>';
                                echo '<li><a href="cart.php">Cart</a></li>';
                            }
                        }
                        ?>
	
		</ul>
		<div class="logo">
			<a href="index.html"><img src="images/logo.gif" alt="" /></a>
		</div>
	</div>
	<div id="body">
		<div class="gallery">
			<h1>our flowers</h1>		
			<div>
				<div>
					<a href="flowers.html"><img src="images/red-roses.jpg" alt="" /></a>			
				</div>		
				<ul>
					<li><a href="flowers.html"><img src="images/bouquet.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/bouquet3.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/tulips.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/sunflower.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/bridal-bouquet2.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/roses.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/speedwell.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/roses2.jpg" alt="" /></a></li>	
					<li><a href="flowers.html"><img src="images/bouquet2.jpg" alt="" /></a></li>				
				</ul>	
			</div>

            <?php
			// Connect to the database
			$hostname = "localhost";
			$database = "resto";
			$db_login = "root";
			$db_pass = "";
			$conn = mysqli_connect($hostname, $db_login, $db_pass, $database);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Check if filter is set
			if (isset($_GET['prodcat']) && !empty($_GET['prodcat'])) {
				$prodcat = mysqli_real_escape_string($conn, $_GET['prodcat']);
				$sql = "SELECT * FROM Products WHERE prodcat = '$prodcat'";
			} else {
				// SQL query to select all rows from the 'Products' table
				$sql = "SELECT * FROM Products";
			}

			// Select all products from the database
			$result = mysqli_query($conn, $sql);

			// Initialize category array
			$categories = array();

			// Loop through rows and add categories to array
			while ($row = mysqli_fetch_assoc($result)) {
				$category = $row['prodcat'];
				if (!in_array($category, $categories)) {
					array_push($categories, $category);
				}
			}

			// Generate category links
			echo "<ul>";
			foreach ($categories as $category) {

				echo "<li>
                    <a href='category.php?prodcat=" . urlencode($category) . "'>$category</a></li>";
			}
			echo "</ul>";

			// Close the database connection
			mysqli_close($conn);
			?>
			<div>
				<?php
				// Connect to the database
				$hostname = "localhost";
				$database = "resto";
				$db_login = "root";
				$db_pass = "";
				$conn = mysqli_connect($hostname, $db_login, $db_pass, $database);
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				// Check if filter is set
				if (isset($_GET['prodcat']) && !empty($_GET['prodcat'])) {
					$prodcat = mysqli_real_escape_string($conn, $_GET['prodcat']);
					$sql = "SELECT * FROM Products WHERE prodcat = '$prodcat'";
				} else {
					// SQL query to select all rows from the 'Products' table
					$sql = "SELECT * FROM Products";
				}

				// Select all products from the database
				$result = mysqli_query($conn, $sql);

				// Generate HTML table
				echo "<table style='border-collapse: collapse;'>";
				echo "<tr style='border-bottom: 1px solid black;'><th style='padding: 10px; text-align: left;'>Product Image</th><th style='padding: 10px; text-align: left;'>Product Name</th><th style='padding: 10px; text-align: left;'>Price</th><th style='padding: 10px; text-align: left;'>Quantity</th><th style='padding: 10px; text-align: left;'></th></tr>";
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr style='border-bottom: 1px solid black;'>";
					echo "<td style='padding: 10px;'><img src=\"" . $row['productimage'] . "\" alt=\"Image\" style=\"max-width: 200px; max-height: 200px;\"></td>";
					echo "<td style='padding: 10px;'>" . $row['productname'] . "</td>";
					echo "<td style='padding: 10px;'>&#8369;" . $row['ourprice'] . "</td>";
					echo "<td style='padding: 10px;'>" . $row['quantity'] . "</td>";
					echo "<td style='padding: 10px;'>";

					if ($row['quantity'] > 0) {
						echo '<form method="get" action="cart.php">';
						echo '<input type="hidden" name="prodid" value="' . $row['prodid'] . '">';
						echo '<button type="submit">Add to Cart</button>';
						echo '</form>';
					} else {
						echo "Out of stock";
					}

					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				// Close the database connection
				mysqli_close($conn);
				?>

                
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