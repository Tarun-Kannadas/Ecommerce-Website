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

        <br>

        <!-- fourth child-table -->
        <div class="container rounded shadow-lg text-center d-flex bg-dark text-light p-4 justify-content-center">
            <div class="row">
                <form action="" class="m-0 p-0" method="post">
                <table class="table table-responsive rounded py-2 text-light text-center">
                    <h2 class = "bg-secondary fw-bold text-light m-0 mb-3 p-3 rounded">Shopping Cart</h2>
                        <!-- php code to display dynamic data -->
                        <?php
                            global $con;

                            $user_id = $_SESSION['user_id'];
                            $total = 0;
                            $cart_query = "SELECT cart_details.quantity, products.stocks, products.product_title, products.product_image1, products.product_discount, products.product_price, products.product_id
                                        FROM cart_details
                                        JOIN products ON cart_details.product_id = products.product_id
                                        WHERE cart_details.user_id='$user_id'";
                            $result = mysqli_query($con, $cart_query);
                            $result_count = mysqli_num_rows($result);
                            if($result_count>0)
                            {
                                echo "<thead>
                                    <tr>
                                        <th class = 'bg-success'><b>Product Title</b></th>
                                        <th class = 'bg-success'><b>Product Image</b></th>
                                        <th class = 'bg-success'><b>Quantity</b></th>
                                        <th class = 'bg-success'><b>Total Price</b></th>
                                        <th class = 'bg-success' colspan='2'><b>Operations</b></th>
                                    </tr>
                                </thead>
                                <tbody>";

                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $product_id = $row['product_id'];
                                    $product_price = $row['product_discount'];
                                    $price_table = $row['product_discount'];
                                    $product_title = $row['product_title'];
                                    $product_image1 = $row['product_image1'];
                                    $quantity = $row['quantity'];
                                    $stocks = $row['stocks'];
                                    $total += $product_price * $quantity;
                    
                            ?>
                                <tr>
                                    <td class = 'bg-secondary text-light'><?php echo $product_title ?></td>
                                    <td class = 'bg-secondary text-light'><img class = "cart_img" src="./admin_area/product_images/<?php echo $product_image1 ?>" alt="<?php echo $product_image1 ?>"></td>
                                    <td class = 'bg-secondary text-light' style = "width: 15%">
                                        <select name="qty[<?php echo $product_id ?>]" class="form-select text-center w-75">
                                            <?php
                                                // Loop to create options from 1 to 10
                                                for ($i = 1; $i <= 10; $i++) {
                                                    // Check if the current option matches the quantity, and set it as selected if true
                                                    $selected = ($i == $quantity) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$i</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td class = 'bg-secondary text-light'><?php echo "₹".$product_price * $quantity."/-" ?></td>
                                    <td  class = 'bg-secondary text-light' colspan="4">
                                        <button type="submit" name="update_cart" class="btn my-2 shadow-lg fw-bold bg-success px-3 py-2 border-0">
                                            <i class="fas fa-sync-alt"></i> Update
                                        </button>
                                        <input type="hidden" name="removeitem" id="removeitem" value="<?php echo $product_id ?>">
                                        <button type="submit" name="remove_cart" id="remove_cart" value="<?php echo $product_id ?>" class="btn btn-danger shadow-lg fw-bold">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                        <!-- <input class = "btn shadow-lg fw-bold bg-danger px-3 py-2 border-0" type="submit" value = "Remove Cart" name="remove_cart"> -->
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            else
                            {
                                echo "<div class='alert alert-danger text-center' role='alert'>
                                <h4 class='alert-heading'>Shopping Cart is Empty <i class='fas fa-exclamation'></i></h4>
                                </div>";
                            }
                        ?>
                    </tbody>
                </table>
                <!-- subtotal -->
                <div class = "d-flex mb-2 justify-content-center">
                    <?php
                        $user_id = $_SESSION['user_id'];
                        $cart_sum_query = "Select * from cart_details where user_id='$user_id'";
                        $result = mysqli_query($con, $cart_sum_query);
                        $result_count = mysqli_num_rows($result);
                        if($result_count>0)
                        {
                            echo "<h4 class='px-3 fw-bold '>Subtotal:<strong class = 'fw-bold text-light'> ₹$total/- </strong></h4>
                            <input class = 'btn fw-bold bg-success px-3 py-2 border-0' type = 'submit' value = 'Continue Shopping' name='continue_shopping'>
                            <a href='./users_area/checkout.php' class = 'shadow-lg btn fw-bold text-decoration-none text-light bg-secondary px-4 py-2 border-0 mx-2'>
                                Checkout
                            </a>";
                        }
                        else
                        {
                            echo "<input class = 'btn fw-bold text-light bg-success px-3 py-2 border-0 mx-2' type = 'submit' value = 'Continue Shopping' name='continue_shopping'>";
                        }

                        if(isset($_POST['continue_shopping']))
                        {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                    ?>
                </div>
            </div>
        </div>
        </form>

        <!-- function to remove item -->
        <?php
            function remove_cart_item()
            {
                global $con;

                if(isset($_POST['remove_cart']))
                {
                    $remove_id = $_POST['remove_cart'];
                    $delete_query = "DELETE from cart_details where product_id = $remove_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if($run_delete)
                    {
                        echo "<script>
                            Swal.fire({
                                title: 'Removed from the Cart Successfully',
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => 
                            {
                                window.location.href = 'cart.php';
                            });
                        </script>";
                    }
                    else
                    {
                        echo "<script>
                            Swal.fire({
                                title: 'Unable to remove from the cart',
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => 
                            {
                                window.location.href = 'cart.php';
                            });
                        </script>";
                    }
                }
            }
            echo $remove_item = remove_cart_item();
        ?>

        <!-- function to update item quantity-->
        <?php
            function update_cart()
            {
                global $con;
            
                if(isset($_POST['update_cart']))
                {
                    $all_updates_successful = true; // Flag to track if all updates were successful
            
                    foreach($_POST['qty'] as $product_id => $quantity)
                    {
                        // Retrieve the current stock quantity of the product
                        $stock_query = "SELECT stocks FROM products WHERE product_id = $product_id";
                        $stock_result = mysqli_query($con, $stock_query);
                        $stock_row = mysqli_fetch_assoc($stock_result);
                        $stock_quantity = $stock_row['stocks'];
            
                        if($quantity <= $stock_quantity)
                        {
                            // Update the cart quantity
                            $update_query = "UPDATE cart_details SET quantity = '$quantity' WHERE product_id = $product_id";
                            $run_update = mysqli_query($con, $update_query);
                            if(!$run_update)
                            {
                                $all_updates_successful = false;
                                break; // Exit the loop if any update fails
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
            
                            $all_updates_successful = false;
                            break; // Exit the loop if stock is not enough
                        }
                    }
            
                    if($all_updates_successful)
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
                                window.location.href = 'cart.php';
                            });
                        </script>";
                    }
                }
            }
            echo $update_cart = update_cart();            
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