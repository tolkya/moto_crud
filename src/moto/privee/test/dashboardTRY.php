<?php
session_start();
require_once '../appel/pdo.php';

// Redirige si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/moto.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = htmlspecialchars($_SESSION['username']);

// Récupère les motos de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM motos WHERE user_id = ?");
$stmt->execute([$user_id]);
$motos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TON GARAGE</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
    <?php include '../header/header.php'; ?>

    <main>
        <h2 class="entry">Ton garage personnel, <?php echo $username; ?> !</h2>

        <div class="actions">
            <a href="form_moto.php" class="a">➕ Ajouter une moto</a>
        </div>

        <h3>Vos Motos</h3>

        <?php if (!empty($motos)): ?>
            <div class="garage">
                <?php foreach ($motos as $moto): ?>
                    <div class="moto-card">
                        <img src="../uploads/<?php echo htmlspecialchars($moto['Image']); ?>" 
                             alt="Moto : <?php echo htmlspecialchars($moto['Modele']); ?>" 
                             width="350">

                        <h2><strong><?php echo htmlspecialchars($moto['Modele'] ?? 'Modèle inconnu'); ?></strong></h2>
                        <p><strong>Édition :</strong> <?php echo htmlspecialchars($moto['Edition'] ?? ''); ?></p>
                        <p><strong>Année :</strong> <?php echo htmlspecialchars($moto['Annee'] ?? ''); ?></p>
                        <p><strong>Couleur :</strong> <?php echo htmlspecialchars($moto['Couleur'] ?? ''); ?></p>
                        <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($moto['Categorie'] ?? ''); ?></p>
                        <p><strong>Cylindrée :</strong> <?php echo htmlspecialchars($moto['Cylindree'] ?? '0'); ?> CC</p>
                        <p><strong>Chevaux :</strong> <?php echo htmlspecialchars($moto['Chevaux'] ?? '0'); ?> ch</p>
                        <p><strong>Description :</strong><br><?php echo nl2br(htmlspecialchars($moto['Description'] ?? '')); ?></p>
                        <p><strong>Utilité :</strong> <?php echo htmlspecialchars($moto['Utilite'] ?? ''); ?></p>

                        <div class="moto-actions">
                            <!-- Bouton Modifier -->
                            <form action="form_moto.php" method="POST" style="display:inline;">
                                <input type="hidden" name="moto_id" value="<?php echo (int)$moto['id']; ?>">
                                <button type="submit">✏️ Modifier</button>
                            </form>

                            <!-- Bouton Supprimer -->
                            <form action="delete_moto.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo (int)$moto['id']; ?>">
                                <input type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette moto ?');" value="🗑️ Supprimer">
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>🚫 Vous n'avez pas encore ajouté de moto.</p>
        <?php endif; ?>
    </main>
</body>
</html>
