<?php
// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Connect to the database (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password_db = "root"; // Database password
    $dbname = "sesi10";

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query vulnerable to SQL injection
    $sql = "SELECT id, product_name, product_price FROM products WHERE id = $product_id";

    // Execute query
    $result = $conn->query($sql);

    // Check if product is found
    if ($result->num_rows > 0) {
        // Output the product details
        $row = $result->fetch_assoc();
        $product_name = $row["product_name"];
        $product_price = $row["product_price"];
        $product_id = $row["id"];
    } else {
        echo "<p class='error'>No product found with the provided ID.</p>";
        exit();
    }

    // Close connection
    $conn->close();
} else {
    echo "<p class='error'>No product ID specified.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #007bff;
        }

        .product-details {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .product-details strong {
            color: #007bff;
        }

        .product-price {
            font-size: 1.5em;
            color: #28a745;
            margin-top: 10px;
        }

        .error {
            color: #ff4d4d;
            font-size: 1.2em;
            text-align: center;
        }

        .back-link {
            margin-top: 20px;
            display: block;
            color: #007bff;
            font-size: 1.1em;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Product Details</h1>

        <div class="product-details">
            <p><strong>Product ID:</strong> <?php echo $product_id; ?></p>
            <p><strong>Product Name:</strong> <?php echo $product_name; ?></p>
            <p class="product-price"><strong>Price:</strong> $<?php echo $product_price; ?></p>
        </div>

        <a href="home.php" class="back-link">Back to Products List</a>
    </div>

</body>
</html>
