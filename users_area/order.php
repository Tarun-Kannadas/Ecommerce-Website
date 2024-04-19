<html>
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
        <?php
            include('../includes/connect.php');
            include('../functions/common_function.php');

            if(isset($_GET['user_id']))
            {
                $user_id = $_GET['user_id'];
            }

            // Calculate total price
            $total_price = 0;
            $cart_query_price = "SELECT products.product_id, products.product_discount, cart_details.quantity 
                                FROM cart_details 
                                JOIN products ON cart_details.product_id = products.product_id
                                WHERE cart_details.user_id = '$user_id'";
            $result = mysqli_query($con, $cart_query_price);
            $invoice_number = mt_rand();
            $status = 'pending';
            $count_products = mysqli_num_rows($result);
            while($row_fetch = mysqli_fetch_array($result))
            {
                $product_price = $row_fetch['product_discount'];
                $quantity = $row_fetch['quantity'];
                $product_id = $row_fetch['product_id'];
                $total_price += ($product_price * $quantity);

                // Insert pending orders
                $insert_pending_orders = "INSERT INTO orders_pending (user_id, invoice_number, product_id, quantity, order_status, code) 
                            VALUES ($user_id, $invoice_number, '$product_id', '$quantity', '$status', 'normal')";
                $result_pending_orders = mysqli_query($con, $insert_pending_orders);
            }

            // Insert order details
            $insert_orders = "INSERT INTO user_orders (user_id, amount_due, invoice_number, total_products, order_date, order_status, code, payment_status) 
                            VALUES ($user_id, $total_price, $invoice_number, $count_products, NOW(), '$status', 'normal', 'Unpaid')";
            $result_query = mysqli_query($con, $insert_orders);

            if($result_query)
            {
                // Update product stocks
                mysqli_data_seek($result, 0); // Reset result pointer
                while($row_fetch = mysqli_fetch_array($result))
                {
                    $product_id = $row_fetch['product_id'];
                    $quantity = $row_fetch['quantity'];
                    // Update stocks in products table
                    $update_stocks_query = "UPDATE products SET stocks = stocks - $quantity WHERE product_id = $product_id";
                    $result_update_stocks = mysqli_query($con, $update_stocks_query);
                }

                // Delete items from cart
                $empty_cart = "DELETE FROM cart_details WHERE user_id='$user_id'";
                $run_empty_cart = mysqli_query($con, $empty_cart);

                echo "<script>
                    Swal.fire({
                        title: 'Orders are Submitted Successfully',
                        icon: 'success',
                        showClass: {
                            popup: 'animate__animated animate__shakeX'
                        },
                        confirmButtonColor: '#4caf50',
                        confirmButtonText: 'OK'
                    }).then((result) => 
                    {
                        window.location.href = 'profile.php';
                    });
                </script>";
            }
            else
            {
                echo "<script>
                    Swal.fire({
                        title: 'Orders are not Submitted Successfully',
                        icon: 'error',
                        showClass: {
                            popup: 'animate__animated animate__shakeX'
                        },
                        confirmButtonColor: '#4caf50',
                        confirmButtonText: 'OK'
                    }).then((result) => 
                    {
                        window.location.href = 'payment.php';
                    });
                </script>";
            }
        ?>
    <body>
</html>