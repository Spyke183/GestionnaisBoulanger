<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Vérifiez si l’ID de contact existe, par exemple update.php? id=1 obtiendra le contact avec l’ID de 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Cette partie est similaire au create.php, mais à la place nous mettons à jour un enregistrement et ne pas insérer
        $type = isset($_POST['type']) ? $_POST['type'] : '';

        // mettre à jour l'enregistrement
        $stmt = $pdo->prepare('UPDATE categorie SET type = ? WHERE id = ?');
        $stmt->execute([ $type, $_GET['id']]);
        $msg = 'mis à jour avec succès!';
    }
    // Obtenir le categorie à partir de la table de categorie
    $stmt = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$produit) {
        exit('Le produit n’existe pas avec cet ID !');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

  <!-- Conteneur principal -->
  <div id="mainContainer">
    <div class="form">
      <!-- Contenu principal -->
      <main class="main-content">
        <!-- En-tête -->
        <h2 class="heading">
          <div>Mettre à jour le produit #<?=$produit['id']?></div>
        </h2>
     
            <form action="update_categorie.php?id=<?=$produit['id']?>" method="post">
       <!-- Contenu -->
       <div class="content">
            <!-- Ajout de produit -->
            <div id="addProductForm" class="product-form">
              <!-- Nom et type-->
              <div class="input-row">
                <div class="input-group">
                  <label for="type">Catégorie</label>
                  <select name="type" id="type" required>
                    <option value="Choisir une catégorie">Choisir Catégorie</option>
                    <option value="Pain">Pain</option>
                    <option value="Vienoiserie">Vienoiserie</option>
                  </select>
                </div>
         </div>
              <input  type="submit" value="Motifier" class="validate-button">
              <!-- <button class="validate-button">Valider</button> -->
            </form>









    <?php if ($msg): ?>
    <h5><?=$msg?></h5>
    <?php endif; ?>
</div>

<?=template_footer()?>