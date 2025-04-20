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
<?php
include('../includes/connect.php');

if(isset($_GET['invoice_number']))
{
    $invoice_number = $_GET['invoice_number'];
    $get_order_details = "SELECT * FROM orders_pending WHERE invoice_number = $invoice_number";
    $result_orders = mysqli_query($con, $get_order_details);
    echo "<h3 class='my-4 mb-2'>Order's Details</h3>";
    echo "<div class='d-flex justify-content-center'>
    <table class='table table-bordered mt-3 w-75'>
        <thead class='bg-success'>
            <tr>
                <th class='bg-success'>Product Name</th>
                <th class='bg-success'>Product Image</th>
                <th class='bg-success'>Quantity</th>
                <th class='bg-success'>Price</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light p-2'>";
    while($row_orders = mysqli_fetch_assoc($result_orders))
    {
        $product_id = $row_orders['product_id'];
        $quantity = $row_orders['quantity'];
        $invoice_number = $row_orders['invoice_number'];
        $get_product_details = "SELECT * FROM products WHERE product_id = $product_id";
        $result_product = mysqli_query($con, $get_product_details);
        while($row_product = mysqli_fetch_assoc($result_product))
        {
            $product_title = $row_product['product_title'];
            $product_price = $row_product['product_discount'];
            $product_image = $row_product['product_image1'];
            echo "<tr>
                <td class='bg-dark text-light'>$product_title</td>
                <td class='bg-dark text-light'><img src='../admin_area/product_images/$product_image' alt='$product_image' style='max-width: 100px; max-height: 100px;' class = 'rounded profile_img my-4'></td>
                <td class='bg-dark text-light'>$quantity</td>
                <td class='bg-dark text-light'>$product_price</td>
            </tr>";
        }
    }
    echo "</tbody></table></div>";
    // echo "<a href='profile.php?invoice_number=$invoice_number' class='btn btn-danger'>Delete Order</a>";
}
?>
