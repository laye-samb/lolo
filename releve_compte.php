<?php
include ('config.php');

$sql = "SELECT * FROM CompteBancaire";
$stmt = $pdo->query($sql); 

if ($stmt->rowCount() > 0) {
    $comptes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $errorMessage = "Aucun compte bancaire trouvé.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedAccountId = $_POST["selectedAccount"];

    $sql = "SELECT * FROM OperationBancaire WHERE id_compte = :selectedAccountId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['selectedAccountId' => $selectedAccountId]);

    if ($stmt->rowCount() > 0) {
        $relevesCompte = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $errorMessage = "Aucun relevé de compte trouvé pour ce compte.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relevé de Compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Relevé de Compte</h1>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="selectedAccount">Sélectionnez un compte :</label>
            <select id="selectedAccount" name="selectedAccount">
                <?php
                if (!empty($comptes)) {
                    foreach ($comptes as $compte) {
                        echo "<option value='" . $compte['id_compte'] . "'>" . $compte['numero_compte'] . "</option>";
                    }
                }
                ?>
            </select>
            
            <input type="submit" class="button" value="Afficher le relevé">
        </form>

        <?php if (!empty($relevesCompte)) : ?>
            <h2>Relevé de compte pour le compte sélectionné :</h2>
            <table>
                <tr>
                    <th>ID Opération</th>
                    <th>Type d'opération</th>
                    <th>Montant</th>
                    <th>Date d'opération</th>
                </tr>
                <?php foreach ($relevesCompte as $releve) : ?>
                    <tr>
                        <td><?php echo $releve['id_operation']; ?></td>
                        <td><?php echo $releve['type_operation']; ?></td>
                        <td><?php echo $releve['montant']; ?></td>
                        <td><?php echo $releve['date_operation']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php elseif (isset($errorMessage)) : ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <a href="gestion_compte.php" class="button">Précédent</a>
    </div>
</body>
</html>