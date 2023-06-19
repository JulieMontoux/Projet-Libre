<!DOCTYPE html>
<html>
<head>
  <title>Vente de Fruits</title>
  <meta charset="utf-8">
  <style>
    /* CSS pour la mise en page */
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
    }

    .fruit-list {
      display: flex;
      justify-content: center;
    }

    .fruit-list li {
      margin: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      cursor: pointer;
    }

    .basket {
      text-align: center;
      margin-top: 20px;
    }

    .basket h2 {
      margin-bottom: 10px;
    }

    .payment-method {
      margin-top: 20px;
      text-align: center;
    }

    .payment-method label {
      margin-right: 10px;
    }

    .total-price {
      text-align: center;
      margin-top: 20px;
    }

    .checkout-button {
      text-align: center;
      margin-top: 20px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Initialiser les données de vente dans le stockage local
      var salesData = localStorage.getItem('salesData');
      if (!salesData) {
        salesData = {
          items: {},
          total: 0,
          paymentMethod: ''
        };
        localStorage.setItem('salesData', JSON.stringify(salesData));
      } else {
        salesData = JSON.parse(salesData);
      }

      // Mettre à jour le panier
      function updateBasket() {
        var basket = $('.basket');
        basket.empty();

        for (var fruit in salesData.items) {
          var fruitItem = salesData.items[fruit];

          var itemHtml = '<h3>' + fruit + '</h3>';

          for (var variety in fruitItem) {
            var quantity = fruitItem[variety];
            itemHtml += '<p>' + variety + ': ' + quantity + '</p>';
          }

          basket.append(itemHtml);
        }
      }

      // Mettre à jour le prix total
      function updateTotalPrice() {
        var totalPrice = $('.total-price');
        totalPrice.text('Prix total: $' + salesData.total.toFixed(2));
      }

      // Mettre à jour le mode de paiement
      function updatePaymentMethod(paymentMethod) {
        salesData.paymentMethod = paymentMethod;
      }

      // Mettre à jour le stockage local
      function updateLocalStorage() {
        localStorage.setItem('salesData', JSON.stringify(salesData));
      }

      // Gérer le clic sur un fruit
      $('.fruit-list li').click(function() {
        var fruit = $(this).data('fruit');
        var variety = $(this).data('variety');

        if (!salesData.items[fruit]) {
          salesData.items[fruit] = {};
        }

        if (!salesData.items[fruit][variety]) {
          salesData.items[fruit][variety] = 1;
        } else {
          salesData.items[fruit][variety]++;
        }

        salesData.total += 1;

        updateBasket();
        updateTotalPrice();
        updateLocalStorage();
      });

      // Gérer le choix du mode de paiement
      $('.payment-method input').change(function() {
        var paymentMethod = $(this).val();
        updatePaymentMethod(paymentMethod);
        updateLocalStorage();
      });

      // Gérer la validation du panier
      $('.checkout-button button').click(function() {
        if (salesData.total === 0) {
          alert('Votre panier est vide. Veuillez ajouter des fruits avant de valider.');
          return;
        }

        // Ajouter les ventes dans l'historique
        var salesHistory = localStorage.getItem('salesHistory');
        if (!salesHistory) {
          salesHistory = [];
        } else {
          salesHistory = JSON.parse(salesHistory);
        }

        salesHistory.push(salesData);
        localStorage.setItem('salesHistory', JSON.stringify(salesHistory));

        // Effacer les données du panier
        salesData = {
          items: {},
          total: 0,
          paymentMethod: ''
        };
        localStorage.setItem('salesData', JSON.stringify(salesData));

        // Rediriger vers la page des détails des ventes
        window.location.href = 'detailvente.html';
      });

      // Initialiser l'affichage
      updateBasket();
      updateTotalPrice();
    });
  </script>
</head>
<body>
  <h1>Vente de Fruits</h1>

  <ul class="fruit-list">
    <li data-fruit="Banane" data-variety="Cavendish">Banane (Cavendish)</li>
    <li data-fruit="Banane" data-variety="Plantain">Banane (Plantain)</li>
    <li data-fruit="Pomme" data-variety="Golden">Pomme (Golden)</li>
    <li data-fruit="Pomme" data-variety="Granny Smith">Pomme (Granny Smith)</li>
    <li data-fruit="Orange" data-variety="Valencia">Orange (Valencia)</li>
    <li data-fruit="Orange" data-variety="Navel">Orange (Navel)</li>
  </ul>

  <div class="basket">
    <h2>Panier :</h2>
  </div>

  <div class="payment-method">
    <label for="card">Carte</label>
    <input type="radio" name="payment" id="card" value="Carte">

    <label for="cash">Espèces</label>
    <input type="radio" name="payment" id="cash" value="Espèces">

    <label for="cheque">Chèque</label>
    <input type="radio" name="payment" id="cheque" value="Chèque">
  </div>

  <div class="total-price">
    Prix total: $0.00
  </div>

  <div class="checkout-button">
    <button>Valider le panier</button>
  </div>
</body>
</html>
