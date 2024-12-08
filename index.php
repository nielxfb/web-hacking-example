<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeLtech</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: inline-block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #0066cc;
            outline: none;
        }

        button {
            padding: 10px;
            background-color: #0066cc;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #004d99;
        }

        .forgot-password {
            text-align: right;
            font-size: 12px;
            color: #0066cc;
            margin-top: 10px;
            cursor: pointer;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div>
        <h1>Login Page</h1>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Enter your email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
            
            <?php
            if (isset($_POST['error'])) {
                echo "<p style='color: red;'>" . htmlspecialchars($_POST['error']) . "</p>";
            }
            ?>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
