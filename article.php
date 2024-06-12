<?php
session_start();

if (isset($_SESSION["Email"])) {
    $dbc = mysqli_connect('localhost', 'root', '', 'seminar') or die('Error connecting to MySQL server: ' . mysqli_connect_error());
    
    $email = mysqli_real_escape_string($dbc, $_SESSION["Email"]);
    $query = "SELECT * FROM users WHERE Email = '$email'";
    
    $result = $dbc->query($query);
    $user = $result->fetch_assoc();
    $dbc->close();
}

$mysqli = mysqli_connect('localhost', 'root', '', 'seminar') or die('Error connecting to MySQL server: ' . mysqli_connect_error());

if (!isset($_GET['article_id'])) {
    die('Article ID not specified.');
}

$article_id = $_GET['article_id'];

$sql = "SELECT Naslov, Uvod, Slika, Text, Datum FROM article WHERE Id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $article_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $article = $result->fetch_assoc();
} else {
    die('Article not found.');
}

$stmt->close();
$mysqli->close();
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
                <li><a href="index-log.php">My articles</a></li>
                <li><a href="dodajarticle-log.php">Dodaj article</a></li>
                <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="conteiner">
        <div class="naslov_datum">
            <h1><?php echo htmlspecialchars($article['Naslov']); ?></h1>
            <p class="datum"><?php echo htmlspecialchars($article['Datum']); ?></p>
        </div>
        <p><?php echo nl2br(htmlspecialchars($article['Uvod'])); ?></p>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($article['Slika']); ?>" alt="Article Image">
        <hr>
        <p>
            <?php echo nl2br(htmlspecialchars($article['Text'])); ?>
        </p>
    </div>
    <footer style="background-color: #8ae4ff;">
        <p>Patik Sokac 13.06.2024 | Tehničko Veleučilište Zagreb | Home</p>
    </footer>
</body>
</html>
