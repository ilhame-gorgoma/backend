<?php
require_once "config/model/dbConnect.php";
require_once "config/model/user.php";

if (isset($_POST['connect'])) {
    $userConnect = new user();
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $username = htmlentities($_POST['username']);
            $password = $_POST['password'];
            $userConnect->username = $username;
            $result = $userConnect->connectUser();
            if ($result && password_verify($password, $result->password)) {
                session_start();
                $_SESSION['id_role'] = $result->id_role;
                $_SESSION['id'] = $result->id;
                header('location: index.php');
            } else {
                $error = 'Mauvais identifiant ou mot de passe.';
            }
        } else {
            $error = 'Remplir mot de passe';
        }
    } else {
        $error = 'Remplir username';
    }
}
