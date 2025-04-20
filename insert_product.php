<?php
    include('includes/connect.php');

    // Generate a random build_id
    // $buildId = rand(1000, 9999);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $productId = $_POST['productId'];
        $title = $_POST['title'];
        $discount = $_POST['discount'];
        $userId = $_POST['userId'];

        // Insert the selected product into the database table
        $sql = "INSERT INTO pc_cart (product_id, product_title, discount, user_id, quantity) VALUES ($productId, '$title', $discount, $userId, 1)";
        if ($con->query($sql) === TRUE) {
            echo 'Product inserted successfully!';
            
        } else {
            echo 'Error inserting product: ' . $con->error;
        }
    }
?>