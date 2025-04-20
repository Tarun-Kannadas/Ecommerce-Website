<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing...</title>
    <style>
        body {
          background-color: black;
          color: white;
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
        }
        .button_confirm{
          display: none;
        }
    </style>
</head>
<body>
    <h2>Processing Your Purchase...</h2>
    <img id="loadingGif" src="../Images/gifs/loading cubes.gif" onload="showConfirmation()">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function showConfirmation() {
            Swal.fire({
                title: 'Order Purchase Successful',
                text: 'Your order has been successfully processed.',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'profile.php?my_orders';
                }
            });
        }
    </script>
</body>
</html>
