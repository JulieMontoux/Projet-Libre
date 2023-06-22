<!DOCTYPE html>
<html>

<head>
  <title>Vente de Fruits</title>
  <meta charset="utf-8">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
  <style>
    /* CSS pour la mise en page */
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      text-align: center;
    }

    .fruit-list {
      display: flex;
      justify-content: center;
    }

    .fruit-card {
      margin: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      cursor: pointer;
      text-align: center;
      border-radius: 10px;
    }

    .fruit-card img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 10px;
    }

    .varieties {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 10px;
    }

    .variety-card {
      margin: 5px;
      padding: 5px;
      border: 1px solid #ccc;
      cursor: pointer;
      text-align: center;
      border-radius: 10px;
    }

    .variety-card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
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

    .payment-method .btn-group {
      margin-bottom: 10px;
    }

    .total-price {
      text-align: center;
      margin-top: 20px;
    }

    .checkout-button {
      text-align: center;
      margin-top: 20px;
    }

    .checkout-button {
      text-align: center;
      margin-top: 20px;
      margin-left: 10px;
    }

    .checkout-button button {
      background-color: #0056b3;
      color: #ffffff;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .checkout-button button:hover {
      background-color: #58ACFA;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Récupérer les fruits, les variétés, les prix et les images depuis la base de données
      var fruits = [{
          name: "Pommes",
          varieties: ["Golden", "Granny", "Reinette", "Royal Gala", "Chantecler", "Braeburn", "Fuji", "Pink Lady"],
          prices: [3.3, 2.7, 3.6, 2.9, 3.1, 2.9, 3.3, 4.8],
          images: ["../images/golden.jpg", "../images/granny_smith.jpg", "../images/reinette.jpg", "../images/royal_gala.jpg", "../images/chantecler.jpg", "../images/braeburn.jpg", "../images/fuji.jpg", "../images/pink_lady.jpg"]
        },
        {
          name: "Poires",
          varieties: ["Williams"],
          prices: [3.4],
          images: ["../images/williams.jpg"]
        },
        {
          name: "Cerises",
          varieties: ["Burlat", "Summit", "Bigalise", "Régina"],
          prices: [11.65, 8, 15.6, 7.8],
          images: ["../images/burlat.jpg", "../images/summit.jpg", "../images/bigalise.jpg", "../images/regina.jpg"]
        },
        {
          name: "Kiwis",
          varieties: ["Hayward"],
          prices: [2.1],
          images: ["../images/hayward.jpg"]
        },
        {
          name: "Autres",
          varieties: ["Confiture", "Jus plat", "Jus pétillant"],
          prices: [3.90, 2.5, 3],
          images: ["../images/confiture.jpg", "../images/jus_plat.jpg", "../images/jus_petillant.jpg"]
        }
      ];

      var saleDetails = [];

      // Générer la liste de fruits avec les variétés et les images
      var fruitList = $('.fruit-list');
      fruits.forEach(function(fruit) {
        var fruitHtml = '<div class="fruit-card rounded">';
        fruitHtml += '<img src="' + fruit.images[0] + '" alt="' + fruit.name + '" class="rounded">';
        fruitHtml += '<h4>' + fruit.name + '</h4>';
        fruitHtml += '</div>';

        fruitList.append(fruitHtml);
      });

      // Gérer le clic sur un fruit
      $('.fruit-card').click(function() {
        var selectedFruit = $(this).find('h4').text();
        var selectedVarieties = fruits.find(function(fruit) {
          return fruit.name === selectedFruit;
        }).varieties;

        // Générer la liste des variétés pour le fruit sélectionné
        var varietyList = '<div class="varieties">';
        selectedVarieties.forEach(function(variety, index) {
          varietyList += '<div class="variety-card rounded">';
          varietyList += '<img src="' + fruits.find(function(fruit) {
            return fruit.name === selectedFruit;
          }).images[index] + '" alt="' + variety + '" class="rounded">';
          varietyList += '<h5>' + variety + '</h5>';
          varietyList += '</div>';
        });
        varietyList += '</div>';

        // Afficher les variétés pour le fruit sélectionné
        $(this).siblings('.varieties').remove();
        $(this).after(varietyList);

        // Gérer le clic sur une variété
        $('.variety-card').click(function() {
          var selectedVariety = $(this).find('h5').text();
          var selectedQuantity = prompt('Quantité vendue :');

          // Vérifier si la quantité saisie est un nombre valide
          if (selectedQuantity !== null && selectedQuantity !== "" && !isNaN(selectedQuantity)) {
            selectedQuantity = parseFloat(selectedQuantity);
            var selectedPrice = fruits.find(function(fruit) {
              return fruit.name === selectedFruit;
            }).prices[selectedVarieties.indexOf(selectedVariety)];
            var totalPrice = selectedPrice * selectedQuantity;

            addToBasket(selectedFruit, selectedVariety, selectedQuantity, totalPrice);
            updateTotalPrice();
          }
        });
      });

      // Fonction pour ajouter un fruit au panier
      function addToBasket(fruit, variety, quantity, price) {
        var basketItem = '<li>' + fruit + ' (' + variety + ') - ' + quantity.toString() + 'kg - ' + price.toFixed(2) + '€</li>';
        $('.basket ul').append(basketItem);
        updateTotalPrice(); // Appel de la fonction pour mettre à jour le prix total
        addToSaleDetails(fruit, variety, quantity, price); // Ajouter les détails de vente
        // Ajouter les détails de vente au tableau saleDetails
        addToSaleDetails(fruit, variety, quantity, price);

        // Mettre à jour le panier dans le local storage
        localStorage.setItem('basketItems', JSON.stringify(saleDetails));
      }

      // Fonction pour mettre à jour le prix total
      function updateTotalPrice() {
        var total = 0;
        var basketItems = [];

        $('.basket ul li').each(function() {
          var quantity = parseFloat($(this).text().split(' - ')[1].split('kg')[0]);
          var price = parseFloat($(this).text().split(' - ')[2].split('€')[0]);

          if (!isNaN(quantity) && !isNaN(price)) {
            total += price;

            var item = {
              fruit: $(this).text().split(' (')[0],
              variety: $(this).text().split(' (')[1].split(') -')[0],
              quantity: quantity,
              price: price.toFixed(2)
            };

            basketItems.push(item);
          }
        });

        $('.total-price span').text(total.toFixed(2));

        // Sauvegarder les détails du panier dans le stockage local
        var historique = [];
        historique.push(localStorage.setItem('basketItems', JSON.stringify(basketItems)));
      }

      // Gérer la sélection de la méthode de paiement
      $('.payment-method button').click(function() {
        $('.payment-method button').removeClass('active');
        $(this).addClass('active');
      });

      // Gérer le clic sur le bouton de validation du panier
      $('.checkout-button button').click(function() {
        var paymentMethod = $('.payment-method button.active').text();
        var totalPrice = parseFloat($('.total-price span').text());
        if (totalPrice !== 0) {
          if (paymentMethod === "") {
            $('.error-message').text('Veuillez choisir une méthode de paiement.');
          } else {
            // Ajouter le code de redirection vers la page "detailvente" ici
            window.location.href = 'index.php';
          }
        } else {
          $('.error-message').text('Le panier est vide.');
        }
      });

      // Mettre à jour le tableau des détails de vente
      function updateSaleDetailsTable() {
        var tableBody = $('#detail-vente-body');
        tableBody.empty();

        saleDetails.forEach(function(detail) {
          var newRow = '<tr>';
          newRow += '<td>' + detail.fruit + '</td>';
          newRow += '<td>' + detail.variety + '</td>';
          newRow += '<td>' + detail.quantity + '</td>';
          newRow += '<td>' + detail.price + '€</td>';
          newRow += '</tr>';

          tableBody.prepend(newRow);
        });
      }

      // Ajouter les détails de vente à la liste
      function addToSaleDetails(fruit, variety, quantity, price) {
        var detail = {
          fruit: fruit,
          variety: variety,
          quantity: quantity,
          price: price.toFixed(2)
        };

        saleDetails.push(detail);
        updateSaleDetailsTable();
      }
    });
  </script>
</head>

<body>
  <?php include('navbar.php'); ?>
  <h2>Vente de Fruits</h2>

  <div class="fruit-list"></div>

  <div class="basket">
    <h3>Panier</h3>
    <ul></ul>
  </div>

  <div class="payment-method">
    <h5>Méthode de paiement :</h5>
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-secondary">Carte de crédit</button>
      <button type="button" class="btn btn-secondary">Espèces</button>
      <button type="button" class="btn btn-secondary">Chèque</button>
    </div>
  </div>

  <div class="total-price">
    <h5>Prix total : <span>0.00</span>€</h5>
  </div>

  <div class="checkout-button">
    <button type="button" class="btn btn-primary">Valider le panier</button>
  </div>

  <div class="error-message"></div>
</body>

</html>