<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->execute([$email, $password]);

    header("Location: index.php");
    exit();
}
?>

<form method="POST">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Mot de passe">
    <button type="submit">S'inscrire</button>
</form>
