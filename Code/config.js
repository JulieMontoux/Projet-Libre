const mysql = require('mysql');

const config = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'vente'
};

// Création de la connexion à la base de données
const connection = mysql.createConnection(config);

// Fonction pour exécuter une requête SQL
function executeQuery(query, callback) {
  connection.query(query, (error, results) => {
    if (error) {
      console.error('Erreur lors de l\'exécution de la requête :', error);
      callback(error, null);
      return;
    }
    callback(null, results);
  });
}

module.exports = {
  connection,
  executeQuery
};
