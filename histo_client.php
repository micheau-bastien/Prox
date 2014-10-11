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
     <div id="titre">Historique</div>
     <div id="content">
        <br><br><br>
      <?php
      if (isset($_SESSION['usr']) AND isset($_SESSION['mdp']))
      {
        $usr = $_SESSION['usr'];
        $mdp = $_SESSION['mdp'];
        $host_ldap = "srv-ldap1.insa-toulouse.fr";
        $ds = ldap_connect($host_ldap) or die("Impossible de se connecter a LDAP");

        $basedn = "ou=People,dc=insa-toulouse,dc=fr";
        $dn = "uid=$usr, ".$basedn;

        $r = @ldap_bind($ds,$dn,$mdp);
        if($r != FALSE)
        {
          echo "<center>Voici l'historique de tes commandes : <br><br>";
          try
          {
            $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
          }
          catch (Exception $e)
          {
                  die('Erreur : ' . $e->getMessage());
          }
          ?>
          <table id="table_h">
            <tr>
              <th>Date</th>
              <?php
              $req = $bdd->query('SELECT * FROM produits');
              while ($rep = $req->fetch())
              {
                ?>
                  <th>Nombre de <?php echo $rep['nom']; ?>s</th>
                <?php
              }
              ?>
              <th>Total</th>
            </tr>
            <?php
          $n = 0;
          $req = $bdd->query("SELECT * from commandes WHERE usr='".$usr."'");
          while ($rep = $req->fetch())
          {
          $n = $n+1;
            $roq = $bdd->query('SELECT * FROM produits');
            ?>
            <tr>
              <td><?php echo $rep['date']; ?></td>
              <?php
              while ($prod = $roq->fetch())
              {
                ?>
                <td><?php echo $rep[$prod['nom']]; ?></td>
                <?php
              }
              ?>
              <td><?php echo $rep['total']; ?></td>
            </tr>
            <?php
          }
                  if ($n == 0)
          {
          ?>
            <script>
              var tbl = document.getElementById('table_h');
              tbl.style.display = 'none';
            </script>
            Il n'y a pas de commandes pour toi ! Passes en donc une !
          <?php
          }
          ?>
        </table><br><br>
        <?php
        }
        else
        {
          echo "Erreur, veuillez vous reconnecter en cliquant sur ProxiPain en haut de l'écran.";
        }
      }
      else
      {
        echo "Erreur, veuillez vous reconnecter en cliquant sur ProxiPain en haut.";
      }
      ?>
      <?php include("php/footer.php"); ?>
    </div>
  </body>
</html>
