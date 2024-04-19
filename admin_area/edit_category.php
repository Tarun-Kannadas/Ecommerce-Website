<html>
<head>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php
        if(isset($_GET['edit_category']))
        {
            $edit_id = $_GET['edit_category'];

            // fetching category name
            $select_category = "SELECT * FROM categories WHERE category_id = $edit_id";
            $result_category = mysqli_query($con,$select_category);
            $row_category = mysqli_fetch_assoc($result_category);
            $category_title = $row_category['category_title'];
        }
    ?>
    <div class="container mt-5">
        <h1 class="text-center">
            Edit Category
        </h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto">
                <label for="category_title" class="form-label">Category Title</label>
                <input type="text" class = "form-control" name = "category_title" value="<?php echo $category_title ?>">          
            </div>

            <div class="text-center">
                <br>
                <input type="submit" name="edit_category" value="UPDATE" class ="btn btn-success fw-bold shadow-lg px-4 py-2 border border-2 border-dark">
                <input type="submit" name="cancel_btn" value="CANCEL" class="btn btn-danger fw-bold shadow-lg my-4 px-4 py-2 border border-2 border-dark">

            </div>
        </form>
    </div>

    <!-- editing category -->
    <?php
        if(isset($_POST['cancel_btn']))
        {
            echo "<script>window.open('./index.php?view_categories', '_self')</script>";
        }

        if(isset($_POST['edit_category']))
        {
            $category_title_updt = $_POST['category_title'];

            // checking for fields empty or not
            if(empty($category_title_updt)) 
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
                $check_query = "SELECT * FROM categories WHERE category_title = '$category_title_updt'";
                $check_result = mysqli_query($con, $check_query);
                if(mysqli_num_rows($check_result) > 0)
                {
                    echo "<script>
                        Swal.fire({
                            title: 'Category Title Already Exists!',
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
                    $update_query = "UPDATE categories SET category_title='$category_title_updt' WHERE category_id=$edit_id";
                    $result_update = mysqli_query($con,$update_query);
                    if($result_update)
                    {
                        echo "<script>
                            Swal.fire({
                                title: 'Category Updated Successfully',
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => 
                            {
                                window.location.href = './index.php?view_categories';
                            });
                        </script>";
                    }
                }
            }
        }
    ?>
</body>
</html>