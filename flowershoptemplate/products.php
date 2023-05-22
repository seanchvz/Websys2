<!DOCTYPE html>
<!-- Template by freewebsitetemplates.com -->
<html>
<head>
<style>
	.modal-container {
	display: none;
	position: fixed;
	z-index: 9990;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(255, 105, 180, 0.5);
	/* Semi-transparent pink background */
}

.modal-container.open {
	display: flex;
	align-items: center;
	justify-content: center;
}

.modal-content {
	background-color: #FF4081;
	color: #fff;
	max-width: 1000px;
	margin: auto;
	padding: 30px;
	box-sizing: border-box;
	text-align: center;
	position: relative;
	top: 10%;
	border-radius: 8px;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.modal-content input {
	height: 30px;
	border-radius: 1px;
	border: none;
	padding: 2px;
	margin-bottom: 10px;
}

.modal-content button {
	padding: 8px 8px;
	background-color: #A4D65E;
	border: none;
	color: white;
	border-radius: 4px;
	cursor: pointer;
	transition: background-color 0.3s ease;
}

.modal-content button:hover {
	background-color: #FF0057;
}

.modal-content .close {
	margin-right: 10px;
	margin-top: 5px;
	color: #fff;
	opacity: 0.8;
	position: absolute;
	top: 20px;
	right: 20px;
	font-size: 24px;
	cursor: pointer;
}

/* Add the rest of your CSS styles for chatContainer, message, inputContainer, messageInput, and sendButton here */
#chatContainer {
	height: 400px;
	overflow-y: scroll;
	padding: 10px;
	background-color: #FF80AB;
	border-radius: 8px;
	margin-bottom: 20px;
}

.message {
	background-color: #FF4081;
	padding: 10px;
	margin-bottom: 10px;
	border-radius: 8px;
	color: #fff;
}

#inputContainer {
	padding: 10px;
	background-color: #A4D65E;
	border-radius: 8px;
	margin-bottom: 20px;
	display: flex;
}

#messageInput {
	flex: 1;
	padding: 2px;
	border: none;
	border-radius: 4px;
	margin-right: 5px;
}

#sendButton {
	padding: 8px 16px;
	background-color: #FF4081;
	border: none;
	color: white;
	border-radius: 4px;
	cursor: pointer;
	transition: background-color 0.3s ease;
}

#sendButton:hover {
	background-color: #FF0057;
}

</style>
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
<div id="popup-container" class="modal-container" style="display: none;">
        <div id="popup-window" class="modal-content">
            <button type="button" class="close" onclick="closeFormPopup()">&times;</button>
            <div id="chatContainer"></div>
            <div id="inputContainer">
                <input type="text" id="messageInput" placeholder="Type a message...">
                <button id="sendButton">Send</button>
            </div>
        </div>
    </div>
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
								echo '<li><a href="#" onclick="openFormPopup()">Open Chat</a></li>';
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
         <!-- PRODUCTS GIKAN SA PHP CONNECT?!?!?! -->
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
				echo "<li><a href='category.php?prodcat=" . urlencode($category) . "'>$category</a></li>";
				
			}
			echo "</ul>";

			// Close the database connection
			mysqli_close($conn);
			?>
			<div>
				<!-- this is for the menu home page -->
				<?php
				$hostname = "localhost";
				$database = "resto";
				$db_login = "root";
				$db_pass = "";
				$dlink = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

				// check if a category filter is set
				if (isset($_GET['category'])) {
					$category_filter = $_GET['category'];
					$query = "SELECT * FROM Products WHERE prodcat='$category_filter' ORDER BY prodid";
				} else {
					$query = "SELECT * FROM Products ORDER BY prodcat, prodid";
				}

				$result = mysqli_query($dlink, $query);
				$current_cat = '';

				while ($row = mysqli_fetch_assoc($result)) {

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
				}
				mysqli_close($dlink);
				?>



<!-- CLOSING SA CONNECTOR?!?! -->

	
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
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			var chatContainer = document.getElementById("chatContainer");
			var messageInput = document.getElementById("messageInput");
			var sendButton = document.getElementById("sendButton");

			// Function to generate chat message HTML
			function generateMessageHTML(sender, message, timestamp, userType) {
				var userLabel = sender === "Admin" ? "" : "Customer";
				var messageElement = document.createElement("div");
				messageElement.classList.add("message");
				messageElement.innerHTML = `
			<div><strong>${userLabel} ${sender}</strong></div>
			<div>${message}</div>
			<div>${timestamp}</div>
			<button class="reply-button" data-recipient="${sender}">Reply</button>
		`;
				return messageElement;
			}

			// Function to handle reply button click
			function handleReplyClick(event) {
				var recipient = event.target.dataset.recipient;
				var replyInput = document.getElementById("messageInput");
				replyInput.value = "";
				replyInput.placeholder = "Reply to " + recipient;
				replyInput.dataset.recipient = recipient; // Set the recipient value on the dataset
			}


			// Attach event listener to reply buttons
			chatContainer.addEventListener("click", function (event) {
				if (event.target.classList.contains("reply-button")) {
					handleReplyClick(event);
				}
			});

			// Event listener for sending a message
			sendButton.addEventListener("click", function () {
				var newMessage = messageInput.value;
				var recipient = messageInput.dataset.recipient; // Get the recipient from the messageInput dataset

				if (newMessage.trim() !== "" && recipient) {
					// Send the message to the server
					var formData = new FormData();
					formData.append("message", newMessage);
					formData.append("recipient", recipient);

					fetch("insert_chat_data.php", {
						method: "POST",
						body: formData,
					})
						.then(function (response) {
							return response.json();
						})
						.then(function (data) {
							// Successfully inserted the message, update chat messages
							getChatMessages();
						})
						.catch(function (error) {
							console.log("Error sending chat message:", error);
						});

					messageInput.value = "";
					messageInput.dataset.recipient = ""; // Clear the recipient after sending the message
				}
			});

			// Function to render chat messages
			function renderChatMessages(messages) {
				chatContainer.innerHTML = "";
				for (var i = 0; i < messages.length; i++) {
					var { sender, message, timestamp } = messages[i];
					var messageHTML = generateMessageHTML(sender, message, timestamp);
					chatContainer.appendChild(messageHTML);
				}
			}

			// Function to retrieve chat messages from the server
			function getChatMessages() {
				fetch("read_chat_data.php")
					.then(function (response) {
						return response.json();
					})
					.then(function (data) {
						renderChatMessages(data);
					})
					.catch(function (error) {
						console.log("Error fetching chat messages:", error);
					});
			}

			// Initial rendering of chat messages
			getChatMessages();
		});

		function openFormPopup() {
			document.getElementById('popup-container').style.display = 'flex';
		}

		function closeFormPopup() {
			document.getElementById('popup-container').style.display = 'none';
		}
	</script>
</body>
</html>