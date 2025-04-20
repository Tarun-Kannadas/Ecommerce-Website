<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!-- sweet alert js link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- css link -->
    <link rel="stylesheet" href="../styles.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class = "bg-light">
    <?php
        include('../includes/connect.php');

        if(isset($_POST['insert_product'])) 
        {
            $product_title = $_POST['product_title'];
            $product_description = $_POST['product_description'];
            $product_keyword = $_POST['product_keyword'];
            $product_category = $_POST['product_categories'];
            $product_brand = $_POST['product_brands'];
            $product_price = $_POST['product_price'];
            $product_discount = $_POST['product_discount'];
            $product_stock = $_POST['product_stock'];
            
            // Accessing images
            $product_image1 = $_FILES['product_image1']['name'];
            $product_image2 = $_FILES['product_image2']['name'];
            $product_image3 = $_FILES['product_image3']['name'];

            // Accessing image temp names
            $temp_image1 = $_FILES['product_image1']['tmp_name'];
            $temp_image2 = $_FILES['product_image2']['tmp_name'];
            $temp_image3 = $_FILES['product_image3']['tmp_name'];

            // Check for empty fields
            if(empty($product_title) || empty($product_description) || empty($product_keyword) || empty($product_category) || empty($product_brand) || empty($product_price) || empty($product_discount) || empty($product_image1) || empty($product_image2) || empty($product_image3)) 
            {
                echo "<script>
                    Swal.fire({
                        title: 'Enter All Fields to Proceed',
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
                // Move uploaded images to destination folder
                $upload_dir = "./product_images/";
                move_uploaded_file($temp_image1, $upload_dir . $product_image1);
                move_uploaded_file($temp_image2, $upload_dir . $product_image2);
                move_uploaded_file($temp_image3, $upload_dir . $product_image3);

                // Insert query
                $sql = "INSERT INTO products (product_title, product_description, product_keyword, category_id, brand_id, product_image1, product_image2, product_image3, product_price, product_discount, status, stocks) 
                        VALUES ('$product_title', '$product_description', '$product_keyword', '$product_category', '$product_brand', '$product_image1', '$product_image2', '$product_image3', '$product_price', '$product_discount', 'true')";
                
                $result = mysqli_query($con, $sql);
                
                if($result) 
                {
                    echo "<script>
                        Swal.fire({
                            title: 'Product Successfully Added',
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
                            title: 'Products Were Not Added',
                            icon: 'error',
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
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method = "post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-5 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" required>
                <br>
            </div>

            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <textarea class='form-control' name="product_description" id="product_description" placeholder="Enter Product Description" rows='5' autocomplete="off" required></textarea>
                <br>
            </div>

            <!-- keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter Product Keywords" autocomplete="off" required>
                <br>
            </div>

            <!-- stocks -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_stock" class="form-label">Product Stock</label>
                <input type="text" name="product_stock" id="product_stock" class="form-control" placeholder="Enter Product Stock" autocomplete="off" required>
                <br>
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="" class="form-control form-select">
                    <option value="">Select a Categories</option>
                        <?php
                            $sql = "Select * from categories";
                            $result = mysqli_query($con,$sql);

                            while($row = mysqli_fetch_assoc($result))
                            {
                                $category_title = $row['category_title'];
                                $category_id = $row['category_id'];

                                echo "<option value='$category_id'>$category_title</option>";
                            }
                        ?>
                </select>
                <br>
            </div>

            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-control form-select">
                    <option value="">Select a Brands</option>
                        <?php
                            $sql = "Select * from brands";
                            $result = mysqli_query($con,$sql);

                            while($row = mysqli_fetch_assoc($result))
                            {
                                $brand_title = $row['brand_title'];
                                $brand_id = $row['brand_id'];

                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                        ?>
                </select>
                <br>
            </div>

            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control bg-secondary text-light" autocomplete="off" required>
                <br>
            </div>
            
            <!-- Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control bg-secondary text-light" autocomplete="off" required>
                <br>
            </div> 

            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control bg-secondary text-light" autocomplete="off" required>
                <br>
            </div> 

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" autocomplete="off" required>
                <br>
            </div>
            
            <!-- discount -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_discount" class="form-label">Product Discount</label>
                <input type="text" name="product_discount" id="product_discount" class="form-control" placeholder="Enter Product Discount" autocomplete="off" required>
                <br>
            </div>

            <!-- submit -->
            <div class="form-outline mb-4 w-50 m-auto d-flex justify-content-center">
                <input type="submit" name="insert_product" id="insert_product" class="btn btn-success btn-center mb-3 px-3" value = "Insert Product">
            </div>
        </form>
    </div>
</body>
</html>