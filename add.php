<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Product</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Add New Product</h1>

<nav>
    <a href="search.php">Search Product</a> 
    <a href="add.php">Add Product</a> 
    <a href="inventory.php">Available Inventory</a> 
    <a href="sold_inventory.php">Sold Inventory</a> 
  </nav>

<form action="form.php" method="POST">
  <input type="text" name="name" placeholder="Item Name" required><br>
  <input type="number" step="0.01" name="price" placeholder="Original Price" required><br>
  <input type="number" name="quantity" placeholder="Quantity" required><br>
  <input type="text" name="category" placeholder="Category" required><br>
  <input type="text" name="brand" placeholder="Brand" required><br>
  <input type="text" name="size" placeholder="Size" required><br>
  <input type="number" step="0.01" name="price_sold" placeholder="Price Sold"><br>
  <input type="number" step="0.01" name="shipping_price" placeholder="Shipping Price"><br>
  <input type="date" name="date_sold" placeholder="Date Sold"><br>

  <button type="submit" name="add">Add Product</button>
</form>

</body>
</html>
