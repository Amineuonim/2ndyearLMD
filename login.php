<?php
$host = 'localhost'; 
$database = 'web'; 
$dbUsername = 'omni'; 
$dbPassword = 'q'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =($_POST['name']);
    $email =($_POST['Email']);
    $userpassword =($_POST['password']);

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$database", $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND email = :email AND userpassword =:userpassword");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':userpassword', $userpassword);
        $stmt->execute();
        $existingAccount = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingAccount) {
                echo "account found";
                // Log the session
                $currentDate = date('Y-m-d H:i:s');
                $logStmt = $pdo->prepare("INSERT INTO logs (session, username) VALUES (:session, :username)");
                $logStmt->bindParam(':session', $currentDate);
                $logStmt->bindParam(':username', $username);
                $logStmt->execute();

                // Redirect to main.html
                header("Location: main.php");
                exit();

        } else {
            header("Location: login.html");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


