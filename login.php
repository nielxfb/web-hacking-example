<?php
session_start();

// Get input values from the form
$email = $_POST['email'];
$password = $_POST['password'];

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
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

// Execute query
$result = $conn->query($sql);

// Check if the query returned any results
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();  // Get user data
    $_SESSION['user'] = $user;  // Store user in session

    header("Location: home.php");
    exit();
} else {
    // Login failed
    echo "
    <html>
    <body>
        <form id='redirectForm' action='index.php' method='POST'>
            <input type='hidden' name='error' value='Invalid email or password'>
        </form>
        <script type='text/javascript'>
            document.getElementById('redirectForm').submit();
        </script>
    </body>
    </html>
    ";
    exit(); // Stop further execution after sending the form
}
