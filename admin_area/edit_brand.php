<html>
<head>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php
        if(isset($_GET['edit_brand']))
        {
            $edit_id = $_GET['edit_brand'];

            // fetching category name
            $select_category = "SELECT * FROM brands WHERE brand_id = $edit_id";
            $result_category = mysqli_query($con,$select_category);
            $row_category = mysqli_fetch_assoc($result_category);
            $brand_title = $row_category['brand_title'];
        }
    ?>
    <div class="container mt-5">
        <h1 class="text-center">
            Edit Brand
        </h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto">
                <label for="brand_title" class="form-label">Category Title</label>
                <input type="text" class="form-control" name="brand_title" value="<?php echo $brand_title ?>">          
            </div>

            <div class="d-flex justify-content-center align-items-center text-center">
                <br>
                <input type="submit" name="edit_brand" value="UPDATE" class="btn btn-success fw-bold shadow-lg my-4 mx-2 px-4 py-2 border border-2 border-dark">
                <input type="submit" name="cancel_btn" value="CANCEL" class="btn btn-danger fw-bold shadow-lg my-4 px-4 py-2 border border-2 border-dark">
            </div>
        </form>
    </div>

    <!-- editing brand -->
    <?php
        if(isset($_POST['cancel_btn']))
        {
            echo "<script>window.open('./index.php?view_brands', '_self')</script>";
        }

        if(isset($_POST['edit_brand']))
        {
            $brand_title_updt = $_POST['brand_title'];

            // checking for fields empty or not
            if(empty($brand_title_updt)) 
            {
                echo "<script>
                    Swal.fire({
                        title: 'Choose an Option Before Updating',
                        icon: 'warning',
                        showClass: {
                            popup: 'animate__animated animate__shakeX'
                        },
                        confirmButtonColor: '#4caf50',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
            else
            {
                // Check if the brand title already exists
                $check_query = "SELECT * FROM brands WHERE brand_title = '$brand_title_updt'";
                $check_result = mysqli_query($con, $check_query);
                if(mysqli_num_rows($check_result) > 0)
                {
                    echo "<script>
                        Swal.fire({
                            title: 'Brand Title Already Exists!',
                            text: 'Please choose a different title.',
                            icon: 'error',
                            showClass: {
                                popup: 'animate__animated animate__shakeX'
                            },
                            confirmButtonColor: '#4caf50',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
                else
                {
                    //query to update brands
                    $update_query = "UPDATE brands SET brand_title='$brand_title_updt' WHERE brand_id=$edit_id";
                    $result_update = mysqli_query($con,$update_query);
                    if($result_update)
                    {
                        echo "<script>
                            Swal.fire({
                                title: 'Brand Updated Successfully',
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => 
                            {
                                window.location.href = './index.php?view_brands';
                            });
                        </script>";
                    }
                }
            }
        }
    ?>
</body>
</html>