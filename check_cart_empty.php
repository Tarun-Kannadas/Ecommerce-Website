<?php
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $userId = $_POST['userId'];

    // Check if the user already has items in the cart
    $checkQuery = "SELECT COUNT(*) AS count FROM pc_cart WHERE user_id = $userId";
    $checkResult = $con->query($checkQuery);
    if ($checkResult->num_rows > 0) 
    {
        $row = $checkResult->fetch_assoc();
        $count = $row["count"];
        if ($count > 0) 
        {
            // User already has items in the cart, send a message indicating the cart is full
            echo 'Cart is full';
        } 
        else 
        {
            // User's cart is empty
            echo 'Cart is empty';
        }
    } 
    else 
    {
        echo 'Error checking cart status.';
    }
}
?>
