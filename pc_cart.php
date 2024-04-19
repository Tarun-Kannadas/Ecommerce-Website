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
    <title>Ecommerce Website-Cart Details</title>
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
                            <a class="nav-link text-light" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="build_pc.php">Build Your PC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="chatbox.php">Community</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./users_area/profile.php">My Profile</a>
                        </li>
                        <?php
                            if(!isset($_SESSION['username']))
                            {
                                echo "<li class='nav-item'>
                                    <a class = 'nav-link text-light' href=''./users_area/user_registration.php'>Register</a>
                                </li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- calling cart function -->
        <?php
            cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav me-auto">
                <?php
                    if(!isset($_SESSION['username']))
                    {
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link fw-bold text-light' href=''> Welcome Guest </a>
                        </li>";
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link fw-bold text-light' href='./users_area/user_login.php'> Login </a>
                        </li>";
                    }
                    else
                    {
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link fw-bold text-light' href=''> Welcome ".$_SESSION['username']." </a>
                        </li>";
                        echo "<li class = 'nav-item text-light'>
                            <a class = 'nav-link fw-bold text-light' href='./users_area/logout.php'> Logout </a>
                        </li>";
                    }
                ?>
            </ul>
        </nav>

        <!-- pc_cart -->
        <?php
        global $con;

        $user_id = $_SESSION['user_id'];
        $total = 0;
        $cart_query = "SELECT pc_cart.product_id, products.stocks, pc_cart.quantity, products.product_title, products.product_image1, pc_cart.discount
                        FROM pc_cart
                        JOIN products ON pc_cart.product_id = products.product_id
                        WHERE pc_cart.user_id='$user_id'";
        $result = mysqli_query($con, $cart_query);
        $result_count = mysqli_num_rows($result);
        if ($result_count > 0) {
            echo "<div class='d-flex justify-content-center mt-3 align-items-center'>
                    <div class='table-responsive bg-dark p-4 text-light rounded col-7'>
                        <table class='table table-bordered rounded m-0 text-center'>
                            <h2 class='text-center fw-bold mb-4 bg-secondary text-success p-3 rounded shadow-lg'>My Custom PC Cart</h2>
                            <thead>
                                <tr>
                                    <th class = 'bg-success'>Product Title</th>
                                    <th class = 'bg-success'>Product Image</th>
                                    <th class = 'bg-success'>Stocks</th>
                                    <th class = 'bg-success'>Quantity</th>
                                    <th class = 'bg-success'>Total Price</th>
                                    <th class = 'bg-success'>Operations</th>
                                </tr>
                            </thead>
                            <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_price = $row['discount'];
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $quantity = $row['quantity']; // Assuming quantity is always 1 for each product in pc_cart
                $stocks = $row['stocks'];
                $total += $product_price * $quantity;

                echo "<form method='POST' action=''>
                <input type='hidden' name='product_id' value='$product_id'>
                <tr>
                    <td class = 'bg-secondary text-light'>$product_title</td>
                    <td class = 'bg-secondary text-light'><img class='cart_img' src='./admin_area/product_images/$product_image1' alt='$product_image1'></td>
                    <td class = 'bg-secondary text-light'>". $stocks ."</td>
                    <td class = 'bg-secondary text-light' style = 'width: 12%'>
                        <select name='qty[$product_id]' class='text-center form-select w-80'>";
                            $selected_quantity = isset($_POST['qty'][$product_id]) ? $_POST['qty'][$product_id] : $quantity;
                            for ($i = 1; $i <= 10; $i++) {
                                $selected = ($i == $selected_quantity) ? 'selected' : '';
                                echo "<option value='$i' $selected>$i</option>";
                            }
                echo "</select>
                        </td>
                        <td class = 'bg-secondary text-light'>₹" . $product_price * $quantity . "/-</td>
                        <td class = 'bg-secondary text-light'>
                            <button type='submit' name='update_pc_cart' class='btn shadow-lg fw-bold bg-success px-3 py-2 border-0'>
                                <i class='fas fa-sync-alt'></i> Update
                            </button>
                        </td>
                    </tr>
                </form>";
            }

            echo "</tbody>
                </table>
                </div>
            </div>";

            // Subtotal and Checkout Buttons
            echo "<div class='d-flex justify-content-center align-items-center mt-3'>
                <h3 class='fw-bold'>Subtotal: <span class='text-success'>₹$total/-</span></h3>
                <form action='./users_area/pc_checkout.php' method='POST'> 
                    <button type='submit' class='btn btn-success fw-bold ml-2 px-3 py-2'>Checkout</button>
                </form>
                <form method='POST'>
                    <input type='hidden' name='delete_user_id' value='$user_id'>
                    <button type='submit' name='delete_cart_items' class='btn btn-danger ml-2 fw-bold p-2'>Delete All Items</button>
                </form>          
            </div>";
        } 
        else 
        {
            echo "<div class='text-center'>";
                echo "<div class='d-flex justify-content-center align-items-center'>
                    <div class='alert alert-danger rounded container text-center my-3' role='alert'>
                        <h4 class='alert-heading my-1'> PC Cart is Empty <i class='fas fa-exclamation'></i></h4>
                    </div>
                </div>";

                echo "<form action='build_pc.php' method='post'>";
                    echo "<button class='btn fw-bold text-light bg-success px-3 py-2 border-0 mx-2' type='submit' name='build_custom_pc'>Build Custom PC</button>";
                echo "</form>";
                
                if(isset($_POST['build_custom_pc']))
                {
                    echo "<script>window.open('build_pc.php','_self')</script>";
                }
            echo "</div>";
        }
        ?>

        <!-- function to remove pc item -->
        <?php
            function remove_pc_cart_item()
            {
                global $con;

                if (isset($_POST['delete_cart_items'])) {
                    $delete_user_id = $_POST['delete_user_id'];
                    $delete_query = "DELETE FROM pc_cart WHERE user_id = $delete_user_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if ($run_delete) {
                        echo "<script>
                            Swal.fire({
                                title: 'All items removed from the Cart Successfully',
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => 
                            {
                                window.location.href = 'pc_cart.php';
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                title: 'Unable to remove all items from the cart',
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => 
                            {
                                window.location.href = 'pc_cart.php';
                            });
                        </script>";
                    }
                }
            }
            echo $remove_pc_item = remove_pc_cart_item();
        ?>

        <!-- function to update item quantity-->
        <?php
            function update_pc_cart()
            {
                global $con;

                if (isset($_POST['update_pc_cart'])) 
                {
                    foreach ($_POST['qty'] as $product_id => $quantity) 
                    {
                        // Retrieve the current stock quantity of the product
                        $stock_query = "SELECT stocks FROM products WHERE product_id = $product_id";
                        $stock_result = mysqli_query($con, $stock_query);
                        $stock_row = mysqli_fetch_assoc($stock_result);
                        $stock_quantity = $stock_row['stocks'];
                        
                        if($quantity <= $stock_quantity)
                        {
                            $update_query = "UPDATE pc_cart SET quantity = '$quantity' WHERE product_id = $product_id";
                            $run_update = mysqli_query($con, $update_query);
                            if ($run_update) 
                            {
                                echo "<script>
                                    Swal.fire({
                                        title: 'Cart Updated Successfully',
                                        icon: 'success',
                                        showClass: {
                                            popup: 'animate__animated animate__shakeX'
                                        },
                                        confirmButtonColor: '#4caf50',
                                        confirmButtonText: 'OK'
                                    }).then((result) => 
                                    {
                                        window.location.href = 'pc_cart.php';
                                    });
                                </script>";
                            } 
                            else 
                            {
                                echo "<script>
                                    Swal.fire({
                                        title: 'Failed to Update Cart',
                                        icon: 'error',
                                        showClass: {
                                            popup: 'animate__animated animate__shakeX'
                                        },
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: 'OK'
                                    });
                                </script>";
                            }
                        }
                        else
                        {
                            echo "<script>
                                Swal.fire({
                                    title: 'Not Enough Stock',
                                    text: 'There are only $stock_quantity items left in stock for this product.',
                                    icon: 'warning',
                                    showClass: {
                                        popup: 'animate__animated animate__shakeX'
                                    },
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                });
                            </script>";
                        }
                    }
                }
            }
            echo $update_pc_cart = update_pc_cart();
        ?>
        

        <!-- footer -->
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