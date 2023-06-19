<!DOCTYPE html>
<html>
<head>
  <title>Vente de Fruits</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    h1 {
      margin: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .fruit-list {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 20px;
    }

    .fruit-item {
      background-color: #f4f4f4;
      padding: 20px;
      text-align: center;
      cursor: pointer;
    }

    .fruit-name {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .fruit-price {
      font-size: 16px;
      color: #888;
    }

    .varieties-list {
      list-style-type: none;
      padding: 0;
      margin-top: 10px;
      display: none;
    }

    .variety-item {
      margin-bottom: 5px;
    }

    #cart {
      margin-top: 20px;
      border: 1px solid #ccc;
      padding: 10px;
    }

    #cart ul {
      list-style-type: none;
      padding: 0;
    }

    #cart li {
      margin-bottom: 5px;
    }

    #cart-total {
      margin-top: 10px;
      font-weight: bold;
    }

    #payment-methods {
      margin-top: 20px;
    }

    #payment-methods label {
      margin-right: 10px;
    }

    .item-count {
      margin-left: 10px;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <header>
    <h1>Vente de Fruits</h1>
  </header>
  <div class="container">
    <div class="fruit-list">
      <div class="fruit-item" onclick="showVarieties('pomme')">
        <h2 class="fruit-name">Pomme</h2>
        <p class="fruit-price">$1.99/kg</p>
        <ul class="varieties-list" id="pomme-varieties">
          <li class="variety-item" onclick="addToCart('Pomme', 'Variété 1', 1.99)">Variété 1</li>
          <li class="variety-item" onclick="addToCart('Pomme', 'Variété 2', 1.99)">Variété 2</li>
          <li class="variety-item" onclick="addToCart('Pomme', 'Variété 3', 1.99)">Variété 3</li>
        </ul>
      </div>
      <div class="fruit-item" onclick="showVarieties('banane')">
        <h2 class="fruit-name">Banane</h2>
        <p class="fruit-price">$0.99/kg</p>
        <ul class="varieties-list" id="banane-varieties">
          <li class="variety-item" onclick="addToCart('Banane', 'Variété 1', 0.99)">Variété 1</li>
          <li class="variety-item" onclick="addToCart('Banane', 'Variété 2', 0.99)">Variété 2</li>
        </ul>
      </div>
      <div class="fruit-item" onclick="showVarieties('orange')">
        <h2 class="fruit-name">Orange</h2>
        <p class="fruit-price">$2.49/kg</p>
        <ul class="varieties-list" id="orange-varieties">
          <li class="variety-item" onclick="addToCart('Orange', 'Variété 1', 2.49)">Variété 1</li>
          <li class="variety-item" onclick="addToCart('Orange', 'Variété 2', 2.49)">Variété 2</li>
          <li class="variety-item" onclick="addToCart('Orange', 'Variété 3', 2.49)">Variété 3</li>
          <li class="variety-item" onclick="addToCart('Orange', 'Variété 4', 2.49)">Variété 4</li>
        </ul>
      </div>
      <!-- Ajoutez d'autres fruits ici -->
    </div>
    <div id="cart">
      <h2>Panier</h2>
      <ul id="cart-items"></ul>
      <div id="cart-total"></div>
      <div id="payment-methods">
        <label>
          <input type="radio" name="payment" value="carte" checked> Carte
        </label>
        <label>
          <input type="radio" name="payment" value="especes"> Espèces
        </label>
        <label>
          <input type="radio" name="payment" value="cheque"> Chèque
</label>
</div>
<button onclick="validateCart()">Valider le panier</button>
</div>
  </div>

  <script>
    var cartItems = {}; // Utilisation d'un objet pour stocker les éléments du panier

    function showVarieties(fruit) {
      var varietiesList = document.getElementById(fruit + '-varieties');
      if (varietiesList.style.display === 'none') {
        varietiesList.style.display = 'block';
      } else {
        varietiesList.style.display = 'none';
      }
    }

    function addToCart(fruit, variety, price) {
      var cartItemsList = document.getElementById('cart-items');
      var itemKey = fruit + '-' + variety;
      
      if (cartItems[itemKey]) {
        // Si l'élément existe déjà dans le panier, incrémente le compteur
        cartItems[itemKey].count++;
        cartItems[itemKey].element.querySelector('.item-count').textContent = '(' + cartItems[itemKey].count + ')';
      } else {
        // Si c'est la première fois que l'élément est ajouté au panier, crée un nouvel élément
        var newItem = document.createElement('li');
        newItem.textContent = fruit + ' - ' + variety;
        var itemCount = document.createElement('span');
        itemCount.classList.add('item-count');
        itemCount.textContent = '(1)';
        newItem.appendChild(itemCount);
        cartItemsList.appendChild(newItem);
        
        cartItems[itemKey] = {
          count: 1,
          element: newItem
        };
      }
      
      updateTotal(price);
    }

    function updateTotal(price) {
      var cartTotal = document.getElementById('cart-total');
      var total = 0;
      
      for (var itemKey in cartItems) {
        total += price * cartItems[itemKey].count;
      }
      
      cartTotal.textContent = 'Total: $' + total.toFixed(2);
    }

  function validateCart() {
    // Récupérer les informations du panier
    var cartItems = document.getElementById('cart-items').children;
    var paymentMethod = document.querySelector('input[name="payment"]:checked').value;
    var total = parseFloat(document.getElementById('cart-total').textContent.replace('Total: $', ''));

    // Construire l'objet contenant les informations du panier
    var salesData = {
      items: {},
      paymentMethod: paymentMethod,
      total: total
    };

    // Parcourir les éléments du panier et enregistrer les détails des ventes
    for (var i = 0; i < cartItems.length; i++) {
      var itemText = cartItems[i].textContent;
      var itemName = itemText.substring(0, itemText.indexOf('-')).trim();
      var itemVariety = itemText.substring(itemText.indexOf('-') + 1).trim();

      if (!salesData.items[itemName]) {
        salesData.items[itemName] = {};
      }

      if (!salesData.items[itemName][itemVariety]) {
        salesData.items[itemName][itemVariety] = 1;
      } else {
        salesData.items[itemName][itemVariety]++;
      }
    }

    // Enregistrer les détails des ventes dans le stockage local (ou toute autre méthode de votre choix)
    localStorage.setItem('salesData', JSON.stringify(salesData));

    // Naviguer vers la page de détails des ventes
    window.location.href = 'detailvente.html';
  }

  </script>
</body>
</html>
