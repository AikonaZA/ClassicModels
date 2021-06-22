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
        <h1>Add New Product Line</h1>
        <form action="add_product.php" method="post"
              id="add_product_form">

            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo $product['productCode']; ?>">
                    <?php echo $product['productName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Code:</label>
            <input type="text" name="code"><br>

            <label>Name:</label>
            <input type="text" name="name"><br>

            <label>List Price:</label>
            <input type="text" name="price"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Product"><br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ClassicModels, Inc.</p>
    </footer>
</body>
</html>