<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Vérifier si les données POST ne sont pas vides
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Paramétrer les variables qui vont être insérées, il faut vérifier si les variables POST existent sinon on peut les mettre en blanc par défaut
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Vérifier si la variable POST "name" existe, si ce n’est pas par défaut la valeur à blank, fondamentalement la même pour toutes les variables
    $type = isset($_POST['type']) ? $_POST['type'] : '';


    // Insérer un nouvel enregistrement dans le tableau des produit
    $stmt = $pdo->prepare('INSERT INTO categorie VALUES (?, ?)');
    $stmt->execute([$id, $type,]);
    // Message de sortie
    $msg = 'Créé avec succès!';
}
?>
<?=template_header('Create')?>
  <!-- Conteneur principal -->
  <div id="mainContainer">
    <div class="form">
      <!-- Contenu principal -->
      <main class="main-content">
        <!-- En-tête -->
        <div class="heading">
          <span class="material-icons"> add </span>
          Ajouter un Catégorie
        </div>
        <form action="create_categorie.php" method="post">
          <!-- Contenu -->
          <div class="content">
            <!-- Ajout de produit -->
            <div id="addProductForm" class="product-form">
              <!-- Nom et type-->
              <div class="input-row">
                <div class="input-group">

                <label for="type" >Nom Categorie</label>
                <input type="text" name="type" class="form-control">

                 
                </div>
         </div>
              <input  type="submit" value="Crée" class="validate-button">
            </form>
            
            
            <?php if ($msg): ?>
            <h5><?=$msg?></h5>
            <?php endif; ?>


</div>





<?=template_footer()?>