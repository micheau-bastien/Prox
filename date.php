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
    <div id="titre">Ajouter Date</div>
    <div id="content">
      <center>
      <?php
      if (isset($_SESSION['usr']) AND $_SESSION['usr']=="admin" AND isset($_SESSION['mdp']) AND $_SESSION['mdp'] == "pierre")
      {
        if (isset($_POST['date']) AND isset($_POST['bloque']))
        {
          $date = $_POST['date'];
          $bloque = $_POST['bloque'];
          echo $date;
          try
          {
            $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
          }
          catch (Exception $e)
          {
            die('Erreur : ' . $e->getMessage());
          }
          $req = $bdd->query('SELECT * from date');
          $ajout=true;
          while ($rep = $req->fetch())
          {
            if ($rep['dates']==$date)
            {
              $ajout=false;
            }
          }
          if ($ajout)
          {
            $req = $bdd->prepare('INSERT INTO date(dates, bloque) VALUES(:dates, :bloque)');
              $req->execute(array(
              'dates' => $date,
              'bloque' => $bloque,
            ));
          }
          else
          {
            echo "<br><br> La date était déjà présente, elle n'a pas été ajoutée.";
          }
        }
        else
        {
          ?>
        <br><br><br>Rentres une date pour une future livraison. <br>Les dates DOIVENT être écrites sous la forme aaaa-mm-jj, sinon tu vas causer la mort de millions de personnes dans le monde !<br><br>

        <center><form action="date.php" method="POST">
          <input type="text" name="date" placeholder="Date : AAAA-mm-dd"/><br>
          <input type="text" name="bloque" placeholder="Dead-line : AAAA-mm-dd" /><br>
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
