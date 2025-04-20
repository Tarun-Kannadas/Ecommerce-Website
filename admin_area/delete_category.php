<?php
    // Check if the deletion is confirmed
    if(isset($_GET['delete_category']))
    {
        $delete_update_id = $_GET['delete_category'];
        $sql = "DELETE FROM categories WHERE category_id = $delete_update_id";
        $result_sql = mysqli_query($con,$sql);
        if($result_sql)
        {
            echo "<script>
                Swal.fire({
                    title: 'Category Successfully Deleted!',
                    icon: 'success',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => 
                {
                    window.location.href = 'index.php?view_categories';
                });
            </script>";
        }
    }
?>
