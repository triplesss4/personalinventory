<?php
include 'db.php';

$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$category = $_POST['category'];
$price_sold = $_POST['price_sold'];
$shipping_price = $_POST['shipping_price'];
$date_sold = $_POST['date_sold'];

$sql = "INSERT INTO items (name, price, quantity, category, price_sold, shipping_price, date_sold)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sdissds", $name, $price, $quantity, $category, $price_sold, $shipping_price, $date_sold);

if ($stmt->execute()) {
  echo "Item added successfully!";
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>

