<?php
    // Check if the deletion is confirmed
    if(isset($_GET['delete_brand']))
    {
        $delete_id = $_GET['delete_brand'];
        $sql = "DELETE FROM brands WHERE brand_id = $delete_id";
        $result_sql = mysqli_query($con,$sql);
        if($result_sql)
        {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Brand Successfully Deleted!',
                    icon: 'success',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => 
                {
                    window.location.href = 'index.php?view_brands';
                });
            </script>";
        }
    }
?>
