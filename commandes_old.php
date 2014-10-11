<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway">
     <link rel="stylesheet" href="css/style.css"/>
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
     <title> ProxiPain </title>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <meta name="viewport" content="width=device-width, user-scalable=no"/>
     <link rel="apple-touch-icon" sizes="57x57" href="apple-touch-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="60x60" href="apple-touch-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="76x76" href="apple-touch-icon-76x76.png">
      <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96">
      <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
      <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
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
    if (isset($_POST['usr']) AND isset($_POST['mdp']))
    {
      $mdp = $_POST['mdp'];
      $usr = $_POST['usr'];
      $host_ldap = "srv-ldap1.insa-toulouse.fr";
      $ds = ldap_connect($host_ldap) or die("Impossible de se connecter a LDAP");
      $basedn = "ou=People,dc=insa-toulouse,dc=fr";
      $dn = "uid=$usr, ".$basedn;

      $r = @ldap_bind($ds,$dn,$mdp);
      if($r != FALSE)
      {
          echo "<br><br>Pour commander du pain, remplis ce formulaire : <br><br><br>"
          ?>
          <form action="validation.php" method="POST">
            Combien veux-tu de baguettes ?
            <select name="nb_bag" id="sel_com">
              <?php
              for ($n = 0; $n <= 10; $n++)
              {
                ?>
                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                <?php
              }
              ?>
            </select>
              <br><br>
              Combien veux-tu de flutes ?
              <select name="nb_flu" id="sel_com">
                <?php
                for ($n = 0 ; $n <= 10 ; $n++)
                {
                  ?>
                  <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                  <?php
                }
                ?>
              </select>
              <br><br>
              Pour quand veux-tu commander ?
              <select name="date" id="sel_com">
                <?php
                try
                {
                  $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
                }
                catch (Exception $e)
                {
                  die('erreur : '. $e->getMessage());
                }
                $rep = $bdd->query('SELECT * from date');
                while ($donnees = $rep->fetch())
                {
                  $date = date("Y-m-d");
                  echo $date;
                  if ($date <= $donnees['bloque'])
                  {
                    ?>
                      <option value="nb_<?php echo $donnees['dates']; ?>"> <?php echo $donnees['dates']; ?> </option>
                    <?php
                  }
                }

                ?>
              </select>
              <input type="hidden" name="usr" value="<?php echo $usr; ?>">
              <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
              <br><br><br><center><input type="submit" value="Je commande"></center>
          </form><br><br><br><br>
          <?php
        }
        else
        {
          echo "Erreur, veuillez vous reidentifier"; ?> <a href="index.php"> ICI </a> <?php
        }
      }
      else
      {
        echo "Erreur, veuillez vous reidentifier"; ?> <a href="index.php"> ICI </a> <?php
      }
    ?>
    <footer>
    <form action="index.php" method="POST">
      <input type="hidden" name="usr" value="<?php echo $_POST['usr']; ?>">
      <input type="hidden" name="mdp" value="<?php echo $_POST['mdp']; ?>">
      <input type="submit" value="Retour" id="Ret_Button">
    </form>
    </footer>
  </div>
</body>
</html>
