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
      <div id="titre">Supprimer Produits</div>
    <div id="content">
      <br><br><br>
      <?php
      if (isset($_SESSION['usr']) AND $_SESSION['usr']=="admin" AND isset($_SESSION['mdp']) AND $_SESSION['mdp'] == "pierre")
      {
          echo "<center>Voici les produits : <br><br>/!\ Supprimer un produit supprimera toutes les données des clients concernant ce produit ! <br><br>";
          try
          {
            $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
          }
          catch (Exception $e)
          {
                  die('Erreur : ' . $e->getMessage());
          }
          if (isset($_POST['supp']))
          {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $bdd->exec("DELETE FROM produits WHERE id='".$id."' ");
            $bdd->exec("ALTER TABLE `commandes` DROP `".$nom."` ");
          }
          elseif (isset($_POST['mod']))
          {
            if (isset($_POST['new_prix']))
            {
              $bdd->exec('UPDATE produits SET prix=\''.$_POST['new_prix'].'\' WHERE id=\''.$_POST['id'].'\' ');
              echo "Modifié pour ";
              echo $_POST['new_prix'];
              echo ". <br><br>";
          }
            else
            {
              echo "Quel est le nouveau prix voulu ? ";
              ?>
              <form action="supp_produit.php" method="POST">
                <input type="number" step="any" name="new_prix" placeholder="Nouveau prix" />
                <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
                <input type="hidden" name="nom" value="<?php echo $_POST['nom']; ?>">
                <input type="hidden" name="mod" value="true">
                <input type="submit" value="Modifier">
              </form><br><br>
              <?php
            }
          }
          $req = $bdd->query("SELECT * from produits ");
          ?>
          <table>
            <tr>
              <th>Nom</th>
              <th>Prix</th>
              <th>Supprimer</th>
              <th>Modifier prix</th>
            </tr>
            <?php
          while ($rep = $req->fetch())
          {
            ?>
            <tr>
              <td><?php echo $rep['nom']; ?></td>
              <td><?php echo $rep['prix']; ?></td>
              <td><form action="supp_produit.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $rep['id']; ?>">
                <input type="hidden" name="nom" value="<?php echo $rep['nom']; ?>">
                <input type="hidden" name="supp" value="true">
                <input type="submit" value="Supprimer">
              </form>
                </td>
                  <td><form action="supp_produit.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $rep['id']; ?>">
                  <input type="hidden" name="nom" value="<?php echo $rep['nom']; ?>">
                  <input type="hidden" name="mod" value="true">
                  <input type="submit" value="Modif">
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </table><br><br><br><br>
        <?php
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
