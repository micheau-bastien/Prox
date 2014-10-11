<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <?php include("php/head.php"); ?>
  <body>
    <?php
      include("php/header.php");
      include("php/menu_user.php");
      include("php/menu_mobile_user.php");
    ?>
    <div id="titre">Contact</div>
    <div id="content">
      <?php
        if (isset($_POST['titre']) AND isset($_POST['message'])) {
          $headers ='From: "'.$_SESSION['usr'].'"<'.$_SESSION['usr'].'@etud.insa-toulouse.fr>'."\n";
          $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
          $headers .='Content-Transfer-Encoding: 8bit';
          $dest = "micheau@etud.insa-toulouse.fr";
          $sujet = $_POST['titre'];
          $message = $_POST['message'];
          echo "Le message a bien été transmis. Bonne journée et merci de votre retour.";
          mail("micheau@etud.insa-toulouse.fr", $_POST['titre'], $_POST['message'], $headers);
        } else {
      ?>
      <p><pre>    </pre>Si vous voulez nous contacter, pour signaler un problème au Proximo, sur le Site ou donner des idées d'améliorations possibles. N'hésitez pas à remplir le formulaire ci-dessous : </p> <br>
      <form action="contact.php" method="POST">
        <input type="text" name="titre" placeholder="Sujet" id="sujet" /> <br><br>
        <textarea name="message" rows="12" cols="70" placeholder="Message" id="message" required/></textarea><br>
        <input type="submit" value="Envoyer">
      </form>
      <?php } ?>
    </div>
    <script>
      $(document).reday(function(){
        $('#content').hide();
        $('#message').hide();
        $('#sujet').hide();
        $('#content').slideDown(function(){
          $('#sujet').fadeIn(function(){
            $('#message').fadeIn();
          });
        });
      });
    </script>
    <?php include("php/footer.php"); ?>
  </body>
</html>
