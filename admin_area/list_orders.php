<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h3 class="text-center text-success fw-bold my-4">All Orders</h3>

        <!-- Filter form -->
        <form method="post">
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="start_date" class = "fw-bold">Start Date:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div class="form-group col-md-4">
                    <label for="end_date" class = "fw-bold">End Date:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <div class="form-group col-md-4">
                    <label for="order_status" class = "fw-bold">Order Status:</label>
                    <select class="form-control" id="order_status" name="order_status">
                        <option value="All">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Complete">Complete</option>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-2 mt-auto">
                    <button type="submit" class="btn btn-success fw-bold btn-block" name="filter">Filter</button>
                </div>
                <div class="form-group col-md-2 mt-auto">
                    <button type="submit" class="btn btn-dark fw-bold btn-block" name="view_all">All Orders</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered mt-5">
            <thead>
                <tr class='text-center'>
                    <th class='bg-success'>Sl No</th>
                    <th class='bg-success'>Username</th>
                    <th class='bg-success'>Amount Paid</th>
                    <th class='bg-success'>Invoice Number</th>
                    <th class='bg-success'>Total Products</th>
                    <th class='bg-success'>Payment</th>
                    <th class='bg-success'>Order Status</th>
                    <th class = 'bg-success'>Tracking</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Include database connection code here
                    // Assume $con is your database connection

                    $sql = "SELECT u.username, o.* FROM user_orders o JOIN user_table u ON o.user_id = u.user_id";

                    if (isset($_POST['filter'])) {
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        $order_status = $_POST['order_status'];

                        if ($order_status != 'All') {
                            $sql .= " WHERE order_date BETWEEN '$start_date' AND '$end_date' AND order_status = '$order_status'";
                        } else {
                            $sql .= " WHERE order_date BETWEEN '$start_date' AND '$end_date'";
                        }
                    }

                    $result = mysqli_query($con, $sql);
                    $num_rows = mysqli_num_rows($result);

                    if ($num_rows == 0) {
                        echo "<tr><td colspan='7' class='text-center'>No Orders Yet</td></tr>";
                    } else {
                        $num = 0;
                        while ($row_data = mysqli_fetch_assoc($result)) {
                            $num++;
                            $username = $row_data['username'];
                            $order_id = $row_data['order_id'];
                            $amount_due = $row_data['amount_due'];
                            $invoice_number = $row_data['invoice_number'];
                            $total_products = $row_data['total_products'];
                            $order_date = $row_data['order_date'];
                            $timestamp = strtotime($order_date);
                            $date = date("d-m-Y", $timestamp);
                            $time = date("h:i A", $timestamp);
                            $order_status = $row_data['order_status'];
                            $payment_status = $row_data['payment_status'];
                            $tracking_status = $row_data['tracking_status'];

                            echo "<tr class='text-center'>
                                    <td class='bg-secondary text-light'>$num</td>
                                    <td class='bg-secondary text-light'>$username</td>
                                    <td class='bg-secondary text-light'>$amount_due</td>
                                    <td class='bg-secondary text-light'>$invoice_number</td>
                                    <td class='bg-secondary text-light'>$total_products</td>
                                    <td class='bg-secondary text-light'>$payment_status</td>
                                    <td class='bg-secondary text-light'>$order_status</td>";

                            if ($tracking_status == 'Ordered' || $tracking_status == 'Shipped' || $tracking_status == 'Out_of_delivery') 
                            {
                                echo "<td class='bg-secondary text-light'><a href='tracking.php?order_id=$order_id' class='btn secondary fw-bold btn-success'>TRACK</a></td>";
                            } 
                            elseif ($tracking_status == 'Delivered')
                            {
                                echo "<td class='bg-secondary text-light'>Delivered</td>";
                            }
                            else 
                            {
                                echo "<td class='bg-secondary text-light'>N/A</td>";
                            }
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
