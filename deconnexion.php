<?php
  session_start();
  session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <?php include("php/head.php"); ?>
  <body>
    <?php
      include("php/header.php");
    ?>
    <div id="titre">Deconnexion</div>
    <div id="content">
      <br><br><br><br>
      <p>Vous avec bien été déconnecté du site. Pour vous reconnecter, cliquez <a href="index.php">ici</a>.</p>
    </div>
    <?php include("php/footer.php"); ?>
  </body>
</html>
