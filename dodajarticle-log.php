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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Naslov = $_POST['Naslov'];
    $Uvod = $_POST['Uvod'];
    $Text = $_POST['Text'];
    $mysqli = mysqli_connect('localhost', 'root', '', 'seminar') or die('Error connecting to MySQL server: ' . mysqli_connect_error());
 
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = file_get_contents($image);

        $query = "INSERT INTO article (Naslov, Uvod, Slika, Text, user_email) VALUES(?,?,?,?,?)";
        $statement = $mysqli->prepare($query);
        $statement->bind_param('sssss',
                    $Naslov,
                    $Uvod,
                    $imgContent,
                    $Text,
                    $email);

        if ($statement->execute()) {
            echo "Image uploaded successfully.";
        } else {
            echo "Image upload failed, please try again.";
        }
        } else {
        echo "Please select an image file to upload.";
        }

    $mysqli->close();
    header("Location: index-log.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodavanje articla</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header style="background-color: #8ae4ff;">
        <div class="header-flex">
            <img src="slike/logo.png" alt="Logo">
            <nav>
                <ul>
                    <li><a href="index-log.php" >My articles</a></li>
                    <li><a href="#" style="color: #fff;">Dodaj article</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="conteiner">
    <form method="post" enctype="multipart/form-data">
        
        <label for="Naslov">Naslov:</label>
        <input type="text" name="Naslov" id="Naslov" required>
        
        <label for="Uvod">Uvod articla:</label>
        <textarea name="Uvod" id="Uvod" rows="5" cols="81"></textarea><br><br>
        
        <label for="image">Slika za article:</label>
        <input type="file" id="image" name="image">

        <label for="Text">Text articla:</label>
        <textarea name="Text" id="Text" rows="5" cols="81"></textarea><br><br>
        
        <button type="submit" name="create_article">Create Article</button>
    </form>
        
    </div>
    <footer style="background-color: #8ae4ff;">
        <p>Patik Sokac 13.06.2024 | Tehničko Veleučilište Zagreb | Home</p>
    </footer>
</body>
</html>