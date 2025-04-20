<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Tracking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <style>
        body {
            background-image: url('https://i.pinimg.com/564x/b0/9f/0b/b09f0bdba59d667fbd3b662554455ac4.jpg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-5 fw-bold text-light">Admin Order Tracking Panel</h3>
        <table class="table table-bordered fw-bold mt-5">
            <thead>
                <tr>
                    <th class='bg-success text-center'>Order ID</th>
                    <th class='bg-success text-center'>Invoice Number</th>
                    <th class='bg-success text-center'>Tracking Status</th>
                    <th class='bg-success text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_GET['order_id'])) 
                    {
                        $order_id = $_GET['order_id'];
                        $get_order_query = "SELECT * FROM user_orders WHERE order_id = $order_id";
                        $result = mysqli_query($con, $get_order_query);
                        $row = mysqli_fetch_assoc($result);

                        if($row) 
                        {
                            $tracking_status = $row['tracking_status'];
                            $order_status = $row['order_status'];
                            $invoice_number = $row['invoice_number'];
                            echo "<tr>
                                <td class='bg-secondary text-light text-center'>$order_id</td>
                                <td class='bg-secondary text-light text-center'>$invoice_number</td>
                                <td class='bg-secondary text-light text-center'>
                                    <div class='progress'>
                                        <div class='progress-bar bg-success progress-bar-striped' role='progressbar' style='width: ";

                            switch ($tracking_status) 
                            {
                                case 'Ordered':
                                    echo "25%";
                                    break;
                                case 'Shipped':
                                    echo "50%";
                                    break;
                                case 'Out_of_delivery':
                                    echo "75%";
                                    break;
                                case 'Delivered':
                                    echo "100%";
                                    break;
                                default:
                                    echo "0%";
                            }

                            echo ";' aria-valuenow='";

                            switch ($tracking_status) 
                            {
                                case 'Ordered':
                                    echo "25";
                                    break;
                                case 'Shipped':
                                    echo "50";
                                    break;
                                case 'Out_of_delivery':
                                    echo "75";
                                    break;
                                case 'Delivered':
                                    echo "100";
                                    break;
                                default:
                                    echo "0";
                            }

                            echo "' aria-valuemin='0' aria-valuemax='100'>$tracking_status</div>
                                    </div>
                                </td>
                                <td class='bg-secondary text-light text-center'>";

                            if($tracking_status == 'Ordered') 
                            {
                                echo "<a href='update_tracking.php?order_id=$order_id&action=shipped' class='btn fw-bold btn-success'>Mark as Shipped</a>";
                            } 
                            elseif ($tracking_status == 'Shipped') 
                            {
                                echo "<a href='update_tracking.php?order_id=$order_id&action=out_of_delivery' class='btn fw-bold btn-success'>Mark as Out of Delivery</a>";
                            } 
                            elseif ($tracking_status == 'Out_of_delivery') 
                            {
                                echo "<a href='update_tracking.php?order_id=$order_id&action=delivered' class='btn fw-bold btn-success'>Mark as Delivered</a>";
                            } 
                            else 
                            {
                                echo "Delivered";
                            }

                            echo "</td></tr>";
                        } 
                        else 
                        {
                            echo "<tr><td class='bg-secondary text-center' colspan='3'>Order not found.</td></tr>";
                        }
                    } 
                    else 
                    {
                        echo "<tr><td class='bg-secondary text-center' colspan='3'>Invalid request.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <a href="index.php?list_orders" class="btn fw-bold btn-success">Back to Admin Panel</a>
    </div>
</body>
</html>