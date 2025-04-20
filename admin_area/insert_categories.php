<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_cat']))
    {
        $category_title = $_POST['cat_title'];

        //select data from database
        $sql2 = "select * from categories where category_title = '$category_title'";
        $result2 = mysqli_query($con,$sql2);
        $row = mysqli_num_rows($result2);
        if($row>0)
        {
            echo "<script>
                    Swal.fire({
                        title: 'This Category Already Exists',
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
            $sql = "insert into categories (category_title) values ('$category_title')";
            $result = mysqli_query($con,$sql);
            if($result)
            {
                echo "<script>
                    Swal.fire({
                        title: 'Category Added Successfully',
                        icon: 'success',
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
                echo "<script>
                    Swal.fire({
                        title: 'Adding a Category was Unsuccessful',
                        icon: 'warning',
                        showClass: {
                            popup: 'animate__animated animate__shakeX'
                        },
                        confirmButtonColor: '#4caf50',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
        }
    }
?>

<h2 class="text-center">Insert Categories</h2>

<form action="" method = "post" class = "mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-success" id="basic-addon1">
            <i class="fas fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" autocomplete="off" required>
    </div>

    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="border-0 p-2 my-3 bg-success success btn fw-bold" name="insert_cat" value = "Insert Categories">
    </div>
</form>