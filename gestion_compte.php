<?php
require ('classe.php');
require_once ('config.php');
$pdo = new PDO($dsn, $username, $password);

$comptes = [];

$stmt = $pdo->query("SELECT * FROM CompteBancaire");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $proprietaire = new Client($row['prenom'], $row['nom'], $row['adresse'], $row['telephone']);
    $compte = new CompteBancaire($row['numero_compte'], $row['solde'], $proprietaire);
    $comptes[] = $compte;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroCompte = $_POST["numeroCompte"];
    $montant = $_POST["montant"];
    $typeOperation = $_POST["typeOperation"];
    
    $compte = null;
    foreach ($comptes as $c) {
        if ($c->getNumero() == $numeroCompte) {
            $compte = $c;
            break;
        }
    }
    
    if ($compte) {
        if ($typeOperation == "depot") {
            $operationBancaire = new OperationBancaire();
            $operationBancaire->depot($compte, $montant);
        } elseif ($typeOperation == "retrait") {
            $operationBancaire = new OperationBancaire();
            $operationBancaire->retrait($compte, $montant);
        }
    } else {
        $errorMessage = "Compte non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des comptes</title>
    <link rel="stylesheet" type="text/css" href="style\1.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des comptes</h1>
        
        <div>
            <h2>Liste des comptes bancaires</h2>
            <table>
                <tr>
                    <th>Numéro de compte</th>
                    <th>Solde</th>
                    <th>Propriétaire</th>
                </tr>
                <?php
                foreach ($comptes as $compte) {
                    echo "<tr>";
                    echo "<td>" . $compte->getNumero() . "</td>";
                    echo "<td>" . $compte->getSolde() . "</td>";
                    echo "<td>" . $compte->getProprietaire()->getNom() . ' ' . $compte->getProprietaire()->getPrenom() . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        
        <div>
            <h2>Effectuer une opération</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="numeroCompte">Numéro de compte :</label>
                <input type="text" id="numeroCompte" name="numeroCompte"><br>
                
                <label for="montant">Montant :</label>
                <input type="text" id="montant" name="montant"><br>
                
                <label for="typeOperation">Type d'opération :</label>
                <select id="typeOperation" name="typeOperation">
                    <option value="depot">Dépôt</option>
                    <option value="retrait">Retrait</option>
                </select><br>
                
                <input type="submit" value="Valider">
            </form>
        </div>
        
        <div>
            <p><?php echo $errorMessage ?? ''; ?></p>
        </div>
    </div>
</body>
</html>