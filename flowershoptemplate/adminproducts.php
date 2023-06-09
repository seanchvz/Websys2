
<!DOCTYPE html>
<!-- Template by freewebsitetemplates.com -->
<html>
	<style>
		    /* Styling for the pop-up form */
			#popup-container {
        display: none;
        position: fixed;
        z-index: 9990;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 192, 203, 0.5);
        /* Semi-transparent black background */
    }

    #popup-container.open {
        display: flex;
        align-items: left;
        justify-content: left;
    }

    .modal-content {
        background-color:  #ffffff;
        color: #000000;
        max-width: 500px;
		border-radius:10px;
        margin: auto;
        padding: 20px;
        box-sizing: border-box;
        text-align: left;
        position: relative;
        top: 50%;
        transform: translateY(30%);
    }

    .modal-content input {
        height: 20px;
        border-radius: 10px;
    }

    .modal-content .btn-primary {
        width: 175px;
        background-color: #AE0C6E;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .modal-content .btn-primary:hover {
        background-color: #00885D;
    }

    .logorow {
        text-align: center;
    }

    .close {
        margin-right: 10px;
        margin-top: 5px;
        color: #000000;
        opacity: 0.8;
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
    }

    .close:hover {
        color: #AE0C6E;
    }

    /* Container for each item */
    .item-container {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    /* Product name */
    .item-container a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
    }


    /* Product quantity */
    .item-container p {
        display: inline;
        margin-right: 10px;
    }

    /* Out of stock message */
    .item-container p.out-of-stock {
        color: red;
    }
	.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  list-style-type: none;
  padding: 0;
}

.category {
  margin-bottom: 10px;
}

.category-details {
  display: flex;
  align-items: center;
}

.category-link {
  font-weight: bold;
  margin-right: 10px;
}

.category-buttons {
  margin-left: auto;
}

.product-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 10px;
  text-align: center;
  border: 1px solid #ddd;
  padding: 10px;
  border-radius: 4px;
  background-color: #f9f9f9;
}

.product-image-container {
  width: 150px;
  height: 150px;
  margin-bottom: 10px;
}

.product-image {
	width: 150px;
  height: 150px;
  object-fit: contain;
}

.product-details {
  width: 100%;
}

.product-quantity {
  margin: 0;
}

.product-name {
  font-weight: bold;
  margin: 5px 0;
}

.product-price {
  margin: 0;
}

.product-options {
  margin-top: 10px;
}

.out-of-stock {
  color: red;
  font-weight: bold;
}

/* Additional styling for buttons */
.edit-category-btn,
.delete-category-btn,
#new-category-btn {
  padding: 5px 10px;
  margin: 5px;
  align-items: flex-start;
  background-color: #AE0C6E;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.edit-category-btn:hover,
.delete-category-btn:hover,
#new-category-btn:hover {
  background-color: #AE0C6E;
}


		</style>
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
                                
								
                            } elseif ($_COOKIE['type'] == 'customer') {
                                echo '<li><a href="products.php">Products</a></li>';
                                echo '<li><a href="cart.php">Cart</a></li>';
                            }
                        }
                        ?>








<a href="adminproducts.php" class="whatshot"></a>
                    <div>
                        <ul>
                            <?php
                            // Check if the user is logged in and has the usertype of "admin"
                            if (!isset($_COOKIE['type']) || $_COOKIE['type'] !== 'admin') {
                                header("Location: index.php?action=login&#login_form");
                         
                            }
                            $hostname = "localhost";
                            $database = "resto";
                            $db_login = "root";
                            $db_pass = "";
                            $dlink = mysqli_connect($hostname, $db_login, $db_pass, $database) or die("Could not connect");

                            // Check if a category filter is set
                            if (isset($_GET['category'])) {
                                $category_filter = $_GET['category'];
                                $query = "SELECT * FROM Products WHERE prodcat='$category_filter' ORDER BY prodid";
                            } else {
                                $query = "SELECT * FROM Products ORDER BY prodcat, prodid";
                            }

                            $result = mysqli_query($dlink, $query);
                            $current_cat = '';

							echo '<ul class="product-list">';
echo '<ul class="product-list">';

// Button for the category
while ($row = mysqli_fetch_assoc($result)) {
    if ($current_cat != $row['prodcat']) {
        echo '<li class="category" id="category-' . $row['prodcat'] . '">';
        echo '<div class="category-details">';
        echo '<a class="category-link" href="?category=' . $row['prodcat'] . '">' . $row['prodcat'] . '</a>';
        echo '<div class="category-buttons">';
        echo '<button class="edit-category-btn" onclick="editCategoryName(\'' . $row['prodcat'] . '\')">Edit</button>';
        echo '<button class="delete-category-btn" onclick="confirmDeleteCategory(\'' . $row['prodcat'] . '\')">Delete</button>';
        echo '</div>';
        echo '</div>';
        echo '</li>';
        $current_cat = $row['prodcat'];
    }

    echo '<li class="product-item">';
    echo '<div class="product-image-container">';
	echo "<td style='padding: 10px;'><img src=\"" . $row['productimage'] . "\" alt=\"Image\" style=\"max-width: 200px; max-height: 200px;\"></td>";
    
    echo '</div>';
    echo '<div class="product-details">';
    echo '<p class="product-quantity">Available: ' . $row['quantity'] . '</p>';
    echo '<p class="product-name">' . $row['productname'] . '</p>';
    echo '<p class="product-price">$' . $row['ourprice'] . '</p>';

    echo '<select class="product-options" onchange="handleProductOptionChange(' . $row['prodid'] . ', this)">
    <option value="" selected>--------</option> <!-- Make the empty value option selected -->
    <option value="edit">Edit</option>
    <option value="insert">Insert</option>
    <option value="delete">Delete</option>
    
</select>';
    if ($row['quantity'] > 0) {


} else {
    echo "<p>Out of stock<p>";
}
    echo '</div>';
    echo '</li>';

}



							
							// Add "New Category" button
							echo '<div class="category">';
							echo '<button id="new-category-btn" onclick="createNewCategory()">New Category</button>';
							echo '</div>';
							
							echo '</ul>';
                            mysqli_close($dlink);
                            ?>

                            <script>
                                function openFormPopup() {
                                    document.getElementById('popup-container').style.display = 'flex';
                                }

                                function closeFormPopup() {
                                    document.getElementById('popup-container').style.display = 'none';
                                }

                                function handleProductOptionChange(prodid, selectElement) {
                                    var value = selectElement.value;

                                    if (value === "insert") {
                                        handleInsertProduct(prodid, selectElement);
                                    } else if (value === "delete") {
                                        handleDeleteProduct(prodid);
                                    } else if (value === "edit") {
                                        handleProductEdit(prodid);
                                    }
                                }

                                function handleInsertProduct(prodid, selectElement) { // Add selectElement as a parameter
                                    // Retrieve the category of the selected product
                                    var prodcat = selectElement.getAttribute("data-category");

                                    // Make an AJAX request to insert a new product
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "insert_product.php", true);
                                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            // Insertion completed successfully
                                            // Reload the page
                                            location.reload();
                                        }
                                    };
                                    xhr.send("prodid=" + prodid + "&category=" + prodcat + "&option=insert");
                                }

                                function handleDeleteProduct(prodid) {
                                    var confirmationMessage = "Are you sure you want to delete this product (prodid = " + prodid + ")?";

                                    if (confirm(confirmationMessage)) {
                                        // Make an AJAX request to delete the product
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST", "delete_product.php", true);
                                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                // Product deleted successfully, reload the page
                                                location.reload();
                                            }
                                        };
                                        xhr.send("prodid=" + prodid);
                                    } else {
                                        // Reset the select value to the default option
                                        selectElement.value = "";
                                    }
                                }
                                function handleProductEdit(prodid) {
                                    // Show the edit form popup
                                    document.getElementById('popup-container').style.display = 'block';

                                    // Set the prodid value in the edit form
                                    document.getElementById('prodid').value = prodid;

                                    // Update the heading with the prodid
                                    var heading = document.getElementById('popup-heading');
                                    heading.textContent = 'Edit Product ' + prodid;

                                    // Retrieve the product details using AJAX
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("GET", "get_product_details.php?prodid=" + prodid, true);
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            var productDetails = JSON.parse(xhr.responseText);

                                            // Set the values of the form fields
                                            document.getElementById('current-image').src = productDetails.productimage;
                                            document.getElementById('productname').value = productDetails.productname;
                                            document.getElementById('description').value = productDetails.description;
                                            document.getElementById('quantity').value = productDetails.quantity;
                                            document.getElementById('ourprice').value = productDetails.ourprice;
                                            document.getElementById('prodcat').value = productDetails.prodcat;

                                        }
                                    };
                                    xhr.send();
                                }
                                function editCategoryName(categoryId) {
                                    var categoryElement = document.getElementById('category-' + categoryId);
                                    var categoryLink = categoryElement.querySelector('.category-link');
                                    var editButton = categoryElement.querySelector('.edit-category-btn');

                                    if (categoryLink.style.display === 'none') {
                                        // Already in edit mode, save changes
                                        var inputElement = categoryElement.querySelector('input');
                                        var newCategoryName = inputElement.value;

                                        if (newCategoryName.trim() !== '') {
                                            // Send an AJAX request to update the category name
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('POST', 'update_category.php', true);
                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                            xhr.onload = function () {
                                                if (xhr.status === 200) {
                                                    // Reload the page after updating the category name
                                                    location.reload();
                                                } else {
                                                    // Display error message if updating category name failed
                                                    console.log('Error updating category name: ' + xhr.responseText);
                                                }
                                            };
                                            xhr.send('categoryId=' + encodeURIComponent(categoryId) + '&newCategoryName=' + encodeURIComponent(newCategoryName));
                                        }
                                    } else {
                                        // Enter edit mode
                                        categoryLink.style.display = 'none';
                                        editButton.innerText = 'Save';

                                        var inputElement = document.createElement('input');
                                        inputElement.type = 'text';
                                        inputElement.value = categoryLink.innerText;

                                        categoryElement.appendChild(inputElement);
                                    }
                                }
                                function createNewCategory() {
                                    // Send an AJAX request to create a new category
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'create_category.php', true);
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.onload = function () {
                                        if (xhr.status === 200) {
                                            // Reload the page after creating a new category
                                            location.reload();
                                        }
                                    };
                                    xhr.send();
                                }

                                function confirmDeleteCategory(categoryId) {
                                    var confirmationMessage = "Are you sure you want to delete this category (" + categoryId + ") and its products?";

                                    var confirmation = confirm(confirmationMessage);
                                    if (confirmation) {
                                        // Send an AJAX request to delete the category
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'update_category.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onload = function () {
                                            if (xhr.status === 200) {
                                                // Reload the page after deleting the category
                                                location.reload();
                                            } else {
                                                // Display error message if deleting category failed
                                                console.log('Error deleting category: ' + xhr.responseText);
                                            }
                                        };
                                        xhr.send('categoryId=' + encodeURIComponent(categoryId) + '&newCategoryName=');
                                    }
                                }
                            </script>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div> 
    <!-- Add the popup container -->
    <div id="popup-container" style="display: none;">
        <div id="popup-window">
            <div class="modal-content">
                <button type="button" class="close" onclick="closeFormPopup()">&times;</button>
                <div>
                    <div class="row text-center">
                        <h1 id="popup-heading">Edit Product</h1>
                        
                        <p>Update the product details below:</p>
                    </div>
                    <br>
                    <form action="update_product.php" method="post" id="edit-form" enctype="multipart/form-data"
                        onsubmit="handleProductUpdate(event)">
                        <input type="hidden" id="prodid" name="prodid">
                        <div class="row">

                            <div class="col-md-6">
                                <label for="prodcat">Product Category:</label>
                                <input class="form-control" name="prodcat" id="prodcat" placeholder="Product Category">
                            </div>
                            <div class="col-md-6">
                                <label for="productname">Product Name:</label>
                                <input class="form-control" name="productname" id="productname"
                                    placeholder="Product Name">
                            </div>
                            <div class="col-md-6">
                                <label for="description">Description:</label>
                                <input class="form-control" name="description" id="description"
                                    placeholder="Description">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="quantity">Quantity:</label>
                                <input class="form-control" name="quantity" id="quantity" placeholder="Quantity"
                                    type="number" min="0">
                            </div>
                            <div class="col-md-6">
                                <label for="ourprice">Current Price:</label>
                                <input class="form-control" name="ourprice" id="ourprice" placeholder="Current Price">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <img id="current-image" src="' . $row['productimage'] . '" width="100">
                        </div>
                        <div class="col-md-6">
                            <label for="image">Product Image:</label>
                            <input type="file" name="image" id="productimage" accept="image/*">
                        </div>

                </div>
                <br>
                <center>
                    <input type="submit" class="btn btn-primary" name="submit" value="Save">
                </center>
                </form>
                <br>
            </div>

