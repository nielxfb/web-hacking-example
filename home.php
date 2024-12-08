<?php
session_start();

// Middleware to check if user is logged in
if (empty($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

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

$query = '';
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // SQL query vulnerable to SQL injection
    $sql = "SELECT id, product_name, product_price FROM products WHERE product_name LIKE '%$query%'";
    // Execute query
    $result = $conn->query($sql);
} else {
    // SQL query vulnerable to SQL injection
    $sql = "SELECT id, product_name, product_price FROM products";
    // Execute query
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            overflow-y: scroll;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .logout-button {
            background-color: #ff4d4d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-bottom: 30px;
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
        }

        .logout-button:hover {
            background-color: #e03e3e;
        }

        .search-container {
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            display: flex;
            align-items: center;
        }

        .search-bar {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-bar:focus {
            outline: none;
            border-color: #007bff;
        }

        .search-button {
            width: 20%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        .product-list {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .product-item {
            background-color: #fafafa;
            padding: 15px;
            margin: 10px 0;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .product-item:hover {
            background-color: #f1f1f1;
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .product-price {
            font-size: 16px;
            color: #333;
        }

        .product-name:hover {
            text-decoration: underline;
        }

        .no-results {
            font-size: 18px;
            color: #ff4d4d;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logout Button -->
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-button">Logout</button>
        </form>

        <h1>Products</h1>

        <!-- Search Bar with Button -->
        <form action="" method="GET" class="search-container">
            <input type="text" name="query" class="search-bar" placeholder="Search products..." value="<?php echo htmlspecialchars($query); ?>" />
            <button type="submit" class="search-button">Search</button>
        </form>

        <div class="product-list">
            <?php
            // Check if there are any products
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<a href='product_details.php?id=" . $row["id"] . "' class='product-name'>" . $row["product_name"] . "</a>";
                    echo "<span class='product-price'>$" . $row["product_price"] . "</span>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-results'>No products found.</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
