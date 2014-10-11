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
    <div id="titre">Supprimer Date</div>
    <div id="content">
      <center>
    <?php
    if (isset($_SESSION['usr']) AND $_SESSION['usr']=="admin" AND isset($_SESSION['mdp']) AND $_SESSION['mdp'] == "pierre")
    {
      try
      {
        $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
      }
      catch (Exception $e)
      {
        die('erreur : ' . $e->getMessage());
      }
      ?><br><br><br>Je veux supprimer le : <br><br>
      <form action="supp_date.php" method="POST">
        <select name="date_supp">
          <?php
            $date = date("Y-m-d");
            $req = $bdd->query('SELECT * from date');
            while ($rep = $req->fetch())
            {
              if ($date <= $rep['dates'])
              {
                ?>
                <option value="<?php echo $rep['dates']; ?>"><?php echo $rep['dates']; ?></option>
                <?php
              }
            }
          ?>
        </select>
        <br><input type="submit" value="Supprimer">
      </form>
      <?php
      if (isset($_POST['date_supp']))
      {
        $date=$_POST['date_supp'];
        $bdd->exec("DELETE FROM date WHERE dates='".$date."' ");
        echo "<br><br>Supprimé !";
      }
    }
    else
    {
      echo "Erreur de connexion, veuillez vous reconnecter en cliquant sur ProxiPain en haut de l'écran.";
    }
    ?>
      <?php include("php/footer.php"); ?>
    </div>
  </body>
</html>
