<h3 class="text-center text-success fw-bold my-4"> All Categories</h3>
<table class="table table-bordered table-hover mt-5 shadow-lg">
    <thead>
        <tr>
            <th class="bg-success">Sl No.</th>
            <th class="bg-success">User Image</th>
            <th class="bg-success">Username</th>
            <th class="bg-success">User Email</th>
            <th class="bg-success">User Address</th>
            <th class="bg-success">User Number</th>
            <!-- <th class="bg-success">Edit</th>
            <th class="bg-success">Delete</th> -->
        </tr>
    </thead>
    <tbody class="bg-secondary text-light text-center">
        <?php
            $category_sql = "SELECT * FROM user_table";
            $exec_sql = mysqli_query($con,$category_sql);
            $num = 0;
            while($row = mysqli_fetch_assoc($exec_sql))
            {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_email = $row['user_email'];
                $user_address = $row['user_address'];
                $user_image = $row['user_image'];
                $user_number = $row['user_number'];
                $num++;
        ?>
        <tr>
            <td class = "bg-secondary text-light"><?php echo $num; ?></td>
            <td class = "bg-secondary text-light"><img src='../users_area/user_images/<?php echo $user_image ?>' class = 'prdct_img'></td>
            <td class = "bg-secondary text-light"><?php echo $username; ?></td>
            <td class = "bg-secondary text-light"><?php echo $user_email; ?></td>
            <td class = "bg-secondary text-light"><?php echo $user_address; ?></td>
            <td class = "bg-secondary text-light"><?php echo $user_number; ?></td>
            <!-- <td class = "bg-secondary text-light">
                <a href='' class='text-light'>
                    <i class='fas fa-edit'></i>
                </a>
            </td>
            <td class = "bg-secondary text-light">                    
                <a href='' class='text-light'>
                    <i class='fas fa-trash'></i>
                </a>
            </td> -->
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>