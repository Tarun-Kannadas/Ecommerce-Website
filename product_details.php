<?php
    include('includes/connect.php');
    include('functions/common_function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website using PHP and MySql</title>
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
</head>
<body>
    <div class = "container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fw-bold bg-success">
            <!-- first child -->
            <div class="container-fluid">
                <img src="./Images/logo.png" alt="" class = "logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-light fw-bold" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light fw-bold" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-light" href="build_pc.php">Build Your PC</a>
                        </li>
                        <?php
                            if (!isset($_SESSION['username'])) 
                            {
                                echo "<li class='nav-item'>
                                        <a class='nav-link text-light' href='./users_area/user_registration.php'>Register</a>
                                    </li>";
                            } 
                            else 
                            {
                                echo "<li class='nav-item'>
                                        <a class='nav-link text-light' href='chatbox.php?user_id={$_SESSION['user_id']}'>Community</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link text-light' href='./users_area/profile.php'>My Profile</a>
                                    </li>";
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="cart.php"><i class="fa fa-shopping-cart"></i>
                                <sup>
                                    <?php
                                        cart_items();
                                    ?>
                                </sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="">
                                Total Price: 
                                <?php
                                    echo "₹";total_cart_price();
                                ?>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control mr-sm-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
                        <input type = "submit" value = "Search" class = "btn btn-outline-dark" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav me-auto">
            <?php
                    if(!isset($_SESSION['username']))
                    {
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='#'> Welcome Guest </a>
                        </li>";
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='./users_area/user_login.php'> Login </a>
                        </li>";
                    }
                    else
                    {
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='#'> Welcome ".$_SESSION['username']." </a>
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
            <h3 class="text-center">CREEDBOZ</h3>
            <p class="text-center">Acquiring and constructing a PC is an uncomplicated endeavor.</p>
        </div>

        <!-- fourth child -->
        <div class="row px-1">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                    <!-- fetching products -->
                    <?php
                        // calling functions
                        view_details();
                        get_unique_categories(); // Display products from the selected category
                        get_unique_brands(); // Display products from the selected brand 
                    ?>
                    <!-- row end -->
                </div>
                <!-- col end -->
            </div>

            <div class="col-md-2 rounded p-0">
                <!-- Brands to be displayed  -->
                <ul class="shadow-lg rounded navbar-nav text-center m-0">
                    <img src="./Images/circuit.jpg" alt="">
                    <img src="./Images/social_media.jpg" alt="">
                </ul>
            </div>
        </div>

        <!-- footer.php -->
        <br>
        <div class="bg-success p-3 text-light text-center">
            <p class="my-2"><strong>All Rights Reserved ©- Designed by CREEDBOZ-2024<strong></p>
        </div>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
