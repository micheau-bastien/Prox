<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
     <link rel="stylesheet" href="css/style.css"/>
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
     <title> ProxiPain </title>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <meta name="viewport" content="width=device-width, user-scalable=no"/>
     <meta name="google-site-verification" content="CM0DSksnZH3cBKTWXBgIz-TPyfcMDuIyoBGaRRbHIis" />
     <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-touch-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-touch-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-touch-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-touch-icon-76x76.png">
      <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96">
      <link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16">
      <link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32">
      <meta name="msapplication-TileColor" content="#da532c">
   </head>
   <body>
    <header>
      <center>
      <form action="index.php" method="POST">
        <input type="hidden" name="usr" value="<?php echo $_POST['usr']; ?>" />
        <input type="hidden" name="mdp" value="<?php echo $_POST['mdp']; ?>" />
        <input type="submit" value="ProxiPain" id="head">
      </form>
    </center>
    </header>
<div id="content">
  <center>
    <?php
        if (isset($_POST['mdp']) AND isset($_POST['usr']))
        {
          $usr = $_POST['usr'];
          $mdp = $_POST['mdp'];
          $host_ldap = "srv-ldap1.insa-toulouse.fr";
          $ds = ldap_connect($host_ldap) or die("Impossible de se connecter a LDAP");

          $basedn = "ou=People,dc=insa-toulouse,dc=fr";
          $dn = "uid=$usr, ".$basedn;

          $r = @ldap_bind($ds,$dn,$mdp);
          if($r != FALSE)
          {
            echo "<br><br><br>Bonjour ";
            echo $usr;
            echo ", tu veux : <br><br><br>";
            ?>
            <form action="commande.php" method="POST">
              <input type="hidden" name="usr" value="<?php echo $usr; ?>">
              <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
              <input type="submit" value="Commander" id="Big_Button">
            </form>
            <form action="modif.php" method="POST">
              <input type="hidden" name="usr" value="<?php echo $usr; ?>">
              <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
              <input type="submit" value="Voir / Supprimer" id="Big_Button">
            </form>
            <form action="index.php" method="POST">
              <input type="submit" value="Se déconnecter" id="Ret_Button">
            </form>
            <?php
          }
          elseif ($usr=="admin" AND $mdp=="pierre")
          {
            echo "Bonjour Admin, tu veux : <br><br>";
            ?>
            <form action="date.php" method="POST">
              <input type="hidden" name="usr" value="<?php echo $usr; ?>">
              <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
              <input type="submit" value="Rentrer une date" id="Big_Button">
            </form>
            <form action="supp_date.php" method="POST">
              <input type="hidden" name="usr" value="<?php echo $usr; ?>">
              <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
              <input type="submit" value="Supprimer une date" id="Big_Button">
            </form>
            <form action="voir.php" method="POST">
              <input type="hidden" name="usr" value="<?php echo $usr; ?>">
              <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
              <input type="submit" value="Voir les commandes" id="Big_Button">
            </form>
            <form action="historique.php" method="POST">
              <input type="hidden" name="usr" value="<?php echo $usr; ?>">
              <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
              <input type="submit" value="Historique" id="Big_Button">
            </form>
            <form action="index.php" method="POST">
              <input type="submit" value="Se déconnecter" id="Ret_Button">
            </form></center>
            <?php
          }
          else
          {
            echo "Mauvais mot de passe désolé, veuillez reesayer : <br><br>";
            ?>
            <form action="index.php" method="POST">
              <input type="text" name="usr" />
              <input type="password" name="mdp" />
              <input type="submit" name="Valider">
            </form>
            <?php
          }
        }
        else
        {
        ?>

            <br><br><br>Bienvenue sur le site de commande de pain du proximo !
            <br><br>
            En premier veuillez vous identifier :
            <br><br>
            <form action="index.php" method="POST">
              <input type="text" name="usr" placeholder="Login"/>
              <input type="password" name="mdp" placeholder="Mot de passe"/>
              <input type="submit" value="Valider">
            </form>

        <?php
        }
?>
</div>
</body>
</html>
