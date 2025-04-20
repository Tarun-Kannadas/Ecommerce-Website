<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <!-- css file -->
    <link rel ="stylesheet" href="styles.css">
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container-fluid my-5">
        <h2 class="text-center">
            Customer Login
        </h2>

        <div class="row d-flex align-items-center justify-content-center mt-2">
            <div class="registration col-4 my-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!-- username field -->
                        <label for="Username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your Username" autocomplete="off" name="user_username" required>
                    </div>

                    <div class="form-outline mb-4">
                        <!-- password field -->
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your Password" autocomplete="off" name="user_password" required>
                    </div>

                    <div class="text-center mt-44 pt-2">
                        <input type="submit" value="Login" class="btn bg-success py-2 px-3" name="user_login">
                        <p class = "medium fw-bold mt-3 pt-2 mb-0">Don't Have An Account ?<a href="user_registration.php" class = "text-success"> Register Now!</a></p>
                        <p class = "medium fw-bold mt-3 pt-2 mb-0">Check out us as a Guest -><a href="../index.php" class = "text-success"> Guest Mode</a></p>
                        <p class = "medium fw-bold mt-3 pt-2 mb-0">Login As Admin -><a href="../admin_area/admin_login.php" class = "text-success"> Admin Panel</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
    if(isset($_POST['user_login']))
    {
        $username = $_POST['user_username'];
        $password = $_POST['user_password'];

        $select_query = "SELECT * FROM user_table WHERE username='$username'";
        $result = mysqli_query($con,$select_query);
        $row_count = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);
        $user_id = $row_data['user_id'];

        // cart item
        $select_query_cart = "SELECT * FROM cart_details WHERE user_id='$user_id'";
        $select_cart=mysqli_query($con,$select_query_cart);
        $row_count_cart = mysqli_num_rows($select_cart);

        if($row_count>0)
        {
            $_SESSION['username']=$username;
            $_SESSION['user_id'] = $user_id;
            if($password == $row_data['user_password'])
            {
                if($row_data['status'] == 1)
                {
                    $_SESSION['admin_name']=$username;
                    // Redirect to admin page
                    header('Location: ../admin_area/index.php?view_products');
                    exit();
                }
                else
                {
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $user_id;
                    echo "<script>
                        Swal.fire({
                            title: 'Login Successful',
                            icon: 'success',
                            showClass: {
                                popup: 'animate__animated animate__shakeX'
                            },
                            confirmButtonColor: '#4caf50',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            window.location.href = '../index.php';
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
                        window.location.href = 'user_login.php';
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
                    window.location.href = 'user_login.php';
                });
            </script>";
        }
    }
?>