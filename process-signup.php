<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["Email"]);
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirmation"];

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $mysqli = mysqli_connect('localhost', 'root', '', 'seminar') or die('Error connecting to MySQL server: ' . mysqli_connect_error());
    $sql = "INSERT INTO users (username, Email, password_hash) VALUES (?, ?, ?)";
            
    $stmt = $mysqli->stmt_init();

    if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("sss",
                    $_POST["username"],
                    $_POST["Email"],
                    $password_hash);
                    
    if ($stmt->execute()) {

        header("Location: login.php");
        exit;
    } else {

        if ($mysqli->errno === 1062) {
            die("Email already taken");
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }

    echo json_encode(['success' => true]);
    exit();
}

echo json_encode(['success' => false, 'errors' => ['form' => 'Invalid form submission']]);
?>