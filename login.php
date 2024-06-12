<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = mysqli_connect('localhost', 'root', '', 'seminar') or die('Error connecting to MySQL server: ' . mysqli_connect_error());
    
    $sql = sprintf("SELECT * FROM users WHERE Email = '%s'", $mysqli->real_escape_string($_POST["Email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
           
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["Email"] = $user["Email"];
            
            header("Location: index-log.php");
            exit;
        }else {
            echo "Unijeli ste pogrešno lozinku.";
        }
    }
    else {
        echo "Unijeli ste pogrešno korisničko";
    }
    
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
</head>
<body>
    <header style="background-color: #8ae4ff;">
        <div class="header-flex">
            <img src="slike/logo.png" alt="Logo">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="signup.php">Registriraj se</a></li>
                    <li><a href="#" style="color: #fff;">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="conteiner">
            <form action="" name="prijava" method="post">
                <label for="Email">Email:</label>
                <input type="text" name="Email" id="Email"/>
                <br>
                <label for="password">Lozinka:</label>
                <input type="password" name="password" id="password"/>
                <br><br>
                <button type="submit">Prijava</button>
        </form>
    </div>
    
    <footer style="background-color: #8ae4ff;">
        <p>Patik Sokac 13.06.2024 | Tehničko Veleučilište Zagreb | Home</p>
    </footer>
</body>
</html>
