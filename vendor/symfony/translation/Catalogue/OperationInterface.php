<?php
    
     require_once './Product.php';
     $product = new Product();
     $queryResult = $product->getAllProductInfo();
     
     if(isset($_GET['status'])){
         $id = $_GET['id'];
         $product->deleteProductInfo($id);
     }
     

?> 




<hr>
        <a href="add-product.php">Add Product</a>
        <a href="view-product.php">View Products</a>
<hr>

<table border="2" style="text-align: center">
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Product Quantity</th>
        <th>Product Description</th>
        <th>Publication Status</th>
        <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($queryResult)){ ?>   
    <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['product_name'];?></td>
        <td><?php echo $row['product_price'];?></td>
        <td><?php echo $row['product_quantity'];?></td>
        <td><?php echo $row['product_description'];?></td>
        <td><?php if($row['publication_status'] == '1') echo 'Published'; else echo 'Unpublished';?></td>
        <td>
            <a href="edit-product.php?id=<?php echo $row['id'];?>">Edit Product</a>||
            <a href="?status=delete&id=<?php echo $row['id'];?>" onclick="return confirm('Are You Sure To Delete This??');">Delete Product</a>
        </td>
    </tr>
    <?php }?>
</table>


<hr>
<div style="text-align: center; background-color: gray; color:DarkRed; padding: 15px;">&copy;All Right Reserved By Mostak Ahmad Emo. SEID: 171477</div>
<hr>                                                                                                                                                                                                                                                                                                                                                                                                                                                              