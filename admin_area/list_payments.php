<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Payments</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h3 class="text-center text-success fw-bold my-4">All Payments</h3>

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
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-5">
                    <label for="payment_mode" class="fw-bold">Payment Mode:</label>
                    <select class="form-control" id="payment_mode" name="payment_mode">
                        <option value="0">All</option>
                        <option value="1">UPI</option>
                        <option value="2">Net Banking</option>
                        <option value="4">Cash On Delivery</option>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-2 mt-auto">
                    <button type="submit" class="btn fw-bold btn-success btn-block">Filter</button>
                </div>
                <div class="form-group col-md-2 mt-auto">
                    <button type="submit" class="btn fw-bold btn-dark btn-block" name="view_all">All Payments</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered mt-5">
            <thead>
                <tr class='text-center'>
                    <th class='bg-success'>Sl No</th>
                    <th class='bg-success'>Invoice Number</th>
                    <th class='bg-success'>Amount</th>
                    <th class='bg-success'>Payment Mode</th>
                    <th class='bg-success'>Order Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    function getPaymentModeText($mode) 
                    {
                        switch($mode) 
                        {
                            case 1:
                                return "UPI";
                            case 2:
                                return "Net Banking";
                            case 3:
                                return "PayPal";
                            case 4:
                                return "Cash On Delivery";
                            default:
                                return "Credit/Debit Card";
                        }
                    }

                    // Check if a specific payment mode is selected
                    $filter_payment_mode = isset($_POST['payment_mode']) ? $_POST['payment_mode'] : 0;

                    if (isset($_POST['view_all'])) {
                        $sql = "SELECT * FROM user_payments";
                    } else {
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $start_date = $_POST['start_date'];
                            $end_date = $_POST['end_date'];
                            if ($filter_payment_mode == 0) {
                                $sql = "SELECT * FROM user_payments WHERE date BETWEEN '$start_date' AND '$end_date'";
                            } else {
                                $sql = "SELECT * FROM user_payments WHERE date BETWEEN '$start_date' AND '$end_date' AND payment_mode = '$filter_payment_mode'";
                            }
                        } else {
                            $sql = "SELECT * FROM user_payments";
                        }
                    }

                    $result = mysqli_query($con, $sql);
                    $num_rows = mysqli_num_rows($result);
                    $total_cash = 0;

                    if ($num_rows == 0) {
                        echo "<tr><td colspan='5' class='text-center'>No Payments Yet</td></tr>";
                    } else {
                        $num = 0;
                        while ($row_data = mysqli_fetch_assoc($result)) {
                            $num++;
                            $payment_id = $row_data['payment_id'];
                            $invoice_number = $row_data['invoice_number'];
                            $amount = $row_data['amount'];
                            $payment_mode = getPaymentModeText($row_data['payment_mode']);
                            $order_date = $row_data['date'];
                            $timestamp = strtotime($order_date);
                            $date = date("d-m-Y", $timestamp);
                            $time = date("h:i A", $timestamp);

                            echo "<tr class='text-center'>
                                    <td class='bg-secondary text-light'>$num</td>
                                    <td class='bg-secondary text-light'>$invoice_number</td>
                                    <td class='bg-secondary text-light'>$amount</td>
                                    <td class='bg-secondary text-light'>$payment_mode</td>
                                    <td class='bg-secondary text-light'>Date: $date<br> Time: $time</td>
                                </tr>";

                            $total_cash += $amount;
                        }

                        // Display total cash for filtered payments
                        echo "<tr class='text-center'>
                                <td colspan='5' class='bg-success fw-bold text-light'>Total Cash: ₹$total_cash</td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>