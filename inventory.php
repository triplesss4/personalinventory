<?php
include 'db.php'; // Connect to the database

// Fetch all items from the 'items' table that are not sold
$sql = "SELECT * FROM items WHERE price_sold IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventory List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>Inventory Management</h1>

  <nav>
    <a href="index.php">Home</a> |
    <a href="add.php">Add Product</a> |
    <a href="search.php">Search Product</a> |
    <a href="modify.php">Modify Product</a>
  </nav>

  <h2>All Products</h2>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Category</th>
      <th>Brand</th>
      <th>Size</th>
      <th>Price Sold</th>
      <th>Shipping Price</th>
      <th>Date Sold</th>
      <th>Created At</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
        echo "<td>$" . htmlspecialchars($row['price'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($row['category'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($row['brand'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($row['size'] ?? '') . "</td>";
        echo "<td>$" . htmlspecialchars($row['price_sold'] ?? '') . "</td>";
        echo "<td>$" . htmlspecialchars($row['shipping_price'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($row['date_sold'] ?? '') . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at'] ?? '') . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='11'>No products found.</td></tr>";
    }
    ?>

  </table>

</body>
</html>
