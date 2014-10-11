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
          if (isset($_SESSION['usr']) AND $_SESSION['usr']=="admin" AND isset($_SESSION['mdp']) AND $_SESSION['mdp'] == "pierre"){
            try{
              $bdd = new PDO('mysql:host=localhost;dbname=proximo', 'proximo', 'proximoz3');
            }
            catch (Exception $e){
              die('erreur : '. $e->getMessage());
            }
            if (isset($_POST['date'])){
              echo $_POST['date'];
              $req = $bdd->query("SELECT * from commandes WHERE date='".$_POST['date']."'");
              echo "<br><br>Les mails ont bien été envoyés aux personnes suivantes : ";
              while ($rep = $req->fetch()) {
                if ($rep['rappel']=="o" AND !($rep['paye']=="o")){
                  echo $rep['usr'];
                  echo "<br>";
                  $adresse = $rep['usr'];
                  $adresse .= "@etud.insa-toulouse.fr";
                  $message = "Bonjour,\n\nL'équipe du proximo vous rappelle qu'elle a enregistré une commande de ";
                  $message .= $rep['total'];
                  $message .= "0€ à votre nom. Vous, ou une personne que vous aurez choisi, pourrez venir la chercher le ";
                  $message .= $_POST['date'];
                  $message .= " dans les horaires d'ouverture du proximo.(Le lundi de 18h00 à 19h30 et le jeudi de 16h à 17h)\n \nEn vous souhaitant une bonne journée,\n L'équipe du proximo.";
                  $headers ='From: "Proximo"<proximo@etud.insa-toulouse.fr>'."\n";
                  $headers .='Content-Type: text/plain; charset="UTF-8"'."\n";
                  $headers .='Content-Transfer-Encoding: 8bit';
                  $dest = "micheau@etud.insa-toulouse.fr";
                  mail($adresse, 'Ta commande de pain au proximo', $message, $headers);
                }
              }
            }
            else {
              echo "Pas de date rentrée..";
            }
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
