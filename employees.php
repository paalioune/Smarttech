<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $stmt = $conn->prepare("INSERT INTO employees (nom, email) VALUES (?, ?)");
    $stmt->execute([$nom, $email]);
}

$employees = $conn->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Gestion des employés</h1>
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <h2>Liste des employés</h2>
        <ul class="list-group">
            <?php foreach ($employees as $employee): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($employee["nom"]) ?> - <?= htmlspecialchars($employee["email"]) ?>
                    <div>
                        <a href="edit.php?table=employees&id=<?= $employee['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete.php?table=employees&id=<?= $employee['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">Supprimer</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>