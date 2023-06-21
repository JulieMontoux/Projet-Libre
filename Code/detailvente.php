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
  </style>
</head>
<body>
  <?php include('navbar.php');?>
  <h1>Détail de la Vente</h1>

  <table class="sale-details-table">
    <thead>
      <tr>
        <th>Fruit</th>
        <th>Quantité vendue (kg)</th>
      </tr>
    </thead>
    <tbody id="detail-vente-body"></tbody>
  </table>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Récupérer les détails du panier depuis le stockage local
      var basketItems = JSON.parse(localStorage.getItem('basketItems'));

      // Vérifier si des articles sont présents dans le panier
      if (basketItems && basketItems.length > 0) {
        // Obtenir les fruits uniques dans le panier
        var uniqueFruits = [...new Set(basketItems.map(item => item.fruit))];

        // Fonction pour générer le tableau des détails de la vente
        function generateTable() {
          // Générer les lignes du tableau pour chaque fruit
          var tableRows = '';
          uniqueFruits.forEach(function(fruit) {
            var fruitItems = basketItems.filter(item => item.fruit === fruit);
            var totalQuantity = fruitItems.reduce((acc, item) => acc + item.quantity, 0);
            tableRows += '<tr>';
            tableRows += '<td>' + fruit + '</td>';
            tableRows += '<td>' + totalQuantity.toFixed(2) + 'kg</td>'; // Modifier cette ligne
            tableRows += '</tr>';
          });

          $('#detail-vente-body').html(tableRows);
        }

        // Générer le tableau des détails de la vente
        generateTable();
      }
    });
  </script>
</body>
</html>
