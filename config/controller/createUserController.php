<?php
require_once "../model/dbConnect.php";
require_once "../model/user.php";

$regexPseudo = '#^[\w.-]{5,65}$#';

if (isset($_POST['inputSubmit'])) {
    $userCreate = new user();
    if (!empty($_POST['inputUsername']) && !empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {
        $pseudoCreateUser = htmlspecialchars($_POST['inputUsername']);
        $pseudoCreateUserLenght = strlen($pseudoCreateUser);
        if ($pseudoCreateUserLenght <= 65 && preg_match($regexPseudo, $pseudoCreateUser)) {
            $userCreate->username = $pseudoCreateUser;
            $pseudoUnique = $userCreate->pseudoUnique();
            if ($pseudoUnique == 0) {
                $mailCreateUser = htmlspecialchars($_POST['inputEmail']);
                if (filter_var($mailCreateUser, FILTER_VALIDATE_EMAIL)) {
                    $userCreate->email = $mailCreateUser;
                    $mailUnique = $userCreate->mailUnique();
                    if ($mailUnique == 0) {
                        $passwordCreateUser = password_hash($_POST['inputPassword'], PASSWORD_BCRYPT);
                        $userCreate->password = $passwordCreateUser;
                        if ($userCreate->addUser()) {
                            $erreur = 'success';
                        } else {
                            $erreur = 'Une erreur s\'est produite, veuillez ressayer dans quelques instant';
                        }
                    } else {
                        $erreur = 'L\'adresse mail est indisponible!';
                    }
                } else {
                    $erreur = 'Vérifier adresse mail!';
                }
            } else {
                $erreur = 'Pseudo déjà utilisé!';
            }
        } else {
            $erreur = 'Pseudo incorrect!';
        }
    } else {
        $erreur = 'Tous les champs doivent être remplis!';
    }
}
