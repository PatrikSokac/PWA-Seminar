<?php

    $mysqli = mysqli_connect('localhost', 'root', '', 'seminar') or die('Error connecting to MySQL server: ' . mysqli_connect_error());

    $sql = "SELECT * FROM article WHERE user_email = ?";

    

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $imageData = $row['Slika'];

        echo '<div class="article">';
        echo '<img src="data:Slika/jpeg;base64,' . base64_encode($imageData) . '" alt="Uploaded Image">';
        echo '<h3>' . htmlspecialchars($row['Naslov']) . '</h3>';
        echo '<p>' . htmlspecialchars($row['Uvod']) . '</p>';
        echo '<a href="article.php?article_id=' . $row['Id'] . '">View Details</a>';
        echo '</div>';
    }

    $stmt->close();
    $mysqli->close();
?>
