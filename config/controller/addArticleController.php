<?php
require_once "../model/dbConnect.php";
require_once "../model/article.php";

// Constantes
define('TARGET', '../../../frontend/src/assets/img/articleImg/');    // Repertoire cible
define('MAX_SIZE', 100000);    // Taille max en octets du fichier
// Tableaux de donnees
$tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
$infosImg = array();
$nomImage;

if (isset($_POST['addArticle'])) {
    $article = new article();
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_FILES['image']['name']) && !empty($_POST['content']) && !empty($_POST['date']) && !empty($_POST['description'])) {
        $title = htmlspecialchars($_POST['title']);
        $author = htmlspecialchars($_POST['author']);
        $content = htmlspecialchars($_POST['content']);
        $date = htmlspecialchars($_POST['date']);
        $description = htmlspecialchars($_POST['description']);

        $extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $tabExt)) {
            $infosImg = getimagesize($_FILES['image']['tmp_name']);
            if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                if (isset($_FILES['image']['error']) && UPLOAD_ERR_OK === $_FILES['image']['error']) {
                    $nomImage = md5(uniqid()) . '.' . $extension;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], TARGET . $nomImage)) {
                        $image = $nomImage;
                    } else {
                        $message = 'Problème lors de l\'upload !';
                    }
                } else {
                    $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                }
            } else {
                $message = 'Le fichier à uploader n\'est pas une image !';
            }
        } else {
            $message = 'L\'extension du fichier est incorrecte !';
        }

        $article->title = $title;
        $article->author = $author;
        $article->content = $content;
        $article->date = $date;
        $article->description = $description;
        $article->image = $image;
        if ($article->addArticle()) {
            $error = "success";
        } else {
            $error = 'Une erreur s\'est produite, ressayer plus tard.';
        }
    } else {
        $error = 'Remplir tout les champs';
    }
}
