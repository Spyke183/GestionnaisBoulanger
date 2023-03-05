<?php

include('functions.php');
$pdo = pdo_connect_mysql();

if (isset($_POST['bouton'])) {
  $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
  $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
  // image here


  // $image = $_FILES["image"]["name"];
  // $tmpname = $_FILES["image"]["tmp_name"];
  // $place = "images/";
  //move_uploaded_file($tmpname, $place.$image);


  // Récupérer le nom et le chemin temporaire de l'image
  $image_name = $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  
  // Définir le dossier de destination pour l'image
  $destination = "images/" . $image_name;
  
  // Déplacer l'image téléchargée vers le dossier de destination
  move_uploaded_file($image_tmp_name, $destination);


//

  $description = isset($_POST['description']) ? $_POST['description'] : '';
  $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
  $prix = isset($_POST['prix']) ? $_POST['prix'] : '';


  $query = $pdo->prepare('INSERT INTO `produits`(`id`,`nom`, `image` , `description`,`prix`, `categorie_id`) VALUES (?,?,?,?,?,?)');
$query->execute([$id,$nom,$image,$description,$prix,$categorie/*,$_SESSION['user_id']*/]);

}







?>

<?= template_header('Add New Article') ?>



 <!-- Conteneur principal -->
 <div id="mainContainer">
    <div class="form">
      <!-- Contenu principal -->
      <main class="main-content">
        <!-- En-tête -->
        <div class="heading">
          <span class="material-icons"> add </span>
          Ajouter un produit
        </div>
        <form action="create_produit.php" method="post">
          <!-- Contenu -->
          <div class="content">
            <!-- Ajout de produit -->
            <div id="addProductForm" class="product-form">
              <!-- Nom et type-->
              <div class="input-row">
                <div class="input-group">

                  <label for="id">ID</label>
                  <input type="text" name="id" placeholder="26" value="auto" id="id"> 




                  <label for="nom">Nom du produit</label>
                  <input type="text" name="nom" placeholder="Nom du produit"  required />



                  <label for="ImportImage">Image du produit</label>
                   <input type="file" name="image"class="form-control" />

                  <!-- <label for="ImportImage" class="form-label">Image :</label>
                  <input type="file" name="image" class="form-control"> -->




                  <label for="exampleInputEmail1" class="form-label">Description</label>
                  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>




                  <label for="prix">Prix du produit</label>
                  <input type="text" name="prix" placeholder="Prix du produit" id="prix" required />

                </div>

                <div class="input-group">
                  <label for="type">Nom Categorie</label>
                    <select class="form-select" name="categorie" aria-label="Default select example">
                      <option selected>Choisir une catégorie</option>



                      <?php foreach ($categories as $produit): ?>
                      <option value="<?= $produit['id'] ?>"><?= $produit['type'] ?></option>
                      <?php endforeach; ?>


                    </select>
                </div>
              </div>
              <input  type="submit" name="bouton"value="Ajouter" class="validate-button">
          </form>
            
</div>

</body>

</html>
<?= template_footer() ?>