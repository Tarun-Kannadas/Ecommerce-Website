<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    // session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Payment Page</title>
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
<body>
    <!-- php code to access user id -->
    <?php
        $user_id = $_SESSION['user_id'];
        $get_user = "SELECT * FROM user_table WHERE user_id = '$user_id'";
        $result = mysqli_query($con,$get_user);
        $fetch_data = mysqli_fetch_array($result);
        $user_id = $fetch_data['user_id'];
    ?>
    
    <div class="container">
        <h2 class="text-center text-success py-5 fw-bold">Payment Options</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <!-- <div class="col-md-6 py-5">
                <a href="https://www.paypal.com/in/home"> 
                    <img src="../Images/upi.png" alt="" class = "upi_img"> 
                </a>
            </div> -->

            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <a href="pc_order.php?user_id=<?php echo $user_id ?>" class = "text-center"> 
                    <h2 class = "btn btn-success fw-bold">PROCEED TO PAYMENT<h2>
                </a>
            </div>
        </div>
    </div>
</body>
</html>