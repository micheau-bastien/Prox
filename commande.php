<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <?php include("php/head.php"); ?>
   <body>
     <?php
       include("php/header.php");
       include("php/menu_user.php");
       include("php/menu_mobile_user.php");
     ?>
     <div id="titre">Commande</div>
     <div id="content">
       <center>
    <?php
    if (isset($_SESSION['usr']) AND isset($_SESSION['mdp']))
    {
      $mdp = $_SESSION['mdp'];
      $usr = $_SESSION['usr'];
      $host_ldap = "srv-ldap1.insa-toulouse.fr";
      $ds = ldap_connect($host_ldap) or die("Impossible de se connecter a LDAP");
      $basedn = "ou=People,dc=insa-toulouse,dc=fr";
      $dn = "uid=$usr, ".$basedn;

      $r = @ldap_bind($ds,$dn,$mdp);
      if($r != FALSE)
      {
        try
        {
          $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
        }
        catch (Exception $e)
        {
          die('erreur : '. $e->getMessage());
        }
          echo "<br><br>Pour commander, remplis ce formulaire : <br><br> Tu veux combien de :<br>"
          ?>
          <form action="validation.php" method="POST">
          <table id="table_com">
            <?php
              $prod= $bdd->query('SELECT * from produits');
              while ($un_prod = $prod->fetch())
              {
                echo "<tr class='tr_c'><td class='td_c'><br>";
                echo $un_prod['nom'];
                echo "s </td><td class='td_c'> (";
                echo $un_prod['prix'];
                echo "€)</td><td class='td_c'>";
                ?>
                <select name="<?php echo $un_prod['nom']; ?>">
                  <?php
                  for ($n = 0; $n <= 10; $n++)
                  {
                    ?>
                    <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                    <?php
                  }
                  ?>
                </select>
                </td></tr>
                <?php
              }
            ?>
              <tr class="tr_c"><td class="td_c"><br><br>Pour quand veux-tu commander ?</td><td class="td_c">
                <select name="date" id="sel_com">
                  <?php

                  $rep = $bdd->query('SELECT * from date');
                  while ($donnees = $rep->fetch())
                  {
                    $date = date("Y-m-d");
                    if ($date <= $donnees['bloque'])
                    {
                      ?>
                        <option value="<?php echo $donnees['dates']; ?>"> <?php echo $donnees['dates']; ?> </option>
                      <?php
                    }
                  }

                  ?>
                </select>
              </td>
            </tr>
          </table>
          <br>
          <p id="rappel">
            Me rappeler ma commande par mail  :
            <select name="rappel">
              <option value="o">Oui</option>
              <option value="n">Non</option>
            </select>
          </p>
          <br><br><br><center><input type="submit" value="Je commande"></center>
          </form><br><br>
          <p align="justify" id="expl">Si vous le voulez, l'équipe du proximo peut vous envoyer un mail sur votre adresse etud peu de temps avant la commande pour être certain de vous souvenir de quand aller chercher et payer votre commande</p>
          <script>
            $('#expl').hide();
            $('#rappel').mouseover(function(){
              $('#expl').fadeIn();
              $('submit').mouseover(function(){
                $('#expl').fadeOut();
              });
            });
          </script>
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
    </div>
    <?php include("php/footer.php"); ?>
  </body>
</html>
