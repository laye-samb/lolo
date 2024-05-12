<?php

class Client {
    public $prenom;
    public $nom;
    public $adresse;
    public $numeroTelephone;
    
    public function __construct($prenom, $nom, $adresse, $numeroTelephone) {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->numeroTelephone = $numeroTelephone;
    }
}

class CompteBancaire {
    public $numeroCompte;
    public $solde;
    public $proprietaire;
    
    public function __construct($numeroCompte, $solde, $proprietaire) {
        $this->numeroCompte = $numeroCompte;
        $this->solde = $solde;
        $this->proprietaire = $proprietaire;
    }
}

class OperationBancaire {
    public function depot($compte, $montant) {
        $compte->solde += $montant;
    }
    
    public function retrait($compte, $montant) {
        if ($montant <= $compte->solde) {
            $compte->solde -= $montant;
        } else {
            echo "Solde insuffisant.";
        }
    }
    
    public function virement($compteSource, $compteDestination, $montant) {
        if ($montant <= $compteSource->solde) {
            $this->retrait($compteSource, $montant);
            $this->depot($compteDestination, $montant);
        } else {
            echo "Solde insuffisant.";
        }
    }
}

?>