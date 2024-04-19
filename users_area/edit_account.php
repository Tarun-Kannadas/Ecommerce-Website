<?php
    if(isset($_GET['edit_account']))
    {
        $user_session = $_SESSION['username'];
        $select_query = "SELECT * FROM user_table WHERE username='$user_session'";
        $result_query = mysqli_query($con,$select_query);
        $row_fetch = mysqli_fetch_assoc($result_query);
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_image = $row_fetch['user_image'];
        $user_address = $row_fetch['user_address'];
        $user_number = $row_fetch['user_number'];
    }

    if(isset($_POST['UPDATE']))
    {
        $update_id = $user_id;
        $username_update = $_POST['username'];
        $email_update = $_POST['user_email'];
        $address_update = $_POST['user_address'];
        $number_update = $_POST['user_mobile'];
        $image_update = $_FILES['user_image']['name'];
        $image_tmp_update = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($image_tmp_update,"./user_images/$image_update");
        
        // update query
        $update_query = "UPDATE user_table 
        SET username = '$username_update', user_email = '$email_update', user_image = '$image_update', user_address = '$address_update', user_number = '$number_update' 
        WHERE user_id = $update_id";
        $result_update_query = mysqli_query($con, $update_query);

        if($result_update_query)
        {
            echo "<script>
                Swal.fire({
                    title: 'Account Successfully Updated',
                    icon: 'success',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => 
                {
                    window.location.href = 'logout.php';
                });
            </script>";
        }
        else
        {
            echo "<script>
                Swal.fire({
                    title: 'Account Not Update Successfully',
                    icon: 'error',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => 
                {
                    window.location.href = 'profile.php';
                });
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
    <div class="p-0 m-0 d-flex justify-content-center">
        <form action="" method = "POST" class = "box-shadow-lg rounded p-4 bg-dark h-75 w-50 text-center" enctype="multipart/form-data">
            <h3 class="text-center text-success mb-4">
                <strong class = "rounded bg-secondary px-3 py-2"><i>EDIT ACCOUNT</i></strong>
            </h3>  
            <!-- username field -->
            <div class="form-outline col-7 p-3 m-auto">
                <input type="text" class = "text-dark form-control m-auto" name = "username" value = "<?php echo $username ?>">
            </div>
            <!-- email field -->
            <div class="form-outline col-7 p-3 m-auto">
                <input type="text" class = "text-dark form-control m-auto" name = "user_email" value = "<?php echo $user_email ?>">
            </div>
            <!-- image field -->
            <div class="form-outline col-7 p-3 m-auto d-flex">
                <input type="file" class = "text-dark form-control m-auto" name = "user_image" value = "<?php echo $user_img ?>">
                <img class="rounded edit_img p-2" src="./user_images/<?php echo $user_img ?>" alt="">
            </div>
            <!-- address field -->
            <div class="form-outline col-7 p-3 m-auto">
                <input type="text" class = "text-dark form-control m-auto" name = "user_address" value = "<?php echo $user_address ?>">
            </div>
            <!-- phonenumber field -->
            <div class="form-outline col-7 p-3 m-auto">
                <input type="text" class = "text-dark form-control m-auto" name = "user_mobile" value = "<?php echo $user_number ?>">
            </div>

            <input type="submit" class = "btn btn-success fw-bold d-flex m-auto" value="UPDATE" name = "UPDATE">
        </form>
    </div>
</body>
</html>