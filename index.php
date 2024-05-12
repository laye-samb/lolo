<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }

        .button {
            display: block;
            width: 200px;
            padding: 10px 20px;
            margin: 10px auto;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="gestion_compte.php" class="button">Gestion des Comptes</a>
        <a href="creation_compte.php" class="button">Créer un Compte</a>
        <a href="releve_compte.php" class="button">Relevé de Compte</a>
    </div>
</body>
</html>