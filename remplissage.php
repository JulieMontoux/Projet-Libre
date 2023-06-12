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
<?php
include("config.php");
session_start();
?>
<!-- formulaire entrées produits -->
<h4 class="text-center">Vous êtes sur la page de remise à niveau du stock.</h4>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Choisissez le type de produit</label>
        <select class="form-select" aria-label="Default select example" name="type">
            <option selected>Type de produit</option>
            <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='" . $row['idType'] . "'>'" . $row['NomType'] . "'</option>";
            }
            ?>     
        </select>
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Choisissez la variéte</label>
        <select class="form-select" aria-label="Default select example" name="variete">
            <option selected>Variété</option>
            <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='" . $row['idVariete'] . "'>'" . $row['NomVariete'] . "'</option>";
            }
            ?> 
        </select>
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Choisissez le poids</label>
        <select class="form-select" aria-label="Default select example" name="poids">
            <option selected>Poids</option>
            <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='" . $row['idPoids'] . "'>'" . $row['Poids'] . "'</option>";
            }
            ?> 
        </select>
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Choisissez la quantité</label>
        <select class="form-select" aria-label="Default select example" name="quantite">
            <option selected>Quantité</option>
            <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='" . $row['idQuantite'] . "'>'" . $row['Nombre'] . "'</option>";
            }
            ?> 
        </select>
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Choisissez le prix</label>
        <select class="form-select" aria-label="Default select example" name="prix">
            <option selected>Prix</option>
            <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='" . $row['idPrix'] . "'>'" . $row['Prix'] . "'</option>";
            }
            ?> 
        </select>
      </div>
    </div>
  </div>
  <div class="d-grid gap-2 col-6 mx-auto">
    <button class="btn btn-primary" type="button">Envoyer</button>
  </div>

</div>
</body>
</html>