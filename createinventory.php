<?php include ('layout/header.php'); ?>
<?php include ('dbconnection.php'); 

$query = "SELECT * FROM category";
$result = mysqli_query($conn, $query);
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <form class ="mt-4">
                            <div class="form-group">
                                <label for="snNo">SN No</label>
                                <input type="text" class="form-control" id="snNo" name = "sn_no" placeholder="Enter SN No">
                            </div>
                            <div class="form-group mt-2">
                                <label for="itemName">Item Name</label>
                                <input type="text" class="form-control" id="itemName" name="item_name" placeholder="Enter Item Name">
                            </div>
                            <div class="form-group mt-2">
                                <label for="itemDesc">Item Desc</label>
                                <textarea class="form-control" name="item_desc" id="itemDesc" placeholder="Enter Item Desc"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="img">Item image</label>
                                <input type="file" id="img" name="img" accept="image/*">
                            </div>
                            <div class="form-group mt-2">
                                <label for="qty">Item Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter Item Quantity">
                            </div>
                            <div class="form-group mt-2">
                                <label for="categoryid">Item Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) 
                                        {
                                            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
                                        }
                                    ?>
                    </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>  
                </main>
            </div>
        
<?php include ('layout/footer.php'); ?>
