<?php
require "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];

    $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($table == 'clients' || $table == 'employees') {
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $stmt = $conn->prepare("UPDATE $table SET nom = ?, email = ? WHERE id = ?");
            $stmt->execute([$nom, $email, $id]);
        } elseif ($table == 'documents') {
            $titre = $_POST["titre"];
            $stmt = $conn->prepare("UPDATE $table SET titre = ? WHERE id = ?");
            $stmt->execute([$titre, $id]);
        }

        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Modifier <?= ucfirst($table) ?></h1>
        <form method="POST">
            <?php if ($table == 'clients' || $table == 'employees'): ?>
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($item['nom']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($item['email']) ?>" required>
                </div>
            <?php elseif ($table == 'documents'): ?>
                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" class="form-control" name="titre" value="<?= htmlspecialchars($item['titre']) ?>" required>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>