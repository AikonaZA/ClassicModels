<?php
// Get the product data
$productCode = filter_input(INPUT_POST, 'name');
$productName = filter_input(INPUT_POST, 'product');
$scale = filter_input(INPUT_POST, 'scale');
$vendor = filter_input(INPUT_POST, 'vendor');
$description = filter_input(INPUT_POST, 'description');
$qty = filter_input(INPUT_POST, 'qty');
$sellingPrice = filter_input(INPUT_POST, 'selling price');
$MSRP = filter_input(INPUT_POST, 'manufacturer price');

    // Add the product to the database  
    $query = 'UPDATE products
              SET productName = :productName, productScale = :scale, productVendor = :vendor, productDescription = :description, quantityInStock = :qty, buyPrice = sellingPrice, MSRP = :msrp
              WHERE productCode = :productCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':productCode', $productCode);
    $statement->bindValue(':productName', $productName);
    $statement->bindValue(':scale', $scale);
    $statement->bindValue(':vendor', $vendor);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':qty', $qty);
    $statement->bindValue(':sellingPrice', $sellingPrice);
    $statement->bindValue(':msrp', $MSRP);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}
?>