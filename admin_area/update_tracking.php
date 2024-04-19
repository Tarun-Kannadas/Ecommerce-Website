<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();

    if(isset($_GET['order_id']) && isset($_GET['action'])) {
        $order_id = $_GET['order_id'];
        $action = $_GET['action'];

        // Update the tracking status based on the action
        switch ($action) {
            case 'shipped':
                $tracking_status = 'Shipped';
                $order_status = 'pending';
                break;
            case 'out_of_delivery':
                $tracking_status = 'Out_of_delivery';
                $order_status = 'pending';
                break;
            case 'delivered':
                $tracking_status = 'Delivered';
                $order_status = 'Complete';
                break;
            default:
                // Invalid action, redirect back to the order tracking page
                header("Location: tracking.php?order_id=$order_id");
                exit();
        }

        // Update the tracking status in the database
        $update_query = "UPDATE user_orders SET order_status = '$order_status', tracking_status='$tracking_status' WHERE order_id=$order_id";
        mysqli_query($con, $update_query);

        // Redirect back to the order tracking page
        header("Location: tracking.php?order_id=$order_id");
        exit();
    } else {
        // Invalid request, redirect to home page or display an error message
        header("Location: ../index.php");
        exit();
    }
?>
