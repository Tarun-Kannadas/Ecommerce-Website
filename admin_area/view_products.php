<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>
<body>
    <h2 class="text-center text-success fw-bold">All Products</h2>
    <?php
        $get_products = "SELECT * FROM products";
        $result = mysqli_query($con,$get_products);
        $num_rows = mysqli_num_rows($result);
        if($num_rows)
        {
            echo "<table class='table table-bordered text-center border-dark table-hover mt-5 shadow-lg'>
            <tbody class='bg-secondary text-light'>
                <thead class='text-light fw-bold'>
                    <tr>
                        <th class='bg-success'>Sl No.</th>
                        <th class='bg-success'>Product Title</th>
                        <th class='bg-success'>Product Image</th>
                        <th class='bg-success'>Products Price</th>
                        <th class='bg-success'>Products Discount</th>
                        <th class='bg-success'>Available Stocks</th>
                        <th class='bg-success'>Edit</th>
                        <th class='bg-success'>Delete</th>
                    </tr>
                </thead>";
            $num = 1;
            while($num_rows_fetch = mysqli_fetch_assoc($result))
            {
                $product_id = $num_rows_fetch['product_id'];
                $product_title = $num_rows_fetch['product_title'];
                $product_image1 = $num_rows_fetch['product_image1'];
                $product_price = $num_rows_fetch['product_price'];
                $product_discount = $num_rows_fetch['product_discount'];
                $status = $num_rows_fetch['status'];
                $stocks = $num_rows_fetch['stocks'];
                // $product_id = $num_rows_fetch['product_id'];
                // $product_id = $num_rows_fetch['product_id'];
                ?>
                <tr>
                    <td class = "bg-secondary text-light"><?php echo $num ?></td>
                    <td class = "bg-secondary text-light"><?php echo $product_title ?></td>
                    <td class = "bg-secondary text-light"><img src='./product_images/<?php echo $product_image1 ?>' class = 'prdct_img'></td>
                    <td class = "bg-secondary text-light"><?php echo "Rs ".$product_price ?>/-</td>
                    <td class = "bg-secondary text-light"><?php echo "Rs ".$product_discount ?>/-</td>
                    <td class = "bg-secondary text-light">
                        <?php echo $stocks ?>
                    </td>
                    <td class = "bg-secondary text-light">
                        <a href='index.php?edit_products=<?php echo $product_id ?>' class='text-light'>
                            <i class='fas fa-edit'></i>
                        </a>
                    </td>
                    <td class = "bg-secondary text-light">                    
                        <a href='index.php?delete_product=<?php echo $product_id ?>' class='text-light'>
                            <i class='fas fa-trash'></i>
                        </a>
                    </td>
                </tr>
                <?php
                $num++;
            }
            echo "</tbody>
            </table>";
        }
        else
        {
            echo "<div class='alert alert-warning text-center mt-5' role='alert'>
                <h4 class='alert-heading'> No Products Available <i class='fas fa-frown'></i></h4>
            </div>";
        }
    ?>
</body>
</html>