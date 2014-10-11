<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <?php include("php/head.php"); ?>
   <body>
     <?php
       include("php/header.php");
       include("php/menu_admin.php");
       include("php/menu_mobile_admin.php");
     ?>
     <div id="titre">Historique</div>
     <div id="content">
      <center><br>
      <?php
      if (isset($_SESSION['usr']) AND $_SESSION['usr']=="admin" AND isset($_SESSION['mdp']) AND $_SESSION['mdp'] == "pierre")
      {
        try
        {
          $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
        }
        catch (Exception $e)
        {
          die('erreur : '. $e->getMessage());
        }
            $nb_tot_flu =0;
            $nb_tot_bag =0;
              $req = $bdd->query('SELECT * from commandes');
              ?>
              <br><br>
              <table>
                <tr>
                  <th>User</th>
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
                </tr>
                <?php
              $req = $bdd->query('SELECT * from commandes');
              while ($rep = $req->fetch())
              {
                $roq = $bdd->query('SELECT * FROM produits');
                ?>
                <tr>
                  <td><?php echo $rep['usr']; ?></td>
                  <td><?php echo $rep['date']; ?></td>
                  <?php
                  while ($prod = $roq->fetch())
                  {
                    ?>
                    <td><?php echo $rep[$prod['nom']]; ?></td>
                    <?php
                    $nom = "nb_".$prod['nom'];
                    ${$nom} = ${$nom} + $rep[$prod['nom']];
                  }
                  ?>
                </tr>
                <?php
              }
              ?>
            </table>
            <?php
            $roq = $bdd->query('SELECT * FROM produits');
              echo " <br>Il y a : ";
              while ($prod = $roq->fetch())
              {
                $nom = "nb_".$prod['nom'];
                echo ${$nom};
                echo " ";
                echo $prod['nom'];
                echo ", ";
              }
              echo " et pis c'est tout.<br><br>";
              $req->closeCursor();
      }
      else
      {
        echo "Erreur, veuillez vous reconnecter en cliquant sur ProxiPain en haut de l'écran";
      }
      ?>
      <?php include("php/footer.php"); ?>
    </div>
  </body>
</html>
