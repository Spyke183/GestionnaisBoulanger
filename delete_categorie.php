<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Vérifier que le code de produi$produit existe
if (isset($_GET['id'])) {
    // Sélectionnez l’enregistrement qui sera supprimé.
    $stmt = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$produit) {
        exit('Le produit n’existe pas avec cet ID !');
    }
    // S’assurer que l’utilisateur confirme la suppression
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // L’utilisateur a cliqué sur le bouton « Oui », supprimer l’enregistrement.
            $stmt = $pdo->prepare('DELETE FROM categorie WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Vous avez supprimé le produit !';
            
            //code qui permet  envoi sur la page read.php
            header('location:read_categorie.php');

        } else {
            // L’utilisateur a cliqué sur le bouton "Non", rediriger vers la page de lecture
            header('Location: read_categorie.php');
            exit;
        }
    }
} else {
    exit('Aucune pièce d’identité indiquée!');
}


?>



<?=template_header('Delete')?>

<div class="content delete">
	<h2>Supprimer le numéro #<?=$produit['id']?></h2>
    <?php if ($msg): ?>
    <p class ="textsupp"><?=$msg?></p>
    <?php else: ?>
	<p class ="textsuppe">Êtes-vous sûr de vouloir supprimer le produit #<?=$produit['id']?>?</p>
    <div class="yesno">
        <a href="delete_categorie.php?id=<?=$produit['id']?>&confirm=yes">Oui</a>
        <a href="delete_categorie.php?id=<?=$produit['id']?>&confirm=no">Non</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>