<?php
include 'db.php';

// Get form data
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$category = $_POST['category'];
$brand = $_POST['brand'];         // NEW
$size = $_POST['size'];           // NEW
$price_sold = $_POST['price_sold'] !== '' ? $_POST['price_sold'] : null;
$shipping_price = $_POST['shipping_price'] !== '' ? $_POST['shipping_price'] : null;
$date_sold = $_POST['date_sold'] !== '' ? $_POST['date_sold'] : null;

// SQL with brand and size added
$sql = "INSERT INTO items (name, price, quantity, category, brand, size, price_sold, shipping_price, date_sold)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Bind 9 parameters now:  s = string, d = double (decimal), i = integer
$stmt->bind_param("sdisssdds", $name, $price, $quantity, $category, $brand, $size, $price_sold, $shipping_price, $date_sold);

// Execute and check
if ($stmt->execute()) {
  echo "Item added successfully!";
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>
