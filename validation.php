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
     <div id="titre">Validation</div>
    <div id="content">
      <center>
        <br><br><br>
    <?php
        $total =0;
        $mdp = $_SESSION['mdp'];
        $usr = $_SESSION['usr'];
        $host_ldap = "srv-ldap1.insa-toulouse.fr";
        $ds = ldap_connect($host_ldap) or die("Impossible de se connecter a LDAP");
        $basedn = "ou=People,dc=insa-toulouse,dc=fr";
        $dn = "uid=$usr, ".$basedn;

        $r = @ldap_bind($ds,$dn,$mdp);
        if($r != FALSE)
        {
          try{
            $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
          }
          catch (Exception $e){
                  die('Erreur : ' . $e->getMessage());
          }
          //Verif des variables
          $set = true;
          $req = $bdd->query('SELECT * FROM produits');
          while ($prod = $req->fetch())
          {
            if (!isset($_POST[$_prod['nom']])){
              if ($_POST[$prod['nom']]>10 OR $_POST[$_prod['nom']]<0){
                $set= false;
              }
            }
          }
          $req = $bdd->query("SELECT * FROM date WHERE dates='".$_POST['date']."' ");
          $nb_dates=0;
          while ($rep = $req->fetch()){
            $n++;
          }
          if ($n==0){
            $set=false;
          }
          if ($set)
          {
            $id_max=0;
            $req = $bdd->prepare('INSERT INTO commandes(usr , date, rappel) VALUES(:usr, :date, :rappel)');
              $req->execute(array(
              'usr' => $_SESSION['usr'],
              'date' => $_POST['date'],
              'rappel' => $_POST['rappel'],
            ));
            echo "Pour le ";
            echo $_POST['date'];
            echo ", vous avez bien commandé : <br>";
            $req = $bdd->query('SELECT * FROM commandes');
            /*Recherche de l'id MAX pour trouver la commande*/
            while ($rep = $req->fetch())
            {
              if ($rep['id'] > $id_max)
              {
                $id_max = $rep['id'];
              }
            }
            $req = $bdd->query('SELECT * FROM produits');
            while ($prod = $req-> fetch())
            {
              $nom = $prod['nom'];
              $nb_nom = $_POST[$nom];
              echo "- ";
              echo $nb_nom;
              echo " ";
              echo $nom;
              echo "s<br>";
              $total = $total + $nb_nom * $prod['prix'];
              $bdd->exec('UPDATE commandes SET '.$nom.'=\''.$nb_nom.'\' WHERE id=\''.$id_max.'\' ');
            }
            $bdd->exec('UPDATE commandes SET total=\''.$total.'\' WHERE id=\''.$id_max.'\' ');
            echo "<br><br> Total de la commande  : ";
            echo $total;
            echo "€.";
          }
          else
          {
            echo "faux";
          }
        }
        else
        {
          echo "Il y a une erreur, veuillez vous reconnecter";
          ?>
          <a href="index.php">ICI</a>
          <?php
        }

    ?>
      <?php include("php/footer.php"); ?>
    </div>
  </body>
</html>
