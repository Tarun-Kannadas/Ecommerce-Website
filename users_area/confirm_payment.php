<?php
include('../includes/connect.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_array($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];

    if (isset($_POST['payment_confirmed'])) {
        $invoice_number = $_POST['invoice_number'];
        $amount = $_POST['amount'];
        $payment_mode = $_POST['payment_mode'];
        $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode) VALUES ($order_id,'$invoice_number',$amount,'$payment_mode')";
        $result_payment = mysqli_query($con, $insert_query);

        if ($result_payment) {
            $update_orders = "UPDATE user_orders SET payment_status='Paid', tracking_status='Ordered' WHERE order_id = $order_id";
            $result_update_orders = mysqli_query($con, $update_orders);

            if ($result_update_orders) {
                // Show processing page
                header("Refresh: 3; URL=transition.php");
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- css file -->
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* Add your custom styles here */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        body {
            background-image: url('https://i.pinimg.com/564x/61/ed/42/61ed420bba9dce39322a354f403fd240.jpg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .loading-spinner {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="my-5">
        <div class="p-0 m-0 d-flex justify-content-center align-items-center">
            <form id="paymentForm" action="" method="POST" class="rounded shadow-lg bg-dark w-50 p-4">
                <div class="form-outline m-4 text-center w-75 m-auto">
                    <h1 class="text-center text-success fw-bold m-5">Confirm Payment</h1>
                    <label for="amount" class="text-light">Invoice</label>
                    <input type="text" class="form-control w-75 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>" readonly>
                    <br>
                </div>

                <div class="form-outline m-3 text-center w-75 m-auto">
                    <label for="amount" class="text-light">Amount</label>
                    <input type="text" class="form-control w-75 m-auto" name="amount" value="<?php echo $amount_due ?>" readonly>
                    <br>
                </div>

                <div class="form-outline text-center w-75 m-auto">
                    <label for="amount" class="text-light" hidden>Payment Mode</label>
                    <input name="payment_mode" id="payment_mode" value='Credit/Debit Card' class="form-control w-75 m-auto" hidden required>
                    <br>
                </div>

                <div class="padding">
                    <div class="row">
                        <div class="container-fluid d-flex justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span>CREDIT/DEBIT CARD PAYMENT</span>
                                            </div>

                                            <div class="col-md-6 text-right" style="margin">
                                                <img src="https://img.icons8.com/color/36/000000/visa.png">
                                                <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                                                <img src="https://img.icons8.com/color/36/000000/amex.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" style="height: 350px">
                                        <div class="form-group">
                                            <label for="cc-number" class="control-label">CARD NUMBER</label>
                                            <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="1234 5678 9012 3456" required pattern="\d{4} \d{4} \d{4} \d{4}">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cc-exp" class="control-label">CARD EXPIRY</label>
                                                    <input id="cc-exp" type="text" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="MM / YY" required pattern="(0[1-9]|1[0-2])\s*\/\s*[0-9]{2}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cc-cvc" class="control-label">CARD CVC</label>
                                                    <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="&bull;&bull;&bull;" required pattern="[0-9]{3}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="numeric" class="control-label">CARD HOLDER NAME</label>
                                            <input type="text" class="input-lg form-control">
                                        </div>

                                        <div class="form-group text-center fw-bold"> 
                                            <input type="submit" class="btn btn-shadow text-light fw-bold bg-success px-5 py-2 border-0" name="payment_confirmed" value="PAY">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
    <script>
        // Client-side validation for card number, CVC, and expiry date
        document.getElementById('cc-number').addEventListener('input', function(e) {
            var input = e.target.value.replace(/\D/g, '');
            if (input.length > 16) {
                input = input.slice(0, 16);
            }
            e.target.value = input.match(/.{1,4}/g).join(' ');
        });

        document.getElementById('cc-cvc').addEventListener('input', function(e) {
            var input = e.target.value.replace(/\D/g, '');
            if (input.length > 3) {
                input = input.slice(0, 3);
            }
            e.target.value = input;
        });

        document.getElementById('cc-exp').addEventListener('input', function(e) {
            var input = e.target.value.replace(/\D/g, '');
            if (input.length > 4) {
                input = input.slice(0, 4);
            }
            var month = input.slice(0, 2);
            var year = input.slice(2, 4);
            if (parseInt(month) > 12) {
                month = '12';
            }
            e.target.value = month + ' / ' + year;
        });
    </script>
</body>
</html>
