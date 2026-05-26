<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $club = $_POST['club'];

    $sql = "INSERT INTO users (full_name, email, password, club)
            VALUES ('$full_name', '$email', '$password', '$club')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.html?success=1");
        exit();
    } else {
        echo "SQL ERROR: " . $conn->error;
    }

} else {
    echo "Invalid Request";
}

?>