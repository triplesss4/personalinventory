<?php
include 'db.php'; // Connect to database

// Step 1: Fetch item by ID (if provided)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
} else {
    $item = null;
}

// Step 2: Handle form submission to update the item
if (isset($_POST['update'])) {
    $id = $_POST['id']; // Hidden field
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $size = $_POST['size'];
    $price_sold = $_POST['price_sold'];
    $shipping_price = $_POST['shipping_price'];
    $date_sold = $_POST['date_sold'];

    $sql = "UPDATE items SET 
            name = ?, price = ?, quantity = ?, category = ?, brand = ?, size = ?, 
            price_sold = ?, shipping_price = ?, date_sold = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdisssddsi", 
        $name, $price, $quantity, $category, $brand, $size, $price_sold, $shipping_price, $date_sold, $id);

    if ($stmt->execute()) {
        echo "Item updated successfully! <a href='inventory.php'>Go back to Inventory</a>";
    } else {
        echo "Error updating item: " . $stmt->error;
    }

    $conn->close();
    exit(); // Stop script after updating
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Modify Item</h1>

<nav>
  <a href="index.php">Home</a> |
  <a href="inventory.php">Available Inventory</a> |
  <a href="inventory_sold.php">Sold Inventory</a> |
  <a href="add.php">Add Product</a> |
  <a href="search.php">Search Product</a>
</nav>

<?php if ($item): ?>
    <form method="POST" action="modify.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">

        <input type="text" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" placeholder="Item Name" required><br>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($item['price']); ?>" placeholder="Original Price" required><br>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" placeholder="Quantity" required><br>
        <input type="text" name="category" value="<?php echo htmlspecialchars($item['category']); ?>" placeholder="Category" required><br>
        <input type="text" name="brand" value="<?php echo htmlspecialchars($item['brand']); ?>" placeholder="Brand" required><br>
        <input type="text" name="size" value="<?php echo htmlspecialchars($item['size']); ?>" placeholder="Size" required><br>
        <input type="number" step="0.01" name="price_sold" value="<?php echo htmlspecialchars($item['price_sold']); ?>" placeholder="Price Sold"><br>
        <input type="number" step="0.01" name="shipping_price" value="<?php echo htmlspecialchars($item['shipping_price']); ?>" placeholder="Shipping Price"><br>
        <input type="date" name="date_sold" value="<?php echo htmlspecialchars($item['date_sold']); ?>"><br>

        <button type="submit" name="update">Update Item</button>
    </form>
<?php else: ?>
    <p>No item selected. Please go back and select an item to modify.</p>
<?php endif; ?>

</body>
</html>
