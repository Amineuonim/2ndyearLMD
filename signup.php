<?php
$host = 'localhost'; 
$database = 'web'; 
$username = 'omni'; 
$password = 'q'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$database", $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = htmlspecialchars($_POST["username"]);
        $userpassword = htmlspecialchars($_POST["userpassword"]);
        $email = htmlspecialchars($_POST["email"]);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $existingAccount = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingAccount) {
            header("Location: signup.html");
            exit(); // Stop further execution
        }

        $insertStmt = $pdo->prepare("INSERT INTO users (username, userpassword, email) VALUES (:username, :userpassword, :email)");
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':userpassword', $userpassword);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->execute();

        echo "Account added successfully.";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

