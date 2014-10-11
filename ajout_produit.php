<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <?php include("php/head.php"); ?>
  <body>
    <?php include("php/header.php"); ?>
    <?php include("php/menu_admin.php"); ?>
	  <?php include("menu_mobile_admin.php"); ?>
    <div id="titre">Ajouter Produit</div>
    <div id="content">
      <center>
      <?php
      if (isset($_SESSION['usr']) AND $_SESSION['usr']=="admin" AND isset($_SESSION['mdp']) AND $_SESSION['mdp'] == "pierre")
      {
        if (isset($_POST['nom']) AND isset($_POST['prix']))
        {
          $nom = $_POST['nom'];
          $prix = $_POST['prix'];
          echo $date;
          try
          {
            $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
          }
          catch (Exception $e)
          {
            die('Erreur : ' . $e->getMessage());
          }
          $req = $bdd->query('SELECT * from produits');
          $ajout=true;
          while ($rep = $req->fetch())
          {
            if ($rep['nom']==$nom)
            {
              $ajout=false;
            }
          }
          if ($ajout)
          {
            $req = $bdd->prepare('INSERT INTO produits(nom, prix) VALUES(:nom, :prix)');
              $req->execute(array(
              'nom' => $nom,
              'prix' => $prix,
            ));
            $bdd->exec("ALTER TABLE  `commandes` ADD  `".$nom."` INT NOT NULL");
            echo "<br><br>Vous avez bien ajouté le produit suivant : <br><br> Nom : ";
            echo $nom;
            echo " || Prix : ";
            echo $prix;
          }
          else
          {
            echo "<br><br> Le produit était déjà présent, il n'a pas été ajoutée.";
          }
        }
        else
        {
          ?>
        <br><br><br>Rentres un nouveau produit. <br><br> /!\ Les produits DOIVENT commencer par une majuscule. Sinon il est triste et tout se met à planter.<br><br>

        <center><form action="ajout_produit.php" method="POST">
          <input type="text" name="nom" placeholder="Nom" />
          <input type="number" step="any" name="prix" placeholder="Prix" /><br>
          <input type="submit" value="C'est bon">
        </form></center>
        <?php
        }
      }
      else
      {
        echo "Erreur, veuillez vous reconnecter en cliquant sur ProxiPain en haut de votre écran.";
      }
      ?>
      <?php include("php/footer.php"); ?>
    </div>
  </body>
</html>
