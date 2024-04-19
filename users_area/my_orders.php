<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
</head>
<body>
    <?php
        $username = $_SESSION['username'];
        $get_user = "SELECT * FROM user_table";
        $result = mysqli_query($con,$get_user);
        $row_fetch = mysqli_fetch_assoc($result);
        $user_id = $_SESSION['user_id'];
    ?>
    <h3 class="text-success m-5 fw-bold p-2">All My Orders</h3>
    <table class="table table-bordered shadow-lg mt-5 table-dark">
        <thead class = "bg-success">
            <tr>
                <th class ="bg-success">Sl No.</th>
                <th class ="bg-success">Amount</th>
                <th class ="bg-success">Total Products</th>
                <th class ="bg-success">Invoice Number</th>
                <!-- <th class ="bg-success">Date & Time</th> -->
                <th class ="bg-success">Order Status</th>
                <th class ="bg-success">Payment</th>
                <th class ="bg-success">Tracking</th>
            </tr>
        </thead>
        <tbody class = "bg-secondary text-light p-2">
            <?php
                $num = 0;
                $get_order_details = "SELECT * FROM user_orders WHERE user_id = $user_id";
                $result_orders = mysqli_query($con, $get_order_details);
                while($row_orders = mysqli_fetch_assoc($result_orders))
                {
                    $order_id = $row_orders['order_id'];
                    $amount_due = $row_orders['amount_due'];
                    $order_date = $row_orders['order_date'];
                    $timestamp = strtotime($order_date);
                    $date = date("d-m-Y",$timestamp);
                    $time = date("h:i A",$timestamp);
                    $total_products = $row_orders['total_products'];
                    $invoice_number = $row_orders['invoice_number'];
                    $order_status = $row_orders['order_status'];
                    $tracking_status = $row_orders['tracking_status'];
                    $payment_status = $row_orders['payment_status'];
                    if($payment_status == 'Unpaid')
                    {
                        $payment_status = 'Incomplete';
                    }
                    else
                    {
                        $payment_status = 'Complete';
                    }
                    $num ++;
                    echo "<tr>
                    <td>$num</td>";
                        if($payment_status == 'Complete')
                        {
                            echo "<td>₹0/-</td>";
                        }
                        else
                        {
                            echo "<td>₹$amount_due/-</td>";
                        }
                    echo "<td><a href='profile.php?invoice_number=$invoice_number' class = 'btn btn-success fw-bold shadow-lg'>$total_products</a></td>
                    <td>$invoice_number</td>
                    <td>$order_status</td>";
                ?>
                <?php 
                    if($payment_status == 'Complete')
                    {
                        echo "<td class = 'fw-bold'>Paid</td>";
                    }
                    else
                    {
                        echo "<td>
                                <a href = 'confirm_payment.php?order_id=$order_id' class = 'btn btn-success fw-bold text-light p-2' text-decoration-none>CONFIRM</a>
                            </td>";
                    }
                    if ($tracking_status == 'Ordered' || $tracking_status == 'Shipped' || $tracking_status == 'Out_of_delivery') 
                    {
                        echo "<td><a href='tracking.php?order_id=$order_id' class='btn fw-bold btn-success'>TRACK</a></td>";
                    }
                    elseif ($tracking_status == 'Delivered')
                    {
                        echo "<td class='text-light'>Delivered</td>";
                    }
                    else 
                    {
                        echo "<td class='text-light'>N/A</td>";
                    }
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
</body>
</html>