<!DOCTYPE html>
<html>

<head>
  <title>Historique des Ventes</title>
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

    th,
    td {
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
  <?php include('navbar.php'); ?>
  <h1>Historique des Ventes</h1>
  <table class="sale-details-table">
    <thead>
      <tr>
        <th>Produit</th>
        <th>Variété</th>
        <th>Quantité vendue</th>
        <th>Prix</th>
      </tr>
    </thead>
    <tbody id="detail-vente-body"></tbody>
    <tfoot>
      <tr>
        <th colspan="3">Total de la journée</th>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      var basketItems = JSON.parse(localStorage.getItem('basketItems'));
      console.log(basketItems);

      // Vérifier si des articles sont présents dans le panier
      if (basketItems && basketItems.length > 0) {
        // Obtenir les variétés uniques dans le panier
        var uniqueVarieties = [...new Set(basketItems.map(item => item.variety))];

        // Fonction pour générer le tableau des détails de la vente
        function generateTable() {
          // Générer les lignes du tableau pour chaque variété
          var tableRows = '';
          var total = 0;
          uniqueVarieties.forEach(function(variety) {
            var varietyItems = basketItems.filter(item => item.variety === variety);
            var totalQuantity = varietyItems.reduce((acc, item) => item.quantity, 0);
            var price = Number(varietyItems[0].price);
            var totalPrice = price;
            tableRows += '<tr>';
            tableRows += '<td>' + varietyItems[0].fruit + ' </td>';
            tableRows += '<td>' + variety + ' </td>';
            tableRows += '<td>' + totalQuantity + ' </td>';
            tableRows += '<td>' + price.toFixed(2) + '€ </td></n>';
            tableRows += '</tr>';
            total += totalPrice;
          });

          $('#detail-vente-body').html(tableRows);
          $('#total-price').text(total.toFixed(2) + '€');
        }

        // Générer le tableau des détails de la vente
        generateTable();

        // Gérer le clic sur le bouton de réinitialisation de la journée
        $('.reset-button button').click(function() {
          // Réinitialiser les détails de la vente
          basketItems = [];
          // Mettre à jour le panier dans le local storage
          localStorage.setItem('basketItems', JSON.stringify(basketItems));

          // Vider le tableau des détails de vente
          $('#detail-vente-body').empty();
          $('#total-price').text('');
          // Rafraîchir la page
          location.reload();
        });

        // Gérer le clic sur le bouton "Nouvelle journée"
        $('.new-day-button button').click(function() {
          // Vider le tableau des détails de vente
          $('#detail-vente-body').empty();
          $('#total-price').text('');

          // Réinitialiser les détails de la vente
          basketItems = [];
          // Mettre à jour le panier dans le local storage
          localStorage.setItem('basketItems', JSON.stringify(basketItems));

          // Générer le tableau des détails de la vente
          generateTable();

          // Afficher un message de succès
          $('.error-message').text('La journée a été réinitialisée avec succès.');
        });

        // Gérer le clic sur le bouton "Sauvegarder en PDF"
        $('.save-pdf-button button').click(function() {
          var pdfContent = $('<table>').append($('.sale-details-table').find('tbody').clone()); // Créer un tableau contenant uniquement les lignes du tableau des détails de vente
          var pdfFileName = 'vente.pdf';

          // Personnaliser l'apparence du PDF
          pdfContent.css('border', '10px solid #ddd');
          pdfContent.find('th').css('background-color', '#f2f2f2');

          // Convertir le contenu PDF en format PDF
          html2pdf().set({
            margin: 10,
            filename: pdfFileName,
            image: {
              type: 'jpeg',
              quality: 0.98
            },
            html2canvas: {
              scale: 2
            },
            jsPDF: {
              unit: 'mm',
              format: 'a4',
              orientation: 'portrait'
            }
          }).from(pdfContent.html()).save();
        });
      }
    });
  </script>
</body>

</html>