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
      ?>
      <div id="titre">Voir</div>
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
            //PAYE
            if (isset($_POST['paye'])){
                $bdd->exec('UPDATE commandes SET paye=\'o\' WHERE id=\''.$_POST['id'].'\' ');
            }
            if (isset($_POST['date_aff']))
            {
                $nb_tot_flu =0;
                $nb_tot_bag =0;
                  $req = $bdd->query('SELECT * FROM commandes ORDER BY usr ASC');
                  echo "Pour le : ";
                  echo $_POST['date_aff'];
        ?>
                  <form action="mail.php" method="POST" id="button_mail">
                    <input type="hidden" name="date" value="<?php echo $_POST[date_aff]; ?>">
                    <input type="button" value="Envoyer Mail" onclick="mail();"/>
                  </form>
                  <script>
                    function mail() {
                      if(confirm('Voulez-vous vraiment envoyer les mails ?')) {
                        document.getElementById("button_mail").submit();
                      } else {
                        alert ('Vous ne voulez pas envoyer ce mail');
                      }
                    }
                  </script>
                <br><br>
                <table id="table_h">
                  <tr>
                    <th>User</th>
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
                    <th>Payé</th>
                  </tr>
                  <?php
                    $n = 0;
                    $req = $bdd->query("SELECT * from commandes WHERE date='".$_POST['date_aff']."' AND paye!='o' ORDER BY usr ASC");
                    while ($rep = $req->fetch())
                    {
                	     $n = $n+1;
                       $roq = $bdd->query('SELECT * FROM produits');
                  ?>
                    <tr>
                      <td><?php echo $rep['usr']; ?></td>
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
                      <td>
                        <?php echo $rep['total']; ?>
                      </td>
                      <td>
                        <form action="voir.php" method="POST" id="form_paye_<?php echo $rep['id']; ?>">
                          <input type="hidden" name="id" value="<?php echo $rep['id']; ?>">
                          <input type="hidden" name="paye" value="yes">
                          <input type="hidden" name="date_aff" value="<?php echo $_POST['date_aff']; ?>">
                          <input type="button" value="Payé" id="bouton_paye" onClick="verif_<?php echo $rep['id']; ?>();">
                        </form>
                        <script>
                          function verif_<?php echo $rep['id']; ?>(){
                                if(confirm('Etes vous sur ?')) {
                                  document.getElementById("form_paye_<?php echo $rep['id']; ?>").submit();
                                } else {
                                  alert('Vous avez dit non !');
                                }
                          }
                        </script>
                      </td>
                    </tr>
                    <?php
                    }
                    if ($n == 0){
              	    ?>
              		    <script>
        	      		     var tbl = document.getElementById('table_h');
            	  		     tbl.style.display = 'none';
            	  		     document.getElementById('text_h').style.display = 'none';
              		    </script>
              		    Il n'y a pas de commandes pour cette date.
              	      <?php
              	    }
                      ?>
                </table>
                <?php
                  $roq = $bdd->query('SELECT * FROM produits');
                  echo " <div id='text_h'><br>Il y a : ";
                  while ($prod = $roq->fetch())
                  {
                    $nom = "nb_".$prod['nom'];
                    echo ${$nom};
                    echo " ";
                    echo $prod['nom'];
                    echo "s, ";
                  }
                  echo " et pis c'est tout.<br><br></div>";
                  $req->closeCursor();
            }
                ?>
            Pour quel date veux tu afficher les commandes ?<br><br>
            <form action="voir.php" method="POST">
              <select name="date_aff">
                <option>Dates</option>
                <?php
                $rep = $bdd->query('SELECT * from date');
                while ($donnees = $rep->fetch())
                {
                  $date = date("Y-m-d");
                  if ($date <= $donnees['dates'])
                  {

                    ?>
                      <option value="<?php echo $donnees['dates']; ?>"> <?php echo $donnees['dates']; ?> </option>
                    <?php
                  }
                }
                ?>
              </select>
              <input type="submit" value="Voir">
            </form><br><br>
            <?php
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
