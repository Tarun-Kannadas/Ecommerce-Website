<h3 class="text-center text-success fw-bold my-4"> All Brands</h3>
<div class = "d-flex justify-content-center">
    <table class="table table-bordered table-hover mt-5 shadow-lg" style = "width: 75%">
        <thead>
            <tr class = "text-center">
                <th class="bg-success" style="width: 20%">Sl No.</th>
                <th class="bg-success">Brand Title</th>
                <th class="bg-success" style="width: 20%">Edit</th>
                <!-- <th class="bg-success">Delete</th> -->
            </tr>
        </thead>
        <tbody class="bg-secondary text-light text-center">
            <?php
                $brand_sql = "SELECT * FROM brands";
                $exec_sql = mysqli_query($con,$brand_sql);
                $num = 0;
                while($row = mysqli_fetch_assoc($exec_sql))
                {
                    $brand_id = $row['brand_id'];
                    $brand_title = $row['brand_title'];
                    $num++;
            ?>
            <tr>
                <td class = "bg-secondary text-light"><?php echo $num; ?></td>
                <td class = "bg-secondary text-light"><?php echo $brand_title; ?></td>
                <td class = "bg-secondary text-light">
                    <a href='index.php?edit_brand=<?php echo $brand_id ?>' class='text-light'>
                        <i class='fas fa-edit'></i>
                    </a>
                </td>
                <!-- <td class = "bg-secondary text-light">                    
                    <a href='index.php?delete_brand=
                    <?php 
                        // echo $brand_id 
                    ?>
                    ' type="button" class="text-light" data-toggle="modal" data-target="#exampleModal">
                        <i class='fas fa-trash'></i>
                    </a>
                </td> -->
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?view_brands" class = "text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='./index.php?delete_brand=<?php echo $brand_id ?>' class = "text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>