<?php
include('../includes/connect.php');

if(isset($_GET['invoice_number']))
{
    $invoice_number = $_GET['invoice_number'];
    $delete_order = "DELETE FROM user_orders WHERE invoice_number = $invoice_number";
    $result_delete = mysqli_query($con, $delete_order);
    $delete_pending_order = "DELETE FROM orders_pending WHERE invoice_number = $invoice_number";
    $result_delete_pending = mysqli_query($con, $delete_pending_order);
    if($result_delete && $result_delete_pending)
    {
        echo "<script>
            Swal.fire({
                title: 'Order Deleted Successfully',
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
    else
    {
        echo "<script>
            Swal.fire({
                title: 'Error in deleting Order',
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
}
?>
