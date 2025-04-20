<html>
<head>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php
        if(isset($_GET['edit_products']))
        {
            $edit_id = $_GET['edit_products'];
            $query = "SELECT * FROM products WHERE product_id = $edit_id";
            $exec_query = mysqli_query($con,$query);
            $row = mysqli_fetch_assoc($exec_query);
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_keyword = $row['product_keyword'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_image2 = $row['product_image2'];
            $product_image3 = $row['product_image3'];
            $product_price = $row['product_price'];
            $product_discount = $row['product_discount'];
            $stocks = $row['stocks'];

            // fetching category name
            $select_category = "SELECT * FROM categories WHERE category_id = $category_id";
            $result_category = mysqli_query($con,$select_category);
            $row_category = mysqli_fetch_assoc($result_category);
            $category_title = $row_category['category_title'];

            // fetching brand name
            $select_brand = "SELECT * FROM brands WHERE brand_id = $brand_id";
            $result_brand = mysqli_query($con,$select_brand);
            $row_brand = mysqli_fetch_assoc($result_brand);
            $brand_title = $row_brand['brand_title'];
        }
    ?>
    <div class="container mt-5">
        <h1 class="text-center">
            Edit Products
        </h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" value = "<?php echo $product_title ?>" id="product_title" name="product_title" class="form-control" required>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_description" class="form-label mt-4">Product Description</label>
                <input type="text" value = "<?php echo $product_description ?>" id="product_description" name="product_description" class="form-control" required>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_keywords" class="form-label mt-4">Product Keywords</label>
                <input type="text" value = "<?php echo $product_keyword ?>" id="product_keywords" name="product_keywords" class="form-control" required>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_stocks" class="form-label mt-4">Available Stocks</label>
                <input type="text" value = "<?php echo $stocks ?>" id="product_stocks" name="product_stocks" class="form-control" required>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_category" class="form-label mt-4">Product Category</label>
                <select name="product_category" id="" class="form-select">
                    <option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                    <?php

                        // fetching category name
                        $select_category_all = "SELECT * FROM categories";
                        $result_category_all = mysqli_query($con,$select_category_all);

                        while($row_category_all = mysqli_fetch_assoc($result_category_all))
                        {
                            $category_title = $row_category_all['category_title'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_brands" class="form-label mt-4">Product Brand</label>
                <select name="product_brands" id="" class="form-select">
                    <option value="<?php echo $brand_id ?>"><?php echo $brand_title ?></option>
                    <?php

                        // fetching brand name
                        $select_category4 = "SELECT * FROM brands";
                        $result_category4 = mysqli_query($con,$select_category4);

                        while($row_category4 = mysqli_fetch_assoc($result_category4))
                        {
                            $brand_title = $row_category4['brand_title'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image1" class="form-label mt-4">Product Image 1</label>
                <div class="d-flex bg-dark p-2 rounded">
                    <input type="file" value = "" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required>
                    <img src="product_images/<?php echo $product_image1 ?>" class="rounded edit_prdct_img ml-2" alt="product_image1">
                </div>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image2" class="form-label mt-4">Product Image 2</label>
                <div class="d-flex bg-dark p-2 rounded">
                    <input type="file" value = "" id="product_image2" name="product_image2" class="form-control w-90 m-auto" required>
                    <img src="product_images/<?php echo $product_image2 ?>" class="rounded edit_prdct_img ml-2" alt="product_image2">
                </div>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image3" class="form-label mt-4">Product Image 3</label>
                <div class="d-flex bg-dark p-2 rounded">
                    <input type="file" value = "" id="product_image3" name="product_image3" class="form-control w-90 m-auto" required>
                    <img src="product_images/<?php echo $product_image3 ?>" class="rounded edit_prdct_img ml-2" alt="product_image3">
                </div>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_price" class="form-label mt-4">Product Price</label>
                <input type="text" value = "<?php echo $product_price ?>" id="product_price" name="product_price" class="form-control" required>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_discount" class="form-label mt-4">Product Discount</label>
                <input type="text" value = "<?php echo $product_discount ?>" id="product_discount" name="product_discount" class="form-control" required>
            </div>

            <div class="text-center">
                <br>
                <input type="submit" name="edit_product" value="UPDATE" class ="btn btn-success fw-bold shadow-lg px-4 py-2 border border-2 border-dark">
            </div>
        </form>
    </div>

    <!-- editing product -->
    <?php
        if(isset($_POST['edit_product']))
        {
            $product_title_updt = $_POST['product_title'];
            $product_description_updt = $_POST['product_description'];
            $product_keywords_updt = $_POST['product_keywords'];
            $product_category_updt = $_POST['product_category'];
            $product_brands_updt = $_POST['product_brands'];
            $product_image1_updt = $_FILES['product_image1']['name'];
            $product_image2_updt = $_FILES['product_image2']['name'];
            $product_image3_updt = $_FILES['product_image3']['name'];
            $temp_image1_updt = $_FILES['product_image1']['tmp_name'];
            $temp_image2_updt = $_FILES['product_image2']['tmp_name'];
            $temp_image3_updt = $_FILES['product_image3']['tmp_name'];
            $product_price_updt = $_POST['product_price'];
            $product_discount_updt = $_POST['product_discount'];
            $stocks_updt = $_POST['product_stocks'];

            // checking for fields empty or not
            if(empty($product_title_updt) || empty($product_description_updt) || empty($stocks_updt) || empty($product_keywords_updt) || empty($product_category_updt) || empty($product_brands_updt) || empty($product_image1_updt) || empty($product_image2_updt) || empty($product_image3_updt) || empty($product_price_updt) || empty($product_discount_updt)) 
            {
                echo "<script>
                    Swal.fire({
                        title: 'Please Enter all fields before Updating',
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
                move_uploaded_file($temp_image1_updt,"product_images/$product_image1_updt");
                move_uploaded_file($temp_image2_updt,"product_images/$product_image2_updt");
                move_uploaded_file($temp_image3_updt,"product_images/$product_image3_updt");

                //query to update products
                $update_query = "UPDATE products SET product_title='$product_title_updt',product_description='$product_description_updt',category_id=$product_category_updt,brand_id=$product_brands_updt,product_keyword=$product_keywords_updt, stocks=$stocks_updt ,product_image1 = '$product_image1_updt', product_image2 = '$product_image2_updt',product_image3 = '$product_image3_updt',product_price = '$product_price_updt',product_discount = '$product_discount_updt', date=NOW() WHERE product_id=$edit_id";
                $result_update = mysqli_query($con,$update_query);
                if($result_update)
                {
                    echo "<script>
                        Swal.fire({
                            title: 'Product Updated Successfully',
                            icon: 'success',
                            showClass: {
                                popup: 'animate__animated animate__shakeX'
                            },
                            confirmButtonColor: '#4caf50',
                            confirmButtonText: 'OK'
                        }).then((result) => 
                        {
                            window.location.href = './index.php?view_products';
                        });
                    </script>";
                }
            }
        }
    ?>
</body>
</html>