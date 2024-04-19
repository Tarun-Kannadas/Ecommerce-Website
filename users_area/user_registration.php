<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
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
            Customer Registration
        </h2>

        <div class="row d-flex align-items-center justify-content-center">
            <div class="registration col-4 my-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!-- username field -->
                        <label for="Username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your Username" autocomplete="off" name="user_username" required>
                    </div>

                    <div class="form-outline mb-4">
                        <!-- email field -->
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your Email" autocomplete="off" name="user_email" required>
                    </div>

                    <div class="form-outline mb-4">
                        <!-- password field -->
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your Password" autocomplete="off" name="user_password" required>
                    </div>

                    <div class="form-outline mb-4">
                        <!-- confirm password field -->
                        <label for="Password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Rewrite your Password" autocomplete="off" name="conf_user_password" required>
                    </div>

                    <div class="form-outline mb-4">
                        <!-- image field -->
                        <label for="Image" class="form-label">Customer Profile Image</label>
                        <input type="file" id="user_image" class="form-control bg-dark text-light" name="user_image" required>
                    </div>

                    <div class="form-outline mb-4">
                        <!-- address field -->
                        <label for="Address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your Address" autocomplete="off" name="user_address" required>
                    </div>

                    <div class="form-outline mb-4">
                        <!-- number field -->
                        <label for="Number" class="form-label">Phone Number</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your Phone Number" autocomplete="off" name="user_contact" required>
                    </div>

                    <div class="text-center mt-44 pt-2">
                        <input type="submit" value="Register" class="btn bg-success py-2 px-3" name="user_register">
                        <p class = "medium fw-bold mt-3 pt-2 mb-0">Already Have An Account ?<a href="user_login.php" class = "text-success"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
    if(isset($_POST['user_register']))
    {
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $username = $_POST['user_username'];
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $hash_password = password_hash($password,PASSWORD_DEFAULT);
        $confirm_password = $_POST['conf_user_password'];
        $address = $_POST['user_address'];
        $contact = $_POST['user_contact'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_ip = getIPAddress();

        // Validation for phone number
        if (!preg_match('/^[0-9]{10}$/', $contact)) 
        {
            echo "<script>
            Swal.fire({
                title: 'Invalid Phone Number',
                text: 'Please enter a valid 10-digit phone number',
                icon: 'error',
                showClass: {
                    popup: 'animate__animated animate__shakeX'
                },
                confirmButtonColor: '#4caf50',
                confirmButtonText: 'OK'
            }).then((result) => {
                window.location.href = 'user_registration.php';
            });
        </script>";
        exit();
        }

        // select query
        $select_query = "SELECT * from user_table WHERE username='$username' or user_email='$email' or user_number='$contact'";
        $result = mysqli_query($con,$select_query);
        $rows_count = mysqli_num_rows($result);
        if($rows_count>0)
        {
            echo "<script>
                Swal.fire({
                    title: 'Customer Already Exists',
                    icon: 'error',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = 'user_registration.php';
                });
            </script>";
        }
        else if($password!=$confirm_password)
        {
            echo "<script>
                Swal.fire({
                    title: 'Passwords Don\'t Match',
                    icon: 'error',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = 'user_registration.php';
                });
            </script>";
        }
        else
        {
            // insert query
            $insert_query = "INSERT INTO user_table (username,user_email,user_password,user_address,user_image,user_number) VALUES ('$username','$email','$password','$address','$user_image','$contact')";
            $sql = mysqli_query($con, $insert_query);
            if($sql)
            {
                echo "<script>
                    Swal.fire({
                        title: 'Customer Registeration Successful',
                        icon: 'success',
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
            else
            {
                echo "<script>
                    Swal.fire({
                        title: 'Customer Registeration Unsuccessful',
                        icon: 'error',
                        showClass: {
                            popup: 'animate__animated animate__shakeX'
                        },
                        confirmButtonColor: '#4caf50',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href = 'user_registration.php';
                    });
                </script>";
            }
        }

        // selecting cart items
        $select_cart_items="SELECT * FROM cart_details WHERE user_id='$user_id'";
        $result_cart = mysqli_query($con,$select_cart_items);
        $rows_cart_count = mysqli_num_rows($result_cart);
        if($rows_cart_count>0)
        {
            $_SESSION['username']=$username;
            echo "<script>
                Swal.fire({
                    title: 'You have Items in your Cart',
                    icon: 'warning',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = 'checkout.php';
                });
            </script>";
        }
        else
        {
            echo "<script>windows.open('index.php','_self')</script>";
        }
    }
?>

<script>
    document.getElementById('registerButton').addEventListener('click', function(event) {
    
        event.preventDefault();

        var phoneNumber = document.getElementById('user_contact').value.trim();

        if (phoneNumber.length !== 10 || isNaN(phoneNumber)) {
            alert('Please enter a valid 10-digit phone number.');
            return;
        }
    });
</script>