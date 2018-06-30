<?php
/**
 * Created by PhpStorm.
 * User: bernardgermain
 * Date: 17/06/2018
 * Time: 15:51
 */

require_once 'Vue/Vue.php';
require_once 'Modele/Membre.php';

class ControleurMembre
    {

    private $pseudo;
    private $mail;
    private $pass;
//    private $compte;


    public function __construct()
    {
        $this->membre = new Membre();
    }

    //affiche la page d'inscription
    public function vueMembre()  {
        session_start();
            $vue = new Vue("Membre"); // Affiche formulaire pour un nouveau membre
            $vue->generer(array(null));
    }

    //ajoute un membre
    public function enregistrerMembre($pseudo, $mail, $pass) {

        $this->membre->insertMembre($pseudo, $mail, $pass);
        header("location: index.php?action=confirmeMembre");
    }

         //affiche la page de confirmation d'inscription d'un membre
    public function vueConfirmeMembre() {

        $vue = new Vue("ConfirmeMembre");
        $vue->generer(array (null));
    }

    public function chercheMembre() { // page pour chercher un membre
        session_start();
        $vue = new Vue("AdminMembre");
        $vue->generer(array (null));
    }

    //affiche la page de modification du membre
    public function vue($idCompte) {
        session_start();
        $membre = $this->membre->getMembre($idCompte);    // Récupère les données pour modifier le membre choisi

        $vue = new Vue("ModifierMembre");
        $vue->generer(array('membre' => $membre));

    }    

    public function modifMembre($idCompte, $pseudo, $pass, $mail) { // MAJ des données du membre
        session_start();
        $this->membre->updateMembre($idCompte, $pseudo, $pass, $mail);
        $vue = new Vue("AdminMembre");
        $vue->generer(array (NULL));
    }

    public function confirmation3($idCompte) {       // Suppression du membre

        $membre = $this->membre->getMembre ($idCompte);

        $vue = new Vue("Confirmation3");
        $vue->generer(array ('membre' => $membre));
    }

    //confirme la suppression d'un compte
    public function confirmer3($idCompte) {
        session_start();

        $this->membre->confirmer3($idCompte);

        session_start();
        session_destroy();
        header("location: index.php");

    }

    //connexion a l'administration d'un membre
    public function adminMembre($pseudo, $pass) {
        session_start();
        $pseudo = htmlspecialchars($pseudo);
        $pass = htmlspecialchars($pass);

        $membre = $this->membre->getAdminMembre($pseudo, $pass);

        if (!$membre) {
            //on indique que si tout les champs ne sont pas remplis ou une erreur
            $insert_erreur = true;

        } else {

            $_SESSION['id'] = $membre;
            $_SESSION['pseudo'] = $pseudo;

            $vue = new Vue("AdminMembre");
            $vue->generer(array($_SESSION['id'], $_SESSION['pseudo']));


        }
    }

}