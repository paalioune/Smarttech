<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

require "config.php";

try {
    $documents = $conn->query("SELECT * FROM documents")->fetchAll(PDO::FETCH_ASSOC);
    $employees = $conn->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);
    $clients = $conn->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Bienvenue sur le tableau de bord</h1>

        <h2>Documents</h2>
        <?php if (count($documents) > 0): ?>
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
        <?php else: ?>
            <p>Aucun document trouvé.</p>
        <?php endif; ?>

        <h2 class="mt-4">Employés</h2>
        <?php if (count($employees) > 0): ?>
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
        <?php else: ?>
            <p>Aucun employé trouvé.</p>
        <?php endif; ?>

        <h2 class="mt-4">Clients</h2>
        <?php if (count($clients) > 0): ?>
            <ul class="list-group">
                <?php foreach ($clients as $client): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($client["nom"]) ?> - <?= htmlspecialchars($client["email"]) ?>
                        <div>
                            <a href="edit.php?table=clients&id=<?= $client['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete.php?table=clients&id=<?= $client['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun client trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>