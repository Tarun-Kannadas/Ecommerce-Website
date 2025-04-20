<?php
    session_start();
    include('../includes/connect.php');
    include('../functions/common_function.php');
    check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DashBoard</title>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- css link -->
    <link rel="stylesheet" href="../styles.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light fw-bold bg-success">
            <div class="container-fluid">
                <img src="../Images/logo.png" alt = "" class = "logo">
                <h2 class="fw-bold">CREEDBOZ PC STORE</h2>
                <nav class="navbar-expand-lg">
                    <ul class="navbar-nav me-auto">
                        <?php
                            if(!isset($_SESSION['admin_name']))
                            {
                                echo "<li class = 'nav-item'>
                                    <a class = 'nav-link text-light bg-dark rounded shadow-lg border border-light' href='admin_login.php'> Login </a>
                                </li>";
                            }
                            else
                            {
                                echo "<li class = 'nav-item'>
                                    <a class = 'nav-link text-light bg-dark rounded shadow-lg border border-light' href=''> Welcome ".$_SESSION['admin_name']." </a>
                                </li>";
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center text-light p-2 fw-bold bg-dark m-0">ADMIN PANEL</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12  bg-secondary p-1 d-flex align-items-center">
                <div class = "p-3">
                    <a href=""><img src="../Images/admin.png" alt="AdminPanel" class = "bg-success rounded shadow-lg border border-white admin_image"></a>
                    <p class="text-light text-center fw-bold">Admin Name</p>
                </div>

                <div class="text-center">
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?insert_product" class="btn bg-dark text-light fw-bold px-3 py-2 ">Insert Products</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?view_products" class="btn bg-dark text-light fw-bold  px-3 py-2">View Products</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?insert_category" class="btn bg-dark text-light fw-bold  px-3 py-2">Insert Categories</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?view_categories" class="btn bg-dark text-light fw-bold  px-3 py-2">View Categories</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?insert_brands" class="btn bg-dark text-light fw-bold  px-3 py-2">Insert Brands</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?view_brands" class="btn bg-dark text-light fw-bold  px-3 py-2">View Brands</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?list_orders" class="btn bg-dark text-light fw-bold  px-3 py-2">All Orders</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?list_payments" class="btn bg-dark text-light fw-bold  px-3 py-2">All Payments</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="index.php?view_users" class="btn bg-dark text-light fw-bold  px-3 py-2">List Users</a>
                    </button>
                    <button class = "btn bg-success p-1 shadow-lg">
                        <a href="logout.php" class="btn bg-dark text-light fw-bold  px-3 py-2">Logout</a>
                    </button>
                </div>
            </div>
        </div>

        <!-- fourth child -->
        <div class="container my-2 p-0 mb-5">
            <?php
                if(isset($_GET['insert_category']))
                {
                    include('insert_categories.php');
                }

                if(isset($_GET['insert_brands']))
                {
                    include('insert_brands.php');
                }

                if(isset($_GET['insert_product']))
                {
                    include('insert_product.php');
                }

                if(isset($_GET['view_products']))
                {
                    include('view_products.php');
                }

                if(isset($_GET['edit_products']))
                {
                    include('edit_products.php');
                }

                if(isset($_GET['delete_product']))
                {
                    include('delete_product.php');
                }

                if(isset($_GET['view_categories']))
                {
                    include('view_categories.php');
                }

                if(isset($_GET['edit_category']))
                {
                    include('edit_category.php');
                }

                if(isset($_GET['delete_category']))
                {
                    include('delete_category.php');
                }

                if(isset($_GET['view_brands']))
                {
                    include('view_brands.php');
                }
                
                if(isset($_GET['edit_brand']))
                {
                    include('edit_brand.php');
                }

                if(isset($_GET['delete_brand']))
                {
                    include('delete_brand.php');
                }

                if(isset($_GET['view_users']))
                {
                    include('view_users.php');
                }

                if(isset($_GET['list_orders']))
                {
                    include('list_orders.php');
                }

                if(isset($_GET['list_payments']))
                {
                    include('list_payments.php');
                }
            ?>
        </div>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- footer -->
    <br><br>
    <div class="bg-success p-3 text-light text-center fixed">
        <p class="my-2"><strong>All Rights Reserved ©- Designed by CREEDBOZ-2024<strong></p>
    </div>
</body>
</html>