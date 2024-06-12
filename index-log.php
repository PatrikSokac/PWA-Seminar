<?php
session_start();
if (isset($_SESSION["Email"])) {

    $dbc = mysqli_connect('localhost', 'root', '', 'seminar') or die('Error connecting to MySQL server: ' . mysqli_connect_error());
    
    $email = mysqli_real_escape_string($dbc, $_SESSION["Email"]);
    $query = "SELECT * FROM users WHERE Email = '$email'";

    $result = $dbc->query($query);

    $user = $result->fetch_assoc();
}

$email = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Grid</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header style="background-color: #8ae4ff;">
        <div class="header-flex">
            <img src="slike/logo.png" alt="Logo">
            <nav>
                <ul>
                    <li><a href="#" style="color: #fff;">My articles</a></li>
                    <li><a href="dodajarticle-log.php">Dodaj article</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="conteiner">
        <div class="article-container">
            <?php include 'article-card.php'; ?>
        </div>
            
    </div>
    <footer style="background-color: #8ae4ff;">
        <p>Patik Sokac 13.06.2024 | Tehničko Veleučilište Zagreb | Home</p>
    </footer>
</body>
</html>