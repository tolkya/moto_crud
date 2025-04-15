<?php
session_start();
require_once '../appel/pdo.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$is_edit = false;
$moto = [
    'id' => '',
    'Modele' => '',
    'Edition' => '',
    'Annee' => '',
    'Image' => '',
    'Couleur' => '',
    'Categorie' => '',
    'Cylindree' => '',
    'Chevaux' => '',
    'Description' => '',
    'Utilite' => ''
];

// ---- MODE ÉDITION ----
if (isset($_GET['moto_id'])) {
    $is_edit = true;
    $stmt = $pdo->prepare("SELECT * FROM motos WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['moto_id'], $user_id]);
    $moto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$moto) {
        echo "Moto introuvable.";
        exit();
    }
}

// ---- TRAITEMENT DU FORMULAIRE ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modele = $_POST['Modele'] ?? '';
    $edition = $_POST['Edition'] ?? '';
    $annee = $_POST['Annee'] ?? 0;
    $couleur = $_POST['Couleur'] ?? '';
    $categorie = $_POST['Categorie'] ?? '';
    $cylindree = $_POST['Cylindree'] ?? 0;
    $chevaux = $_POST['Chevaux'] ?? 0;
    $description = $_POST['Description'] ?? '';
    $utilite = $_POST['Utilite'] ?? '';
    $image_name = $moto['Image'] ?? '';

    if (!empty($_FILES['Image']['name'])) {
        $image_name = basename($_FILES['Image']['name']);
        $target_path = "../uploads/" . $image_name;
        move_uploaded_file($_FILES['Image']['tmp_name'], $target_path);
    }

    if ($is_edit) {
        $stmt = $pdo->prepare("UPDATE motos SET Modele=?, Edition=?, Annee=?, Couleur=?, Categorie=?, Cylindree=?, Chevaux=?, Description=?, Utilite=?, Image=? WHERE id=? AND user_id=?");
        $stmt->execute([$modele, $edition, $annee, $couleur, $categorie, $cylindree, $chevaux, $description, $utilite, $image_name, $_POST['moto_id'], $user_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO motos (user_id, Modele, Edition, Annee, Couleur, Categorie, Cylindree, Chevaux, Description, Utilite, Image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $modele, $edition, $annee, $couleur, $categorie, $cylindree, $chevaux, $description, $utilite, $image_name]);
    }

    header("Location: dashboard.php");
    exit();
}
?>

<html>
<head>
    <title><?= $is_edit ? 'Modifier' : 'Ajouter' ?> une Moto</title>
    <link rel="stylesheet" href="../assets/css/addedit.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>
    <?php include '../header/header.php'; ?>
    <h2><?= $is_edit ? 'Modifier votre moto' : 'Ajouter une moto' ?></h2>

    <form method="POST" enctype="multipart/form-data">
        <?php if ($is_edit): ?>
            <input type="hidden" name="moto_id" value="<?= htmlspecialchars($moto['id']) ?>">
        <?php endif; ?>

        <label>Modèle :</label>
        <input type="text" name="Modele" value="<?= htmlspecialchars($moto['Modele']) ?>" required><br>

        <label>Édition :</label>
        <input type="text" name="Edition" value="<?= htmlspecialchars($moto['Edition']) ?>"><br>

        <label>Année :</label>
        <input type="number" name="Annee" value="<?= htmlspecialchars($moto['Annee']) ?>" min="1900" max="<?= date('Y') ?>"><br>

        <label>Couleur :</label>
        <input type="text" name="Couleur" value="<?= htmlspecialchars($moto['Couleur']) ?>"><br>

        <label>Catégorie :</label>
        <select name="Categorie">
            <?php
            $categories = ["Adventure", "Cross", "Cruiser", "Enduro", "Roadster", "Routiere", "Sportive", "Supermotard", "Trail"];
            foreach ($categories as $cat) {
                $selected = ($moto['Categorie'] === $cat) ? 'selected' : '';
                echo "<option value=\"$cat\" $selected>$cat</option>";
            }
            ?>
            <option value="" <?= ($moto['Categorie'] === '') ? 'selected' : '' ?>>-- autre --</option>
        </select><br>

        <label>Cylindrée :</label>
        <input type="number" name="Cylindree" value="<?= htmlspecialchars($moto['Cylindree']) ?>" min="50" max="3000"> CC<br>

        <label>Chevaux :</label>
        <input type="number" name="Chevaux" value="<?= htmlspecialchars($moto['Chevaux']) ?>" min="5" max="450"> Ch<br>

        <label>Description :</label>
        <textarea name="Description"><?= htmlspecialchars($moto['Description']) ?></textarea><br>

        <label>Utilité :</label>
        <textarea name="Utilite"><?= htmlspecialchars($moto['Utilite']) ?></textarea><br>

        <?php if ($is_edit && $moto['Image']): ?>
            <p>Image actuelle :</p>
            <img src="../uploads/<?= htmlspecialchars($moto['Image']) ?>" width="150"><br>
        <?php endif; ?>

        <label>Nouvelle Image :</label>
        <input type="file" name="Image"><br><br>

        <button type="submit"><?= $is_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
        <a href="dashboard.php"><button type="button">Retour</button></a>
    </form>
</body>
</html>
