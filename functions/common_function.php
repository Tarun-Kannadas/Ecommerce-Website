<?php
    //including connect database
    // include('./includes/connect.php');

    //getting products
    function get_products()
    {
        global $con;

        // condition to check isset or not
        if(!isset($_GET['category']))
        {
            if(!isset($_GET['brand']))
            {
                $get_products_query = "Select * from products order by rand() LIMIT 0,12";//set limit 0,9 to set a limit for view products to user
                $get_products_result = mysqli_query($con,$get_products_query);
                // $row = mysqli_fetch_assoc($result);
                // echo $row['product_title'];
                while($row = mysqli_fetch_assoc($get_products_result))
                {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    // $product_id = $row['product_keyword'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    $product_discount = $row['product_discount'];
                    $product_stock = $row['stocks'];

                    echo "<div class='col-md-3 mb-2 h-4'>
                        <div class='card'>
                            <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='./admin_area/product_images/$product_image1' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title fw-bold'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text fw-bold'><s>₹$product_price/-</s> ₹$product_discount/-</p>
                                <p class='card-text fw-bold'>$product_stock products left</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-success shadow-lg fw-bold'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary shadow-lg fw-bold'>View More</a>
                            </div>
                        </div>  
                    </div>";
                }
            }
        }
    }

    // getting all products
    function get_all_products()
    {
        global $con;

        // condition to check isset or not
        if(!isset($_GET['category']))
        {
            if(!isset($_GET['brand']))
            {
                $get_products_query = "Select * from products order by rand()";//set limit 0,9 to set a limit for view products to user
                $get_products_result = mysqli_query($con,$get_products_query);
                // $row = mysqli_fetch_assoc($result);
                // echo $row['product_title'];
                while($row = mysqli_fetch_assoc($get_products_result))
                {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    // $product_id = $row['product_keyword'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    $product_discount = $row['product_discount'];
                    $product_stock = $row['stocks'];

                    echo "<div class='col-md-3 mb-2'>
                        <div class='card'>
                            <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='./admin_area/product_images/$product_image1' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title fw-bold'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text fw-bold'><s>₹$product_price/-</s> ₹$product_discount/-</p>
                                <p class='card-text fw-bold'>$product_stock products left</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-success shadow-lg fw-bold'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary shadow-lg fw-bold'>View More</a>
                            </div>
                        </div>  
                    </div>";
                }
            }
        }        
    }

    //getting unique categories
    function get_unique_categories()
    {
        global $con;

        // condition to check isset or not
        if(isset($_GET['category']))
        {
            $category_id = $_GET['category'];
            $get_unique_categories_query = "Select * from products where category_id = $category_id limit 0,1";
            $get_unique_categories_result = mysqli_query($con,$get_unique_categories_query);
            $num_of_rows = mysqli_num_rows($get_unique_categories_result);
            if($num_of_rows==0)
            {
                echo "<div class='alert alert-danger text-center' role='alert'>
                    <h4 class='alert-heading'> No Stock Available for this Category <i class='fas fa-frown'></i></h4>
                </div>";
                // echo "<div class ='text-center'>
                //     <h2 class='text-center text-danger'>No Stock Available for this Category</h2>
                // </div>";
            }
            // $row = mysqli_fetch_assoc($result);
            // echo $row['product_title'];
            while($row = mysqli_fetch_assoc($get_unique_categories_result))
            {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                // $product_id = $row['product_keyword'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];
                $product_image2 = $row['product_image2'];
                $product_image3 = $row['product_image3'];
                $product_price = $row['product_price'];
                $product_discount = $row['product_discount'];
                $product_stock = $row['stocks'];


                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='./admin_area/product_images/$product_image1' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title fw-bold'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text fw-bold'>Price: ₹$product_price/-</p>
                            <p class='card-text fw-bold'>$product_stock products left</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-success shadow-lg fw-bold'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary shadow-lg fw-bold'>View More</a>
                        </div>
                    </div>  
                </div>";
            }
        }
    }

    //getting unique brands
    function get_unique_brands()
    {
        global $con;

        // condition to check isset or not
        if(isset($_GET['brand']))
        {
            $brand_id = $_GET['brand'];
            $get_unique_brands_query = "Select * from products where brand_id = $brand_id";
            $get_unique_brands_result = mysqli_query($con,$get_unique_brands_query);
            $num_of_rows = mysqli_num_rows($get_unique_brands_result);
            if($num_of_rows==0)
            {
                echo "<div class='alert alert-danger text-center' role='alert'>
                    <h4 class='alert-heading'> Sorry for the Inconvenience, Currently this brand is Out Of Service <i class='fas fa-frown'></i></h4>
                </div>";
                // echo "<h2 class = 'text-center text-danger'>Sorry for the Inconvenience, Currently this brand is Out Of Service</h2>";
            }
            // $row = mysqli_fetch_assoc($result);
            // echo $row['product_title'];
            while($row = mysqli_fetch_assoc($get_unique_brands_result))
            {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                // $product_id = $row['product_keyword'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];
                $product_image2 = $row['product_image2'];
                $product_image3 = $row['product_image3'];
                $product_price = $row['product_price'];
                $product_discount = $row['product_discount'];
                $product_stock = $row['stocks'];


                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='./admin_area/product_images/$product_image1' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title fw-bold'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text fw-bold'>Price: ₹$product_price/-</p>
                            <p class='card-text fw-bold'>$product_stock products left</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-success shadow-lg fw-bold'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary shadow-lg fw-bold'>View More</a>
                        </div>
                    </div>  
                </div>";
            }
        }
    }

    //displaying brands in sidenav
    function get_brands()
    {
        global $con;
        $select_brands = "Select * from brands";
        $result_brands = mysqli_query($con,$select_brands);
        while($row = mysqli_fetch_assoc($result_brands))
        {
            $brand_title = $row['brand_title'];
            $brand_id = $row['brand_id'];
            echo "<li class='rounded nav-item bg-dark'>
                <a href='index.php?brand=$brand_id' class='rounded nav-link bg-dark text-light border border-secondary border-bottom-1'>$brand_title</a>
            </li>";
        }
    }

    //displaying brands in sidenav
    function get_categories()
    {
        global $con;
        $select_category = "Select * from categories";
        $result_category = mysqli_query($con,$select_category);
        // $row = mysqli_fetch_assoc($result_brands);
        // echo $row['brand_title'];
        while($row = mysqli_fetch_assoc($result_category))
        {
            $category_title = $row['category_title'];
            $category_id = $row['category_id'];
            echo "<li class='rounded nav-item bg-dark'>
                <a href='index.php?category=$category_id' class='rounded nav-link bg-dark text-light border border-secondary border-bottom-1'>$category_title</a>
            </li>";
        }
    }

    // searching products function
    function search_product()
    {
        global $con;

        if(isset($_GET['search_data_product']))
        {
            $search_data_value = $_GET['search_data'];
            $search_product_query = "Select * from products where product_keyword like '%$search_data_value%'";
            $search_product_result = mysqli_query($con,$search_product_query);
            $num_of_rows = mysqli_num_rows($search_product_result);
            if($num_of_rows==0)
            {
                echo "<div class='alert alert-danger text-center' role='alert'>
                    <h4 class='alert-heading'>Oops! No Results Match Found <i class='fas fa-frown'></i></h4>
                </div>";
            }
            while($row = mysqli_fetch_assoc($search_product_result))
            {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                // $product_id = $row['product_keyword'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];
                $product_image2 = $row['product_image2'];
                $product_image3 = $row['product_image3'];
                $product_price = $row['product_price'];
                $product_discount = $row['product_discount'];
                $product_stock = $row['stocks'];


                echo "<div class='col-md-3 mb-2'>
                    <div class='card'>
                        <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='./admin_area/product_images/$product_image1' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title fw-bold'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text fw-bold'><s>₹$product_price/-</s> ₹$product_discount/-</p>
                            <p class='card-text fw-bold'>$product_stock products left</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-success shadow-lg fw-bold'>Add to Cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary shadow-lg fw-bold'>View More</a>
                        </div>
                    </div>  
                </div>";
            }     
        }
    }

    // view details function
    function view_details()
    {
        global $con;

        // condition to check isset or not
        if(isset($_GET['product_id']))
        {
            if(!isset($_GET['category']))
            {
                if(!isset($_GET['brand']))
                {
                    $product_id = $_GET['product_id'];
                    $get_products_query = "Select * from products where product_id=$product_id";//set limit 0,9 to set a limit for view products to user
                    $get_products_result = mysqli_query($con,$get_products_query);
                    while($row = mysqli_fetch_assoc($get_products_result))
                    {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        // $product_id = $row['product_keyword'];
                        $category_id = $row['category_id'];
                        $brand_id = $row['brand_id'];
                        $product_image1 = $row['product_image1'];
                        $product_image2 = $row['product_image2'];
                        $product_image3 = $row['product_image3'];
                        $product_price = $row['product_price'];
                        $product_discount = $row['product_discount'];
                        $product_stock = $row['stocks'];


                        echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='./admin_area/product_images/$product_image1' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title fw-bold'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text fw-bold'>Price: ₹$product_price/-</p>
                                    <p class='card-text fw-bold'>$product_stock products left</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-success shadow-lg fw-bold'>Add to Cart</a>
                                    <a href='index.php' class='btn btn-secondary shadow-lg fw-bold'>Go Home</a>
                                </div>
                            </div>  
                        </div>

                        <div class='col-md-8'>
                            <!-- related images -->
                            <div class='row'>
                                <div class='col-md-12'>
                                    <h4 class='border border-dark shadow-lg p-2 mb-2 bg-white rounded text-center fw-bold text-success mb-5'>Related Product Images</h4>
                                </div>

                                <div class='col-md-6'>
                                    <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='admin_area/product_images/$product_image2' alt='$product_title'>
                                </div>

                                <div class='col-md-6'>
                                    <img class='border border-dark shadow-lg p-2 mb-2 bg-white rounded card-img-top' src='admin_area/product_images/$product_image3' alt='$product_title'>
                                </div>
                            </div>
                        </div>";

                        // Check if the user has already given feedback
                        $user_id = $_SESSION['user_id'];
                        $check_query = "SELECT * FROM product_reviews WHERE user_id = $user_id AND product_id = $product_id";
                        $check_result = $con->query($check_query);

                        if($check_result->num_rows > 0) 
                        {
                            // User has already given feedback, show all reviews
                            $reviews_query = "SELECT * FROM product_reviews WHERE product_id = $product_id";
                            $reviews_result = $con->query($reviews_query);

                            echo '<h2 class = "text-center bg-dark border border-success text-light mt-3 m-0 fw-bold p-3">Reviews</h2>';

                            // Display all reviews
                            while($row = $reviews_result->fetch_assoc()) 
                            {
                                $review_date = date('Y-m-d H:i:s', strtotime($row['review_date']));
                                $date = date('d-m-Y', strtotime($row['review_date']));
                                $time = date('H:i A', strtotime($row['review_date']));

                                // Fetch user image URL from user_table based on user_id
                                $user_id = $row['user_id'];
                                $get_user_image_query = "SELECT * FROM user_table WHERE user_id = $user_id";
                                $get_user_image_result = mysqli_query($con, $get_user_image_query);
                                $user_image = "";
                                if ($get_user_image_result && mysqli_num_rows($get_user_image_result) > 0) 
                                {
                                    $user_image_row = mysqli_fetch_assoc($get_user_image_result);
                                    $user_image = $user_image_row['user_image'];
                                }

                                echo "<div class='border border-success bg-dark text-light p-5 m-0'>";
                                    echo "<div class='d-flex align-items-center'>";
                                        // Display user's image
                                        echo "<img src='./users_area/user_images/$user_image' alt='User Image' class='rounded-circle me-3 mb-2' style='width: 50px; height: 50px;'>";
                        
                                        // Display user's name
                                        echo "<h5 class='mb-2 form-control'>" . $user_image_row['username'] . "</h5>";
                                    echo "</div>";
                        
                                    // Display review details
                                    if($row['rating'] == 5)
                                    {
                                        echo "<p class='mb-2 form-control'><strong>Rating:</strong> ★★★★★ (5 stars) </p>";
                                    }
                                    elseif($row['rating'] == 4)
                                    {
                                        echo "<p class='mb-2 form-control'><strong>Rating:</strong> ★★★★☆ (4 stars) </p>";
                                    }
                                    elseif($row['rating'] == 3)
                                    {
                                        echo "<p class='mb-2 form-control'><strong>Rating:</strong> ★★★☆☆ (3 stars) </p>";
                                    }
                                    elseif($row['rating'] == 2)
                                    {
                                        echo "<p class='mb-2 form-control'><strong>Rating:</strong> ★★☆☆☆ (2 stars) </p>";
                                    }
                                    else
                                    {
                                        echo "<p class='mb-2 form-control'><strong>Rating:</strong> ★☆☆☆☆ (1 star) </p>";
                                    }
                                    echo "<p class='mb-2 form-control'><strong>Review:</strong> " . $row['review_text'] . "</p>";
                                    echo "<p class='mb-2 form-control'><strong>Date:</strong> " . $date . "</p>";
                                    echo "<p class='mb-2 form-control'><strong>Time:</strong> " . $time . "</p>";
                                echo "</div>";
                            }
                        }
                        else
                        {
                            // Add the review form here
                            echo "<div class='d-flex justify-content-center'>
                                <div class='col-md-6 mt-5 rounded shadow-lg text-light fw-bold border border-success bg-dark p-4'>
                                    <h4 class='border border-success shadow-lg p-2 mb-2 bg-white rounded text-center fw-bold text-success mb-5'>Product Review</h4>
                                    <form action='' method='post'>
                                    <div class = 'text-center mb-3'>
                                        <h3 class = 'fw-bold'>$product_title</h3>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='rating'>Rating:</label>
                                        <select class='form-select' id='rating' name='rating'>
                                        <option value='5'>★★★★★ (5 stars)</option>
                                        <option value='4'>★★★★☆ (4 stars)</option>
                                        <option value='3'>★★★☆☆ (3 stars)</option>
                                        <option value='2'>★★☆☆☆ (2 stars)</option>
                                        <option value='1'>★☆☆☆☆ (1 star)</option>
                                        </select>
                                    </div>
                                        <div class='mb-3'>
                                            <label for='review'>Review:</label>
                                            <textarea class='form-control' id='review' name='review' rows='4'></textarea>
                                        </div>
                                        <br>
                                        <div class = 'text-center'>
                                            <input type='hidden' name='product_id' value='$product_id'>
                                            <button type='submit' name='submit' class='btn btn-success fw-bold px-5 py-2 shadow-lg'>Submit</button>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                            </div>";

                            // Check if the submit button is clicked
                            if(isset($_POST['submit']))
                            {
                                global $con;
                                // Check if the user has already given feedback
                                $user_id = $_SESSION['user_id'];
                                $product_id = $_POST['product_id'];
                                $check_query = "SELECT * FROM product_reviews WHERE user_id = $user_id AND product_id = $product_id";
                                $check_result = $con->query($check_query);

                                if($check_result->num_rows == 0) 
                                {
                                    // User has not given feedback, insert the new feedback
                                    $rating = $_POST['rating'];
                                    $review_text = $_POST['review'];
                                    $review_date = date('Y-m-d H:i:s'); // Current date and time
                                    $status = 1; // Set status to 1 for this user

                                    // Insert new review into the database
                                    $insert_query = "INSERT INTO product_reviews (product_id, user_id, rating, review_text, review_date, status) 
                                                    VALUES ($product_id, $user_id, $rating, '$review_text', NOW(), $status)";
                                    $insert_result = $con->query($insert_query);

                                    if($insert_result) 
                                    {
                                        // Feedback added successfully
                                        echo "<script>
                                            Swal.fire({
                                                title: 'Rating Successful',
                                                icon: 'success',
                                                showClass: {
                                                    popup: 'animate__animated animate__shakeX'
                                                },
                                                confirmButtonColor: '#4caf50',
                                                confirmButtonText: 'OK'
                                            }).then((result) => {
                                                window.location.href = 'product_details.php?product_id=$product_id';
                                            });
                                        </script>";
                                    } 
                                    else 
                                    {
                                        // Failed to add feedback
                                        echo "<script>
                                            Swal.fire({
                                                title: 'Error in submitting Review',
                                                icon: 'warning',
                                                showClass: {
                                                    popup: 'animate__animated animate__shakeX'
                                                },
                                                confirmButtonColor: '#4caf50',
                                                confirmButtonText: 'OK'
                                            }).then((result) => {
                                                window.location.href = 'product_details.php?product_id=$product_id';
                                            });
                                        </script>";
                                    }
                                }
                                else
                                {
                                    // User has already given feedback, show message
                                    echo "<script>
                                        Swal.fire({
                                            title: 'You have already submitted a review',
                                            icon: 'info',
                                            showClass: {
                                                popup: 'animate__animated animate__shakeX'
                                            },
                                            confirmButtonColor: '#4caf50',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            window.location.href = 'product_details.php?product_id=$product_id';
                                        });
                                    </script>";
                                }
                            }
                        }
                    }
                }
            }
        }      
    }

    // get ip address function
    function getIPAddress() 
    {  
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
        {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
        {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else
        {  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    } 

    // cart function
    function cart()
    {
        if(isset($_GET['add_to_cart']))
        {
            if(!isset($_SESSION['user_id']))
            {
                echo "<script>
                    Swal.fire({
                        title: 'You Need to Login Before Adding to Cart',
                        icon: 'warning',
                        showClass: {
                            popup: 'animate__animated animate__shakeX'
                        },
                        confirmButtonColor: '#4caf50',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href = './users_area/user_login.php';
                    });
                </script>";
            }
            else
            {
                global $con;
    
                $user_id = $_SESSION['user_id'];
                $get_product_id = $_GET['add_to_cart'];
                
                // Get the stock quantity of the product
                $stock_query = "SELECT stocks FROM products WHERE product_id = $get_product_id";
                $stock_result = mysqli_query($con, $stock_query);
                $stock_row = mysqli_fetch_assoc($stock_result);
                $stocks = $stock_row['stocks'];
    
                // Check if the product is already in the cart
                $cart_query = "SELECT * FROM cart_details WHERE user_id = '$user_id' AND product_id = '$get_product_id'";
                $cart_result = mysqli_query($con, $cart_query);
                $cart_num_rows = mysqli_num_rows($cart_result);
                
                if($cart_num_rows > 0)
                {
                    echo "<script>
                        Swal.fire({
                            title: 'This Item is Already in the Cart',
                            icon: 'error',
                            showClass: {
                                popup: 'animate__animated animate__shakeX'
                            },
                            confirmButtonColor: '#4caf50',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            window.location.href = 'index.php';
                        });
                    </script>";
                }
                else
                {
                    // Check if stock is available
                    if($stocks > 0)
                    {
                        // Insert the product into cart_details
                        $insert_query = "INSERT INTO cart_details (product_id, user_id, quantity) VALUES ($get_product_id, '$user_id', 1)";
                        $cart_result = mysqli_query($con, $insert_query);
    
                        echo "<script>
                            Swal.fire({
                                title: 'The Item is Added to Cart',
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => 
                            {
                                window.location.href = 'index.php';
                            });
                        </script>";
                    }
                    else
                    {
                        echo "<script>
                            Swal.fire({
                                title: 'No Stock Available',
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__shakeX'
                                },
                                confirmButtonColor: '#4caf50',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                window.location.href = 'index.php';
                            });
                        </script>";
                    }
                }
            }
        }
    }
    

    // function to get cart item numbers
    function cart_items()
    {
        if(isset($_GET['add_to_cart']))
        {
            global $con;

            $user_id = $_SESSION['user_id'];
            $cart_query = "Select * from cart_details where user_id='$user_id'";
            $cart_result = mysqli_query($con,$cart_query);
            $count_cart_items = mysqli_num_rows($cart_result);
        }
        else
        {
            global $con;

            $user_id = $_SESSION['user_id'];
            $cart_query = "Select * from cart_details where user_id='$user_id'";
            $cart_result = mysqli_query($con,$cart_query);
            $count_cart_items = mysqli_num_rows($cart_result);
        }
        echo $count_cart_items;
    }

    // function to get pc_cart item numbers
    function pc_cart_items()
    {
        if(isset($_GET['addToCart']))
        {
            global $con;

            $user_id = $_SESSION['user_id'];
            $cart_query = "Select * from pc_cart where user_id='$user_id'";
            $cart_result = mysqli_query($con,$cart_query);
            $count_cart_items = mysqli_num_rows($cart_result);
        }
        else
        {
            global $con;

            $user_id = $_SESSION['user_id'];
            $cart_query = "Select * from pc_cart where user_id='$user_id'";
            $cart_result = mysqli_query($con,$cart_query);
            $count_cart_items = mysqli_num_rows($cart_result);
        }
        echo $count_cart_items;
    }

    // total price function for pc_cart
    function total_pc_cart_price()
    {
        global $con;
    
        $user_id = $_SESSION['user_id'];
        $total_query = "SELECT COALESCE(SUM(discount * quantity), 0) AS total_discount
                        FROM pc_cart
                        WHERE pc_cart.user_id = '$user_id'";
        $result = mysqli_query($con, $total_query);
        $row = mysqli_fetch_assoc($result);
        $total_price = $row['total_discount'];
        echo $total_price;
    }
    

    // total price function
    function total_cart_price()
    {
        global $con;

        $user_id = $_SESSION['user_id'];
        $total_query = "SELECT COALESCE(SUM(products.product_discount * cart_details.quantity), 0) AS total_price
                        FROM cart_details
                        INNER JOIN products ON cart_details.product_id = products.product_id
                        WHERE cart_details.user_id = '$user_id'";
        $result = mysqli_query($con, $total_query);
        $row = mysqli_fetch_assoc($result);
        $total_price = $row['total_price'];
        echo $total_price;
    }


    // get user order details
    function get_user_order_details()
    {
        global $con;

        $username = $_SESSION['username'];
        $get_details = "SELECT * FROM user_table WHERE username = '$username'";
        $result_query = mysqli_query($con,$get_details);
        while($row_query = mysqli_fetch_array($result_query))
        {
            $user_id = $row_query['user_id'];
            if(!isset($_GET['edit_account']))
            {
                if(!isset($_GET['my_orders']))
                {
                    if(!isset($_GET['delete_account']))
                    {
                        $get_orders = "SELECT * FROM user_orders WHERE user_id = $user_id AND order_status = 'pending'";
                        $result_orders_query = mysqli_query($con,$get_orders);
                        $row_count = mysqli_num_rows($result_orders_query);
                        if($row_count>0)
                        {
                            echo "<h2 class = 'text-center text-dark my-5'>
                                    You Have
                                        <span class='text-success'> 
                                            $row_count
                                        </span> 
                                    Pending Orders
                                </h2>";
                            echo "<p class = 'text-center'>
                                <a class = 'btn btn-success text-light text-center fw-bold shadow-lg' href='profile.php?my_orders'>
                                    My Orders
                                </a>
                            </p>";
                        }
                        else
                        {
                            echo "<h2 class = 'text-center text-dark my-5'>
                                You Have Zero Pending Orders
                            </h2>";

                            echo "<p class = 'text-center'>
                                <a class = 'btn btn-success text-light text-center' href='../index.php'>
                                    Explore Products
                                </a>
                            </p>";
                        }
                    }
                }
            }
        }
    }

    // Check Admin Login
    function check_login() 
    {
        if(!isset($_SESSION['admin_name'])) 
        {
            header("Location: admin_login.php"); // Redirect to login page
            exit();
        }
    }

    function getUserImage($con, $userId) 
    {
        $query = "SELECT user_image FROM users_table WHERE user_id = $userId";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['user_image'];
        }
        return null; // If user ID not found or image not set
    }
?>