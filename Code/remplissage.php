<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Insertion - Vente Directe</title>
</head>
<body>
<!-- inclusion de la navbar -->
<?php include('navbar.php');?>
<!-- formulaire entrées produits -->
<h4 class="text-center">Vous êtes sur la page de remise à niveau du stock.</h4>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Choisissez le type de produit</label>
        
      </div>
    </div>
  </div>
  <div class="d-grid gap-2 col-6 mx-auto">
    <button class="btn btn-primary" type="button">Envoyer</button>
  </div>

</div>
</body>
</html>