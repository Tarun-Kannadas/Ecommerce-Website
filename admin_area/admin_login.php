<?php
    include('../includes/connect.php');
    // include('../functions/common_function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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

</head>
<body class = "bg-dark">
    <div class="container-fluid m-3 fw-bold">
        <h2 class="text-center mb-5 fw-bold text-success">Welcome to CREEDBOZ Admin Login Panel</h2>
        <div class="row d-flex justify-centent-around">
            <div class="col-lg-6 col-xl-7">
                <img src="../Images/adminlog.jpeg" alt="" class = "img-fluid img-xl rounded">
            </div>

            <div class="col-lg-6 col-xl-4 shadow-lg bg-secondary rounded border border-light p-5">
            <h2 class="text-center mb-3 my-3 fw-bold">Login Form</h2>
                <form action="" method="POST" class="p-5">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-lable">Username</label>
                        <input type="text" id="username" name="admin_name" placeholder = "Enter your Username" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-lable">Password</label>
                        <input type="password" id="password" name="admin_password" placeholder = "Enter your Password" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="shadow-lg btn bg-success fw-bold py-2 px-3 border-0 mt-2" value="LOGIN" name="admin_login">
                        <p class="medium my-4">Want to view the website<a href="../index.php" class="medium text-decoration-none text-success"> Click Here!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>

<!-- php code -->
<?php
    if(isset($_POST['admin_login']))
    {
        $adm_username = $_POST['admin_name'];
        $password = $_POST['admin_password'];

        $select_query = "SELECT * FROM user_table WHERE username='$adm_username'";
        $result = mysqli_query($con,$select_query);
        $row_count = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);

        if($row_count>0)
        {
            $_SESSION['admin_name']=$adm_username;
            if($password == $row_data['user_password'])
            {
                if($row_data['status'] == 1)
                {
                    // Redirect to admin page
                    $_SESSION['admin_name'] = $adm_username;
                    if($row_count==1)
                    {
                        $_SESSION['admin_name'] = $adm_username;
                        echo "<script>
                            Swal.fire({
                                title: 'Admin Login Successful',
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                window.location.href = 'index.php?view_products';
                            });
                        </script>";                    
                    }
                }
            }
            else
            {
                echo "<script>
                    Swal.fire({
                        title: 'Invalid Credentials',
                        icon: 'warning',
                        showClass: {
                            popup: 'animate__animated animate__shakeX'
                        },
                        confirmButtonColor: '#4caf50',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href = 'admin_login.php';
                    });
                </script>";
            }
        }
        else
        {
            echo "<script>
                Swal.fire({
                    title: 'Invalid Credentials',
                    icon: 'warning',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = 'admin_login.php';
                });
            </script>";
        }
    }
?>