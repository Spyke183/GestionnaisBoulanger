<?php
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>

<div class="content">
	<h2>Toto</h2>
	<div class="content read">
	<a href="create_produit" class="create-contact" >Ajouter un produit</a>
  <div class="row">
   
      <div class="col-4 mb-5">
        <div class="card" style="width: 18rem;">
          <!-- <img src="./images/<?= $item['image'] ?>" width="150px" height="200px" class="card-img-top" alt="..."> -->
          <div class="card-body">
            <center>
              <h5 class="card-title"></h5>
              <p class="text"></p>
              <p class="card-text"></p>
              <p class="card-text"></p>
              <p class="card-text"></p>
              
              <a href="view.php?id=" class="btn btn-success">view</a> 
            </center>
            
          </div>
        </div>
      </div>
 
  </div>
</div>
</div>
<?=template_footer()?>