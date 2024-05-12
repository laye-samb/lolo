<?php
include ('classe.php');

$prenom = $nom = $adresse = $numeroTelephone = "";
$prenomErr = $nomErr = $adresseErr = $numeroTelephoneErr = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["prenom"])) {
        $prenomErr = "Le prénom est requis.";
    } else {
        $prenom = test_input($_POST["prenom"]);
    }
    
    if (empty($_POST["nom"])) {
        $nomErr = "Le nom est requis.";
    } else {
        $nom = test_input($_POST["nom"]);
    }
    
    if (empty($_POST["adresse"])) {
        $adresseErr = "L'adresse est requise.";
    } else {
        $adresse = test_input($_POST["adresse"]);
    }
    
    if (empty($_POST["numeroTelephone"])) {
        $numeroTelephoneErr = "Le numéro de téléphone est requis.";
    } else {
        $numeroTelephone = test_input($_POST["numeroTelephone"]);
    }
    
    if (empty($prenomErr) && empty($nomErr) && empty($adresseErr) && empty($numeroTelephoneErr)) {
        $nouveauClient = new Client($prenom, $nom, $adresse, $numeroTelephone);
        $successMessage = "Le compte a été créé avec succès!";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Création de compte</title>
</head>
<body>
    <h1>Création de compte</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom">
        <span class="error"><?php echo $prenomErr; ?></span><br>
        
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom">
        <span class="error"><?php echo $nomErr; ?></span><br>
        
        <label for="adresse">Adresse :</label><br>
        <input type="text" id="adresse" name="adresse">
        <span class="error"><?php echo $adresseErr; ?></span><br>
        
        <label for="numeroTelephone">Numéro de téléphone :</label><br>
        <input type="text" id="numeroTelephone" name="numeroTelephone">
        <span class="error"><?php echo $numeroTelephoneErr; ?></span><br><br>
        
        <input type="submit" value="Créer le compte">
    </form>
    
    <div>
        <?php 
        if (!empty($successMessage)) {
            echo "<p>" . $successMessage . "</p>";
        }
        ?>
    </div>
</body>
</html>