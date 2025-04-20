<?php
    if($_GET['delete_product'])
    {
        $delete_id = $_GET['delete_product'];
        $sql = "DELETE FROM products WHERE product_id = $delete_id";
        $result_sql = mysqli_query($con,$sql);
        if($result_sql)
        {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Product Successfully Deleted !',
                    icon: 'success',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    confirmButtonColor: '#4caf50',
                    confirmButtonText: 'OK'
                }).then((result) => 
                {
                    window.location.href = 'index.php?view_products';
                });
            </script>";
        }
    }
?>