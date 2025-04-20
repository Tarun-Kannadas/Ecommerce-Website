<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h3 class="text-danger mt-5 mb-2">Delete Account</h3>
    <div class="p-0 m-0 d-flex justify-content-center">
        <form action="" method="POST" class = "rounded shadow mt-5 bg-secondary w-50 p-4">
            <div class="form-outline">
                <input type="submit" class = "rounded shadow-lg bg-dark text-danger px-4 py-2 m-auto" name = "delete" value = "DELETE">
            </div>

            <div class="form-outline">
                <br>
                <input type="submit" class = "rounded shadow-lg bg-dark text-success px-4 py-2 m-auto" name = "dont_delete" value = "Don't Delete Account">
            </div>
        </form>
    </div>
</body>
</html>

<?php
    $username_session = $_SESSION['username'];
    if(isset($_POST['delete']))
    {
        $delete_query = "DELETE FROM user_table WHERE username = '$username_session'";
        $result = mysqli_query($con,$delete_query);
        if($result)
        {
            session_destroy();
            echo "<script>
                Swal.fire({
                    title: 'Account Deleted Successfully',
                    icon: 'success',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => 
                {
                    window.location.href = '../index.php';
                });
            </script>";
        }
        else
        {
            echo "<script>
                Swal.fire({
                    title: 'Account Deleting Was Unsuccessful',
                    icon: 'error',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => 
                {
                    window.location.href = '../index.php';
                });
            </script>";
        }

    }

    if(isset($_POST['dont_delete']))
    {
        echo "<script>
            Swal.fire({
                title: 'Your Account is Safe',
                icon: 'success',
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
?>