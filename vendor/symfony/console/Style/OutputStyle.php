<?php
    $msg = '';
    $blogid = $_GET['id'];
    require_once './Product.php';
    $product = new Product();
    
    $result = $product->getProductInfoById($blogid);
    $productInfo = mysqli_fetch_assoc($result);
    
    if(isset($_POST['btn'])){
        $product->updateProductInfo($_POST, $blogid);
    }
    
    
?>
<hr>
        <a href="add-product.php">Add Product</a>
        <a href="view-product.php">View Products</a>
<hr>
<h2><?php echo $msg; ?></h2>
<form action="" method="post" name="editProductForm" >
    <table>
        <tr>
            <td>Product Name</td>
            <td><input type="text" name="product_name" value="<?php echo $productInfo['product_name']; ?>"></td>
        </tr>
        <tr>
            <td>Product Price</td>
            <td><input type="number" name="product_price" value="<?php echo $productInfo['product_price']; ?>"></td>
        </tr>
        <tr>
            <td>Product Quantity</td>
            <td><input type="number" name="product_quantity" value="<?php echo $productInfo['product_quantity']; ?>"></td>
        </tr>
        <tr>
            <td>Product Description</td>
            <td><textarea name="product_description"><?php echo $productInfo['product_description']; ?></textarea></td>
        </tr>
        <tr>
            <td>Publication Status</td>
            <td>
                <select name="publication_status">
                    <option value="1">Published</option>
                    <option value="0">Unpublished</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Save Blog Info" name="btn"></td>
        </tr>
    </table>
    
</form>
<script>
    document.forms['editProductForm'].elements['publication_status'].value = '<?php echo $productInfo['publication_status']; ?>'; 
</script>
  
<hr>
<div style="text-align: center; background-color: gray; color:DarkRed; padding: 15px;">&copy;All Right Reserved By Mostak Ahmad Emo. SEID: 171477</div>
<hr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              