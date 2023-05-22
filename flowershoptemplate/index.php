




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
	background-color: #FF9E80;
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
  echo '<li><a href="#" onclick="openFormPopup()">Open Chat</a></li>';
}else{}
	?>



	<div id="body">
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