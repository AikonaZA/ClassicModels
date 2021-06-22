<?php
require('database.php');
$query = 'SELECT *
          FROM products
          ORDER BY productCode';
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>ClassicModels</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>ClassicModels Online</h1></header>

    <main>
        <h1>View/Update Product</h1>
        <form action="update_product.php" method="post"
              id="update_product_form">

            <label>Name:</label>
            <input type="text" name="name" disabled><br>

            <label>Product Line:</label>
            <select name="product">
            <?php foreach ($productCode as $product) : ?>
                <option value="<?php echo $product['productCode']; ?>">
                    <?php echo $product['productName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Scale:</label>
            <input type="text" name="scale" disabled><br>

            <label>Vendor:</label>
            <input type="text" name="vendor" disabled><br>

            <label>Description:</label>
            <input type="text" name="description" disabled><br>

            <label>QTY in Stock:</label>
            <input type="text" name="qty"><br>

            <label>Selling Price:</label>
            <input type="text" name="selling price"><br>

            <label>Manufacturer Price:</label>
            <input type="text" name="manufacturer price"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Update Product"><br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ClassicModels, Inc.</p>
    </footer>
</body>
</html>