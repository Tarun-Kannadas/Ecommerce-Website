<?php
    include('includes/connect.php');
    include('functions/common_function.php');
    session_start();

    // Define an array to store the names of the components
    $componentNames = array(
        21 => 'Processor (CPU)',
        14 => 'Motherboard',
        16 => 'Memory (RAM)',
        13 => 'Graphics Card (GPU/VGA)',
        18 => 'Solid State Drive (SSD)',
        17 => 'Hard Disk Drive (Internal HDD)',
        23 => 'Cooling System (CPU Cooler)',
        19 => 'Power Supply Unit (SMPS/PSU)',
        15 => 'Cabinet (Case)'
    );

    function getProductsByCategory($categoryId) 
    {
        global $con;
        // Perform database query to fetch products based on the category ID
        $sql = "SELECT * FROM products WHERE category_id = $categoryId";
        $result = $con->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) 
        {
            // Output a container div for the card deck
            echo '<div class="card-deck">';

            $totalPrice = 0;

            // Loop through results and add them to the products array
            while($row = $result->fetch_assoc()) 
            {
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $product_discount = $row['product_discount'];

                // Output a Bootstrap card for each product
                echo '<div class="col-md-3 mb-3 p-0">';
                    echo '<div class="card border-0 p-2">';
                    echo '<button class="btn btn-border border-success toggle-button" data-productid="' . $row['product_id'] . '" data-title="' . $product_title . '" data-discount="' . $product_discount . '" data-categoryid="' . $categoryId . '">
                        <img src="./admin_area/product_images/' . $product_image1 . '" class="card-img-top shadow-lg" alt="' . $product_title . '">
                    </button>';
                        echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $product_title . '</h5>';
                            echo '<p class="card-text fw-bold"><s>Price: ₹' . $product_price . '</s></p>';
                            echo '<p class="card-text fw-bold">Discount: ₹'. $product_discount.'</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }

            // Close the card deck container div
            echo '</div>';
            // $totalPrice += $product_discount;
            // echo '<div id="total-price" class="mt-3">Total Price: ₹'.$totalPrice.'</div>';
            
            // Add this button after the component buttons
            // echo '<div class="d-flex justify-content-center align-items-center">
            //         <br><br>
            //         <div class = "w-25">
            //             <button id="backButton" class="w-75 shadow-lg rounded text-light bg-danger m-0 fw-bold m-4">Back</button>
            //         </div>
            //         <div class = "w-25">
            //             <button id="nextButton" class="w-75 shadow-lg rounded text-light bg-success m-0 fw-bold">Next</button>
            //         </div>
            //     <br><br>
            // </div>';
        }
        else
        {
            echo "<h1 class='fw-bold'>No stocks available !</h1>";
        }
    }

    // Handle logout
    if (isset($_GET['logout'])) 
    {
        session_unset();
        session_destroy();
        header("Location: build_pc.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Configurator</title>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- css file -->
    <link rel ="stylesheet" href="styles.css">
    <link rel ="stylesheet" href="build_pc_styles.css">
</head>

<body>
    <!-- Add this inside the form -->
    <input type="hidden" id="toggle_state" name="toggle_state" value="0">

    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fw-bold bg-success">
            <!-- first child -->
            <div class="container-fluid">
                <img src="./Images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="display_all.php">Products</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                                        <a class='nav-link text-light' href='./users_area/user_registration.php'>Register</a>
                                    </li>";
                        } else {
                            echo "<li class='nav-item'>
                                        <a class='nav-link text-light' href='chatbox.php?user_id={$_SESSION['user_id']}'>Community</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link text-light' href='./users_area/profile.php'>My Profile</a>
                                    </li>";
                        }
                        ?>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control mr-sm-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
                        <input type="submit" value="Search" class="btn btn-outline-dark" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='#'> Welcome Guest </a>
                        </li>";
                    echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='./users_area/user_login.php'> Login </a>
                        </li>";
                } else {
                    echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='#'> Welcome " . $_SESSION['username'] . " </a>
                        </li>";
                    echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='./users_area/logout.php'> Logout </a>
                        </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h1 class="text-center my-4 mb-4 fw-bold">Custom Build Your PC</h1>
            <!-- <p class="text-center mb-5">Custom build your dream PC setup.</p> -->
        </div>

        <!-- fourth child -->
        <div class="container m-0">
            <div class="col-md-6 image-container p-0">
                <img src="./Images/build_pc.png" alt="PC" class="vertical-image shadow-lg">
                <!-- <img src="./Images/build_pc.png" alt="PC" class="vertical-image shadow-lg"> -->
            </div>
            <div class="col-md-11 text-container" style="max-height: 800px; overflow-y: auto; overflow-x: hidden;">
                <h2>Select the components to configure your PC to measure</h2>
                <p class="text-justify">The PC configurator by PC Components is an ideal tool for selecting individual parts for your computer and experimenting with various configurations and budgets. You can save your settings, print them, or create a shareable link for your social media. It's user-friendly and intuitive, allowing you to easily build a computer tailored to your needs. Whether you're looking for a basic, gaming, or professional desktop PC, you can find it at the best price. Furthermore, you can view the details and availability of each item by clicking on its name.</p>
                <div class="buttons border border-success p-3">
                    <?php
                    foreach ($componentNames as $categoryId => $componentName) {
                        echo "<a href='?category=$categoryId'><button class = 'border border-success fw-bold shadow-lg'>$componentName</button></a>";
                    }
                    ?>
                </div>
                <br>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="w-25">
                        <button id="backButton" class="w-75 shadow-lg rounded text-light bg-danger m-0 fw-bold m-4"><i class="fas fa-arrow-left"></i> Back</button>
                    </div>
                    <div class="w-25">
                        <button id="nextButton" class="w-75 shadow-lg rounded text-light bg-success m-0 fw-bold">Next <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <br>
                <div id="selected-items" class="border border-success p-2">
                    <?php
                    if (isset($_GET['category'])) {
                        echo '<h2 class="my-2 fw-bold">Choose Items:</h2>';
                        $categoryId = $_GET['category'];
                        $selectedComponent = $componentNames[$categoryId];
                        echo "<h3 class='my-4'>Products for $selectedComponent</h3>";
                        // Display products fetched based on the selected category
                        getProductsByCategory($categoryId);
                    }
                    ?>
                    <br><br>
                </div>
                <br>
                <div class="container border border-success m-0 p-4 bg-dark">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Processor (CPU)</th>
                                            <td class = "w-50 text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Motherboard</th>
                                            <td class = "w-50 text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Memory(RAM)</th>
                                            <td class = "w-50 text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Graphics Card(GPU/VGA)</th>
                                            <td class = "w-50 text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Solid State Drive (SSD)</th>
                                            <td class = "w-50 text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Hard Disk Drive(Internal HDD)</th>
                                            <td class = "w-50 text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Cooling System (CPU Cooler)</th>
                                            <td class = "w-50 text-center text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Power Supply Unit (SMPS/PSU)</th>
                                            <td class = "w-50 text-center"></td>
                                            <td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class = "bg-success text-light text-center w-25 fw-bold">Cabinet (Case)</th>
                                            <td class = "w-50 text-center"></td>
                                            <<td class = "w-25 text-center"></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-success text-light text-center fw-bold">Subtotal</th>
                                            <td class = "w-50 text-center"></td>
                                            <td id="subtotal" class="w-25 text-center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="pl-3 ml-2">
                        <div class="">
                            <button id="addToCart" name="addToCart" class="btn btn-success w-100 shadow-lg fw-bold">Add To Cart <i class="fas fa-shopping-cart"></i></button>
                        </div>
                        <br>
                        <div class="">
                            <button id="removeButton" name="remove-button" class="btn btn-danger w-100 shadow-lg fw-bold"><i class="fas fa-trash"></i> Remove All</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <br><br>
        <div class="bg-success p-3 text-light text-center">
            <p class="my-2"><strong>All Rights Reserved ©- Designed by CREEDBOZ-2024<strong></p>
        </div>
    </div>

    <!-- Bootstrap JS links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- displaying the custom pc details -->
    <script>
        // Define an array to store the names of the components
        var componentNames = {
            21: 'Processor (CPU)',
            14: 'Motherboard',
            16: 'Memory (RAM)',
            13: 'Graphics Card (GPU/VGA)',
            18: 'Solid State Drive (SSD)',
            17: 'Hard Disk Drive (Internal HDD)',
            23: 'Cooling System (CPU Cooler)',
            19: 'Power Supply Unit (SMPS/PSU)',
            15: 'Cabinet (Case)'
        };

        // Define an array to store the category IDs in the order of the names
        var categoryIds = [21, 14, 16, 13, 18, 17, 23, 19, 15];

        // Get the current category ID from the URL
        var currentCategoryId = <?php echo isset($_GET['category']) ? $_GET['category'] : '0'; ?>;
        var currentCategoryIndex = categoryIds.indexOf(parseInt(currentCategoryId));

        // Add click event listener to the Next button
        document.getElementById('nextButton').addEventListener('click', function() {
            // Calculate the index of the next item
            var nextIndex = currentCategoryIndex + 1;
            // If the next index is within the bounds of the array, update the URL
            if (nextIndex < categoryIds.length) {
                var nextCategoryId = categoryIds[nextIndex];
                window.location.href = 'build_pc.php?category=' + nextCategoryId;
            } else {
                alert('End of list');
            }
        });

        // Add click event listener to the Back button
        document.getElementById('backButton').addEventListener('click', function() {
            // Calculate the index of the previous item
            var prevIndex = currentCategoryIndex - 1;
            // If the previous index is within the bounds of the array, update the URL
            if (prevIndex >= 0) {
                var prevCategoryId = categoryIds[prevIndex];
                window.location.href = 'build_pc.php?category=' + prevCategoryId;
            } else {
                alert('Start of list');
            }
        });

        // Hide the Back button if at the start of the list
        if (currentCategoryIndex === 0) {
            document.getElementById('backButton').style.display = 'none';
        }

        // Hide the Next button if at the end of the list
        if (currentCategoryIndex === categoryIds.length - 1) {
            document.getElementById('nextButton').style.display = 'none';
        }

        // Get the selected products for each category from session storage and update the table
        for (var i = 0; i < categoryIds.length; i++) {
            var categoryId = categoryIds[i];
            var selectedProduct = sessionStorage.getItem('selectedProduct_' + categoryId);
            if (selectedProduct) 
            {
                selectedProduct = JSON.parse(selectedProduct);
                var tableRow = document.querySelector('table tbody tr:nth-child(' + (i + 1) + ')');
                if (tableRow) 
                {
                    tableRow.querySelector('td:nth-child(2)').textContent = selectedProduct.title;
                    tableRow.querySelector('td:nth-child(3)').textContent = '₹' + selectedProduct.discount + '/-';
                    subtotal += parseInt(selectedProduct.discount);
                }
            }
        }

        // Function to calculate and update the subtotal
        function updateSubtotal() {
            var subtotal = 0;
            for (var i = 0; i < categoryIds.length; i++) {
                var categoryId = categoryIds[i];
                var selectedProduct = sessionStorage.getItem('selectedProduct_' + categoryId);
                if (selectedProduct) 
                {
                    selectedProduct = JSON.parse(selectedProduct);
                    subtotal += parseFloat(selectedProduct.discount);
                }
            }
            // Update the subtotal display
            document.getElementById('subtotal').textContent = '₹' + subtotal + '/-';
            // document.getElementById('subtotalInput').value = subtotal;
        }

        // Call the function initially to set the subtotal to 0
        updateSubtotal();

        // Add click event listener to all toggle buttons
        var toggleButtons = document.querySelectorAll('.toggle-button');
        toggleButtons.forEach(function(button) 
        {
            button.addEventListener('click', function() 
            {
                var productId = this.getAttribute('data-productid');
                var title = this.getAttribute('data-title');
                var discount = this.getAttribute('data-discount');
                var categoryId = this.getAttribute('data-categoryid');

                // Get the table row index based on the category ID
                var rowIndex = categoryIds.indexOf(parseInt(categoryId));

                // Display the product title and discount in the table at the specified row index
                var tableRow = document.querySelector('table tbody tr:nth-child(' + (rowIndex + 1) + ')');
                if (tableRow) 
                {
                    tableRow.querySelector('td:nth-child(2)').textContent = title;
                    tableRow.querySelector('td:nth-child(3)').textContent = '₹' + discount + '/-';
                }

                // Store the selected product's details in session storage
                sessionStorage.setItem('selectedProduct_' + categoryId, JSON.stringify({
                    productId: productId,
                    title: title,
                    discount: discount
                }));

                // Toggle the active class on the button
                if (this.classList.contains('active-toggle')) {
                    this.classList.remove('active-toggle');
                } 
                else 
                {
                    // Remove active class from all buttons before adding it to the current button
                    toggleButtons.forEach(function(btn) 
                    {
                        btn.classList.remove('active-toggle');
                    });
                    this.classList.add('active-toggle');
                }

                // Update the subtotal
                document.getElementById('subtotalInput').value = subtotal;
                updateSubtotal();

                // Show the "Add To Cart" button if there is at least one product added to the table
                if (document.querySelector('table tbody tr td:nth-child(2):not(:empty)')) {
                    document.getElementById('addToCart').style.display = 'block';
                }
            });
        });

        // Handle add to cart button click
        document.getElementById('addToCart').addEventListener('click', function() 
        {
            var selectedProducts = [];
            var tableRows = document.querySelectorAll('table tbody tr');
            tableRows.forEach(function(row) {
                var productName = row.querySelector('td:nth-child(2)').textContent;
                if (productName.trim() !== '') {
                    selectedProducts.push(productName);
                }
            });

            // Send the selected products to your PHP script using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert_pc.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Reset the table rows
                    tableRows.forEach(function(row) {
                        row.querySelector('td:nth-child(2)').textContent = '';
                        row.querySelector('td:nth-child(3)').textContent = '';
                    });
                    // Clear session storage
                    // sessionStorage.clear();
                    // Trigger the remove button click event
                    // document.getElementById('removeButton').click();
                    // Display a success message
                    Swal.fire('Success', 'Products added to cart', 'success');

                    // Clear session storage
                    sessionStorage.clear();
                    // Trigger the remove button click event
                    document.getElementById('removeButton').click();
                } else {
                    Swal.fire('Error', 'Failed to add products to cart', 'error');
                }
            };
            xhr.send(JSON.stringify(selectedProducts));
        });

        // Add click event listener to the remove button
        document.getElementById('removeButton').addEventListener('click', function() {
            // Reset the table rows
            var removeTableRows = document.querySelectorAll('table tbody tr');
            removeTableRows.forEach(function(row) {
                row.querySelector('td:nth-child(2)').textContent = '';
                row.querySelector('td:nth-child(3)').textContent = '';
            });

            // Clear the session storage
            Object.keys(sessionStorage).forEach(function(key) {
                if (key.startsWith('selectedProduct_')) {
                    sessionStorage.removeItem(key);
                }
            });

            // Update the subtotal
            updateSubtotal();

            // Remove the remove button from the DOM
            this.parentElement.removeChild(this);

            // Hide the "Add To Cart" button when all products are removed from the table
            if (!document.querySelector('table tbody tr td:nth-child(2):not(:empty)')) {
                document.getElementById('addToCart').style.display = 'none';
            }
        });
    </script>
</body>

</html>
