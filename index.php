<?php
require_once('database.php');

// Get category ID
if (!isset($productLine_id)) {
    $productLine_id = filter_input(INPUT_GET, 'productLine_id');
    if ($productLine_id == NULL || $productLine_id == FALSE) {
        $productLine_id = 'Classic cars';
	}
}

// Get name for selected category
$queryProductLine = 'SELECT * FROM productlines
                  WHERE productLine = :productLine_id';
$statement1 = $db->prepare($queryProductLine);
$statement1->bindValue(':productLine_id', $productLine_id);
$statement1->execute();
$productCat = $statement1->fetch();
$productLineDes = $productCat['productLine'];
$statement1->closeCursor();

// Get all ProductLines
$query = 'SELECT * FROM productlines';
				//ORDER BY productlines';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

$query2 = 'SELECT p.productCode, p.productName, p.productScale, p.buyPrice, COUNT(o.productCode) as total 
          FROM products p, orderdetails o
          WHERE p.productLine = :productLine_id AND p.productCode = o.productCode
          GROUP BY p.productCode
          ORDER BY p.productName';
$statement4 = $db->prepare($query2);
$statement4->bindValue(":productLine_id", $productLine_id);
$statement4->execute();
$products = $statement4->fetchAll();
$statement4->closeCursor();
    

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Classic Models</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<!-- the body section -->
<body>
<header>
	<h1>ClassicModels Online</h1>
	Classic models for all Automobile Enthusiasts
</header>
<main>
    <h1>Classic Models Product List</h1>

    
        <!-- display a list of categories -->
        <ul><h2>Product Lines</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $productCat) : ?>
            <li><a href=".?productLine_id=<?php echo $productCat['productLine']; ?>">
                    <?php echo $productCat['productLine']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    
        <!-- display a table of products -->
        <h2><?php echo $productLineDes; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
				<th>Scale</th>
                <th class="right">Price</th>
				<th>Total Sold</th>
                <th>&nbsp;</th>
            </tr>	
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode'];?></td>
                <td><?php echo $product['productName']; ?></td>
				<td><?php echo $product['productScale']; ?></td>
                <td class="right"><?php echo $product['buyPrice']; ?></td>
				<td class="center"><?php echo $product['total']; ?></td>
				
                <td><form action="add_product_form.php" method="post">
				
                    
					<input type="submit" value="Update">
                </form></td>
            </tr>
            <?php endforeach; ?>
			
			
        </table>
        <p><a href="add_product_form.php">Add New Product Line</a></p>      
    
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Classic Models, Inc.</p>
</footer>
</body>
</html>