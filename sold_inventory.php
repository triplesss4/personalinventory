<?php
include 'db.php'; // Connect to the database

// Handle sorting option
$sortOrder = "DESC"; // Default: Newest first
if (isset($_GET['sort']) && $_GET['sort'] === 'asc') {
  $sortOrder = "ASC"; // Oldest first if selected
}

// Fetch only sold items, sorted by date_sold
$sql = "SELECT * FROM items WHERE price_sold IS NOT NULL ORDER BY date_sold $sortOrder";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sold Inventory</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>Sold Inventory</h1>

  <nav>
    <a href="index.php">Home</a> 
    <a href="search.php">Search Product</a> 
    <a href="add.php">Add Product</a> 
    <a href="inventory.php">Available Inventory</a> 
    <a href="sold_inventory.php">Sold Inventory</a>
  </nav>

  <form method="GET" action="inventory_sold.php">
    <label for="sort">Sort by Date Sold:</label>
    <select name="sort" id="sort">
      <option value="desc" <?php if ($sortOrder == 'DESC') echo 'selected'; ?>>Newest First</option>
      <option value="asc" <?php if ($sortOrder == 'ASC') echo 'selected'; ?>>Oldest First</option>
    </select>
    <button type="submit">Apply</button>
  </form>

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
      echo "<tr><td colspan='11'>No sold products found.</td></tr>";
    }
    ?>

  </table>

</body>
</html>
