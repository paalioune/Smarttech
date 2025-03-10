<?php
require "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];

    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: dashboard.php");
    exit();
}
?>