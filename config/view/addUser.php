<?php
require_once '../controller/createUserController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter utilisateur</title>
</head>

<body>
    <form action="" method="post">

        <?php if (isset($erreur)) { ?>
            <div>
                <p><?= $erreur; ?></p>
            </div>
        <?php } ?>
        <input type="text" name="inputUsername" id="inputUsername" placeholder="Pseudo" autofocus>

        <input type="email" name="inputEmail" id="inputEmail" placeholder="E-mail" autofocus>

        <input type="password" name="inputPassword" id="inputPassword" placeholder="Mot de Passe">

        <input type="submit" name="inputSubmit" value="Ajouter">
    </form>
</body>

</html>