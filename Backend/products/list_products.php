<?php
$servername = "localhost";
$username = "root"; // Change this based on your DB credentials
$password = "";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';
$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : 0;
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : 10000;

$sql = "SELECT * FROM products WHERE price BETWEEN $minPrice AND $maxPrice";

if (!empty($category)) {
    $sql .= " AND category='$category'";
}
if (!empty($brand)) {
    $sql .= " AND brand='$brand'";
}

$result = $conn->query($sql);

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
$conn->close();
?>
