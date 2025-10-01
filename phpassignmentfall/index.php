<?php
// Database connection
$host = "localhost";
$dbname = "pizza_shop"; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $size     = $_POST['size'];
    $toppings = isset($_POST['toppings']) ? implode(", ", $_POST['toppings']) : "";
    $quantity = $_POST['quantity'];
    $address  = $_POST['address'];

    $sql = "INSERT INTO orders (customer_name, email, phone, pizza_size, toppings, quantity, address)
            VALUES (:name, :email, :phone, :size, :toppings, :quantity, :address)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':size' => $size,
        ':toppings' => $toppings,
        ':quantity' => $quantity,
        ':address' => $address
    ]);

    header("Location: success.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pizza Order</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>🍕 PIZZA ORDER FORM</h1>

  <form method="POST" action="index.php" class="order-form">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Phone:</label>
    <input type="tel" name="phone" required>

    <label>Pizza Size:</label>
    <select name="size" required>
      <option value="Small">Small</option>
      <option value="Medium">Medium</option>
      <option value="Large">Large</option>
    </select>

    <label>Toppings:</label>
    <div>
      <input type="checkbox" name="toppings[]" value="Cheese"> Cheese
      <input type="checkbox" name="toppings[]" value="Pepperoni"> Pepperoni
      <input type="checkbox" name="toppings[]" value="Mushrooms"> Mushrooms
      <input type="checkbox" name="toppings[]" value="Olives">Black Olives
    </div>

    <label>Quantity:</label>
    <input type="number" name="quantity" min="1" value="1" required>

    <label>Delivery Address:</label>
    <textarea name="address" required></textarea>

    <button type="submit">Place Your Order</button>
  </form>
</body>
</html>
