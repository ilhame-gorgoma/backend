<?php
require_once 'config/controller/connectUserController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se connecter</title>
</head>

<body>
    <?php if (isset($error)) { ?>
        <div>
            <p><?= $error; ?></p>
        </div>
    <?php } ?>
    <form action="" method="post">
        <input type="text" name="username">
        <input type="text" name="password">
        <input type="submit" value="Se connecter" name="connect">
    </form>
</body>

</html>