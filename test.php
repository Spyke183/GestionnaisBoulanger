<?php
include 'functions.php';
// Se connecter à la base de données MySQL
$pdo = pdo_connect_mysql();
// Obtenir la page via la requête GET (URL param : page), si aucune n’existe par défaut la page à 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Nombre d’enregistrements à afficher sur chaque page
$records_per_page = 5;
// Préparer l’instruction SQL et obtenir des enregistrements de notre table de produits, LIMIT déterminera la page
$stmt = $pdo->prepare('SELECT * FROM produits ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Récupérez les enregistrements afin que nous puissions les afficher dans notre modèle.
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Obtenir le nombre total de produits, afin que nous puissions déterminer s’il devrait y avoir un bouton suivant et précédent
$num_produits = $pdo->query('SELECT COUNT(*) FROM produits')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<a href="create_produits.php" class="create-contact" >Ajouter Catégorie </a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Catégorie</td>
                <td>Image</td>
                <td>Description</td>
                <td>Prix</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produits): ?>
            <tr>
                <td><?=$produits['id']?></td>
                <td> <?=$produits['nom']?></td>
                <td><?=$produits['image']?></td>
                <td> <?=$produits['description']?></td>
                <td><?=$produits['prix']?></td>
            
                <td class="actions">
                    <a href="update_produits.php?id=<?=$produits['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_produits.php?id=<?=$produits['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read_produits.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_produits): ?>
		<a href="read_produits.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>


<?=template_footer()?>