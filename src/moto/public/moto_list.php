<?php
// Démarre la session
session_start();

// Inclut le fichier pour la connexion à la base de données via PDO
require '../appel/pdo.php';

// Définit le nombre de motos par page
$limit = 6;

// Récupère le numéro de la page depuis POST, si il est défini et numérique, sinon par défaut 1
$page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int)$_POST['page'] : 1;

// Calcule l'offset pour la pagination (décalage des résultats)
$offset = ($page - 1) * $limit;

// Récupère les filtres envoyés en POST (catégorie, année, ordre, recherche), sinon valeurs par défaut
$categorie = isset($_POST['categorie']) ? trim($_POST['categorie']) : '';
$annee = isset($_POST['annee']) ? (int)$_POST['annee'] : 0;
$ordre = isset($_POST['ordre']) ? $_POST['ordre'] : 'id DESC';
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

// Définition des ordres autorisés pour éviter les injections SQL
$ordreAutorise = ['id DESC', 'Chevaux DESC', 'Chevaux ASC', 'Cylindree DESC', 'Cylindree ASC'];

// Si l'ordre envoyé n'est pas autorisé, on le remet à la valeur par défaut
if (!in_array($ordre, $ordreAutorise)) {
    $ordre = 'id DESC';
}

// Début de la requête SQL : sélectionne toutes les colonnes de la table motos + username de l'utilisateur associé
$sql = "SELECT SQL_CALC_FOUND_ROWS motos.*, users.username FROM motos 
        JOIN users ON motos.user_id = users.id WHERE 1=1"; // WHERE 1=1 simplifie l'ajout de conditions dynamiques

// Tableau pour stocker les paramètres à binder
$parametres = [];

// Si une catégorie est choisie, on ajoute une condition à la requête + paramètre
if (!empty($categorie)) {
    $sql .= " AND motos.Categorie = :categorie";
    $parametres[':categorie'] = $categorie;
}

// Si une année est choisie, on ajoute une condition + paramètre
if ($annee > 0) {
    $sql .= " AND motos.Annee = :annee";
    $parametres[':annee'] = $annee;
}

// Si un mot-clé est tapé, on ajoute une condition LIKE pour chercher dans le modèle
if (!empty($search)) {
    $sql .= " AND motos.Modele LIKE :search";
    $parametres[':search'] = "%$search%"; // Le % sert à chercher partout dans le modèle
}

// Ajout de l'ordre et de la pagination (LIMIT et OFFSET)
$sql .= " ORDER BY $ordre LIMIT :limit OFFSET :offset";

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Bind des valeurs LIMIT et OFFSET
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

// Bind des autres paramètres (catégorie, année, search) si présents
foreach ($parametres as $key => $value) {
    $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
}

// Exécution de la requête
$stmt->execute();

// Récupération des résultats sous forme de tableau associatif
$motos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupère le nombre total de résultats sans la limite, pour la pagination
$total = $pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

// Calcul du nombre total de pages
$totalPages = ceil($total / $limit);
?>

<!-- Affichage de la liste des motos -->
<ul>
    <?php if ($motos): ?>
        <?php foreach ($motos as $moto): ?>
            <li class="moto-card">
                <!-- Affichage du modèle et de l'année -->
                <h2><?php echo htmlspecialchars($moto['Modele']); ?> <br> <?php echo htmlspecialchars($moto['Annee']); ?></h2>
                
                <!-- Affichage du nom du propriétaire -->
                <span class="proprietaire">👤 <?php echo htmlspecialchars($moto['username']); ?></span>
                
                <!-- Lien vers les détails de la moto -->
                <a href="moto_details.php?id=<?php echo $moto['id']; ?>">
                    <img src="../uploads/<?php echo htmlspecialchars($moto['Image']); ?>" alt="Moto">
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Message si aucune moto trouvée -->
        <p>Aucune moto trouvée.</p>
    <?php endif; ?>
</ul>


<div class="pagination">
    <!-- Première Page -->
    <a href="#"
       class="pagination-link <?php echo ($page <= 1) ? 'disabled' : ''; ?>"
       data-page="1"
       <?php echo ($page <= 1) ? 'onclick="return false;"' : ''; ?>>
       Première Page
    </a>

    <!-- Précédent -->
    <a href="#"
        class="pagination-link <?php echo ($page <= 1) ? 'disabled' : ''; ?>"
        data-page="<?php echo max(1, $page - 1); ?>"
        <?php echo ($page <= 1) ? 'onclick="return false;"' : ''; ?>>
        Précédent
    </a>


    <?php
    $pagesToShow = 2;

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == 1 || $i == $totalPages || ($i >= $page - $pagesToShow && $i <= $page + $pagesToShow)) {
            if ($i == $page) {
                echo "<strong class='active'>$i</strong> ";
            } else {
                echo "<a href='#' class='pagination-link' data-page='$i'>$i</a> ";
            }
        } elseif ($i == 2 && $page > $pagesToShow + 2) {
            echo "<span>...</span> ";
        } elseif ($i == $totalPages - 1 && $page < $totalPages - $pagesToShow - 1) {
            echo "<span>...</span> ";
        }
    }
    ?>

    <!-- Suivant -->
    <a href="#"
        class="pagination-link <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>"
        data-page="<?php echo min($totalPages, $page + 1); ?>"
        <?php echo ($page >= $totalPages) ? 'onclick="return false;"' : ''; ?>>
        Suivant
    </a>


    <!-- Dernière Page -->
    <a href="#"
       class="pagination-link <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>"
       data-page="<?php echo $totalPages; ?>"
       <?php echo ($page >= $totalPages) ? 'onclick="return false;"' : ''; ?>>
       Dernière Page
    </a>
</div>
