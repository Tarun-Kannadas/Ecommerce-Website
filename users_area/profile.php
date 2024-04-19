<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- css file -->
    <link rel ="stylesheet" href="../styles.css">
</head>
<body>
    <div class = "container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <!-- first child -->
            <div class="container-fluid">
                <img src="../Images/logo.png" alt="" class = "logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-light fw-bold" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light fw-bold" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light fw-bold" href="../build_pc.php">Build Your PC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light fw-bold" href="../chatbox.php">Community</a>
                        </li>
                        <li class="nav-item">
                            <a class = "nav-link text-light fw-bold" href="profile.php">My Account</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link text-light fw-bold" href="#">Contact</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link text-light" href="../cart.php"><i class="fa fa-shopping-cart"></i>
                                <sup>
                                    <?php
                                        // cart_items();
                                    ?>
                                </sup>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link text-light" href="../cart.php">
                                Total Price: 
                                <?php
                                    // echo "₹";total_cart_price();
                                ?>
                            </a>
                        </li> -->
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
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
                            <a class = 'nav-link text-light' href='#'> Welcome Guest </a>
                        </li>";
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light' href='user_login.php'> Login </a>
                        </li>";
                    }
                    else
                    {
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light' href='#'> Welcome ".$_SESSION['username']." </a>
                        </li>";
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light' href='logout.php'> Logout </a>
                        </li>";
                    }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h2 class="text-center my-3 fw-bold">CREEDBOZ - User Dashboard</h2>
            <h5 class="text-center m-0 fw-bold">Acquiring and constructing a PC is an uncomplicated endeavor.</h5>
        </div>

        <!-- fourth child -->
        <div class="row">
            <div class="col-md-2 p-0">
                <ul class="rounded navbar-nav bg-dark text-center m-4">
                    <li class="nav-item bg-success rounded">
                        <h4 class = "text-light p-2">Your Profile</h4>
                    </li>
                    
                    <?php
                        $username = $_SESSION['username'];
                        $user_img = "SELECT * FROM user_table WHERE username = '$username'";
                        $result_img = mysqli_query($con,$user_img);
                        $fetch_img = mysqli_fetch_array($result_img);
                        $user_img = $fetch_img['user_image'];

                        echo "<li class='nav-item'>
                            <img src='user_images/$user_img' alt='$user_img' class = 'rounded profile_img my-4'>
                        </li>";
                    ?>
                    
                    <li class="nav-item text-light my-2">
                        <a href="profile.php" class = "btn-success btn-block py-2 text-decoration-none"><strong>Pending Orders</strong></a>
                    </li>

                    <li class="nav-item text-success my-2">
                        <a href="profile.php?edit_account" class = "btn-success btn-block py-2 text-decoration-none"><strong>Edit Account</strong></a>
                    </li>

                    <li class="nav-item text-success my-2">
                        <a href="profile.php?my_orders" class = "btn-success btn-block py-2 text-decoration-none"><strong>My Orders</strong></a>
                    </li>

                    <li class="nav-item text-success my-2">
                        <a href="profile.php?delete_account" class = "btn-success btn-block py-2 text-decoration-none"><strong>Account Delete</strong></a>
                    </li>

                    <li class="nav-item text-success my-2">
                        <a href="logout.php" class = "btn-success btn-block py-2 text-decoration-none"><strong>Logout</strong></a>
                    </li>
                    <br>
                </ul>
            </div>
            <div class="col-md-10 p-4 text-center">
                    <?php
                        get_user_order_details();
                        if(isset($_GET['edit_account']))
                        {
                            include('edit_account.php');
                        }
                        if(isset($_GET['my_orders']))
                        {
                            include('my_orders.php');
                        }
                        if(isset($_GET['delete_account']))
                        {
                            include('delete_account.php');
                        }
                        if(isset($_GET['invoice_number']))
                        {
                            include('order_details.php');
                        }
                        // if(isset($_GET['invoice_number']))
                        // {
                        //     include('delete_order.php');
                        // }
                    ?>
            </div>
        </div>

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
