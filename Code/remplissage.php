<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>Page de remplissage</title>
</head>
<body>
  <?php include('navbar.php') ?>
  <h4 class="text-center">Vous etes sur la page de remplissage du produit.</h4>
  <div class="container">
    <div class="row">
      <div class="col">
        <!-- select -->
        <form action="remplissage.php" method="post">
          <div class="mb-3">
            <label for="typeSelect" class="form-label">Type de produit</label>
            <select class="form-select" aria-label="Default select example" name="typeSelect" id="typeSelect">
              <option selected>Selectionnez le type de produit</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="varieteSelect" class="form-label">Variete</label>
            <select class="form-select" aria-label="Default select example" name="varieteSelect" id="varieteSelect">
              <option selected>Selectionnez d'abord un type de produit</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="poidsSelect" class="form-label">Poids</label>
            <select class="form-select" aria-label="Default select example" name="poidsSelect" id="poidsSelect">
              <option selected>Selectionnez le poids</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="quantiteSelect" class="form-label">Quantite</label>
            <select class="form-select" aria-label="Default select example" name="quantiteSelect" id="quantiteSelect">
              <option selected>Selectionnez la quantite</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="prixSelect" class="form-label">Prix</label>
            <select class="form-select" aria-label="Default select example" name="prixSelect" id="prixSelect">
              <option selected>Selectionnez le prix</option>
            </select>
          </div>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button type="button" class="btn btn-primary" id="insertButton">Inserer les donnees</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="config.js">
    // Récupération des références aux selects
    const typeSelect = document.getElementById('typeSelect');
    const varieteSelect = document.getElementById('varieteSelect');
    const poidsSelect = document.getElementById('poidsSelect');
    const prixSelect = document.getElementById('prixSelect');

    // Récupération des types de produit depuis la base de données
    executeQuery("SELECT * FROM type", (error, results) => {
      if (error) {
        console.error('Erreur lors de la récupération des types de produit :', error);
        return;
      }

      // Parcours des résultats et création des options du select type
      results.forEach(row => {
        const option = document.createElement('option');
        option.value = row.idType;
        option.textContent = row.nomT;
        typeSelect.appendChild(option);
      });
    });

    // Gestionnaire d'événement pour la sélection du type de produit
    typeSelect.addEventListener('change', (event) => {
      const selectedTypeId = event.target.value;
      
      // Nettoyer les options du select variété
      varieteSelect.innerHTML = '<option selected disabled>Sélectionnez d\'abord un type de produit</option>';

      if (selectedTypeId) {
        // Récupérer les variétés correspondant au type sélectionné depuis la base de données
        const query = "SELECT idVariete, nomV FROM variete WHERE idType_id = " + selectedTypeId;
        executeQuery(query, (error, results) => {
          if (error) {
            console.error('Erreur lors de la récupération des variétés :', error);
            return;
          }

          // Parcours des résultats et création des options du select variété
          results.forEach(row => {
            const option = document.createElement('option');
            option.value = row.idVariete;
            option.textContent = row.nomV;
            varieteSelect.appendChild(option);
          });
        });
      }
    });

    // Récupération des quantites depuis la base de données
    executeQuery("SELECT * FROM quantite", (error, results) => {
      if (error) {
        console.error('Erreur lors de la récupération des quantites :', error);
        return;
      }

      // Parcours des résultats et création des options du select quantite
      results.forEach(row => {
        const option = document.createElement('option');
        option.value = row.idQuantite;
        option.textContent = row.nombre;
        poidsSelect.appendChild(option);
      });
    });

    // Récupération des poids depuis la base de données
    executeQuery("SELECT * FROM poids", (error, results) => {
      if (error) {
        console.error('Erreur lors de la récupération des poids :', error);
        return;
      }

      // Parcours des résultats et création des options du select poids
      results.forEach(row => {
        const option = document.createElement('option');
        option.value = row.idPoids;
        option.textContent = row.kg;
        poidsSelect.appendChild(option);
      });
    });

    // Récupération des prix depuis la base de données
    executeQuery("SELECT * FROM prix", (error, results) => {
      if (error) {
        console.error('Erreur lors de la récupération des prix :', error);
        return;
      }

      // Parcours des résultats et création des options du select prix
      results.forEach(row => {
        const option = document.createElement('option');
        option.value = row.idPrix;
        option.textContent = row.montant;
        prixSelect.appendChild(option);
      });
    });

  // Récupération de la référence au bouton
  const insertButton = document.getElementById('insertButton');

  // Gestionnaire d'événement pour le clic sur le bouton
  insertButton.addEventListener('click', () => {
    // Récupération des valeurs sélectionnées
    const typeValue = typeSelect.value;
    const varieteValue = varieteSelect.value;
    const poidsValue = poidsSelect.value;
    const prixValue = prixSelect.value;

    // Insertion des valeurs dans la table produit (remplacez les noms de colonnes par les noms réels de votre table)
    const query = 'INSERT INTO produit (id_idVariete, id_idPoids, id_idQuantite, id_idPrix) VALUES (${varieteValue}, ${poidsValue}, 0, ${prixValue})';
    executeQuery(query, (error, results) => {
      if (error) {
        console.error('Erreur lors de l\'insertion des données :', error);
        return;
      }
      console.log('Données insérées avec succès dans la table produit!');
    });
  });
</script>

</body>
</html>
