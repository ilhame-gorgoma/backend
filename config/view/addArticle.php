<?php
require_once '../controller/addArticleController.php';
?>
<html>
<?php if (isset($error)) { ?>
    <div>
        <p><?= $error; ?></p>
    </div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="title">
    <input type="text" name="author">
    <input type="text" name="description">
    <textarea name="content" cols="30" rows="10"></textarea>
    <input type="date" name="date">
    <input type="file" name="image" id="image">
    <input type="submit" value="Validez" name="addArticle">
</form>

</html>