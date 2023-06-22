<!DOCTYPE html>
<html>
<head>
  <title>Détail de la Vente</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    /* CSS pour la mise en page */
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
    }

    table {
      margin: 20px auto;
      border-collapse: collapse;
      width: 80%;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .reset-button {
      text-align: center;
      margin-top: 20px;
      margin-right: 10px;
    }

    .reset-button button {
      background-color: red;
      color: #ffffff;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .reset-button button:hover {
      background-color: #F78181;
    }

    .save-pdf-button {
      text-align: center;
      margin-top: 20px;
      margin-left: 10px;
    }

    .save-pdf-button button {
      background-color: #0056b3;
      color: #ffffff;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .save-pdf-button button:hover {
      background-color: #58ACFA;
    }

  </style>
</head>
<body>
  <?php include('navbar.php');?>
  <h1>Détail de la Vente</h1>

  <table class="sale-details-table">
    <thead>
      <tr>
        <th>Variété</th>
        <th>Quantité vendue</th>
        <th>Prix</th>
      </tr>
    </thead>
    <tbody id="detail-vente-body"></tbody>
    <tfoot>
      <tr>
        <th>Total</th>
        <th></th>
        <th id="total-price"></th>
      </tr>
    </tfoot>
  </table>
  <div class="d-flex justify-content-center">
    <div class="reset-button">
      <button type="button" class="btn btn-secondary">Nouvelle journée</button>
    </div>
    <div class="save-pdf-button">
      <button type="button" class="btn btn-secondary">Télécharger</button>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Récupérer les détails du panier depuis le stockage local
      var basketItems = JSON.parse(localStorage.getItem('basketItems'));

      // Vérifier si des articles sont présents dans le panier
      if (basketItems && basketItems.length > 0) {
        // Obtenir les variétés uniques dans le panier
        var uniqueVarieties = [...new Set(basketItems.map(item => item.variety))];

        // Fonction pour générer le tableau des détails de la vente
        function generateTable() {
          // Générer les lignes du tableau pour chaque variété
          var tableRows = '';
          var totalPrice = 0;
          uniqueVarieties.forEach(function(variety) {
            var varietyItems = basketItems.filter(item => item.variety === variety);
            var totalQuantity = varietyItems.reduce((acc, item) => acc + item.quantity, 0);
            var price = varietyItems[0].price; // Récupérer le prix du premier élément de la variété
            var totalPriceForVariety = price * totalQuantity;
            tableRows += '<tr>';
            tableRows += '<td>' + variety + '</td>';
            tableRows += '<td>' + totalQuantity + '</td>';
            tableRows += '<td>' + price.toFixed(2) + '€</td>'; // Formater le prix avec deux décimales
            tableRows += '</tr>';
            totalPrice += totalPriceForVariety;
          });

          $('#detail-vente-body').html(tableRows);
          $('#total-price').text(totalPrice.toFixed(2) + '€');
        }

        // Générer le tableau des détails de la vente
        generateTable();
      }

      // Gérer le clic sur le bouton de réinitialisation du panier
      $('.reset-button').click(function() {
        // Réinitialiser le panier
        $('.basket ul').empty();
        updateTotalPrice(); // Mettre à jour le prix total

        // Afficher un message de succès
        $('.error-message').text('Le panier a été réinitialisé avec succès.');
      });

      // Gérer le clic sur le bouton "Nouvelle journée"
      $('.reset-button button').click(function() {
        // Réinitialiser le panier
        localStorage.removeItem('basketItems');
        $('#detail-vente-body').empty();
        $('#total-price').text('');

        // Afficher un message de succès
        $('.error-message').text('La journée a été réinitialisée avec succès.');
      });

      // Gérer le clic sur le bouton "Sauvegarder en PDF"
      $('.save-pdf-button').click(function() {
        var pdfContent = $('.sale-details-table').clone(); // Cloner le tableau des détails de la vente
        var pdfFileName = 'vente.pdf';

        // Supprimer les boutons de réinitialisation et de sauvegarde PDF du contenu PDF
        pdfContent.find('.reset-button').remove();
        pdfContent.find('.save-pdf-button').remove();

        // Convertir le contenu PDF en format PDF
        html2pdf().from(pdfContent.html()).save(pdfFileName);
      });
    });
  </script>
</body>
</html>
