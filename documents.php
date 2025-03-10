<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $stmt = $conn->prepare("INSERT INTO documents (titre) VALUES (?)");
    $stmt->execute([$titre]);
}

$documents = $conn->query("SELECT * FROM documents")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Gestion des documents</h1>
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Titre du document</label>
                <input type="text" class="form-control" name="titre" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <h2>Liste des documents</h2>
        <ul class="list-group">
            <?php foreach ($documents as $document): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($document["titre"]) ?>
                    <div>
                        <a href="edit.php?table=documents&id=<?= $document['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete.php?table=documents&id=<?= $document['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')">Supprimer</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>