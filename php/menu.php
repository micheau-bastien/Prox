<?php
    if (isset($_POST['mdp']) AND isset($_POST['usr']))
    {
      $usr = $_POST['usr'];
      $mdp = $_POST['mdp'];
      $host_ldap = "srv-ldap1.insa-toulouse.fr";
      $ds = ldap_connect($host_ldap) or die("Impossible de se connecter a LDAP");

      $basedn = "ou=People,dc=insa-toulouse,dc=fr";
      $dn = "uid=$usr, ".$basedn;

      $r = @ldap_bind($ds,$dn,$mdp);
      if($r != FALSE)
      {
        echo "<br><br><br>Bonjour ";
        echo $usr;
        echo ", tu veux : <br><br><br>";
        ?>
        <form action="commande.php" method="POST">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Commander" id="Big_Button">
        </form>
        <form action="modif.php" method="POST">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Voir / Supprimer" id="Big_Button">
        </form>
        <footer>
        <form action="index.php" method="POST">
          <input type="submit" value="Se déconnecter" id="Ret_Button">
        </form>
      </footer>
        <?php
      }
      elseif ($usr=="admin" AND $mdp=="pierre")
      {
        echo "Bonjour Admin, tu veux : <br><br>";
        ?>
        <script>
        var Aff_Date = false;
        function bout_date() {
            var bout = document.querySelectorAll('.Big_Button_H');
            var hide = document.querySelectorAll('#hide');
          if (Aff_Date == false)
          {
            bout['0'].style.display = 'inherit';
            bout['1'].style.display = 'inherit';
            hide['0'].style.display = 'inherit';
            Aff_Date = true;
          }
          else
          {
            bout['0'].style.display = 'none';
            bout['1'].style.display = 'none';
            hide['0'].style.display = 'none';
            Aff_Date=false;
          }
        }
        var Aff_Prod = false;
        function bout_prod() {
            var bout = document.querySelectorAll('.Big_Button_H');
          if (Aff_Prod == false)
          {
            bout['2'].style.display = 'inherit';
            bout['3'].style.display = 'inherit';
            hide['1'].style.display = 'inherit';
            hide['2'].style.display = 'inherit';
            Aff_Prod = true;
          }
          else
          {
            bout['2'].style.display = 'none';
            bout['3'].style.display = 'none';
            hide['1'].style.display = 'none';
            hide['2'].style.display = 'none';
            Aff_Prod=false;
          }
        }
        </script>
        <input type="submit" value="Dates" id="Big_Button" onclick="bout_date();"><br>
        <form action="date.php" method="POST" id="cont">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Rentrer une date" class="Big_Button_H" id="Med_Button">
        </form>
        <form action="supp_date.php" method="POST" id="cont">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Supprimer une date" class="Big_Button_H" id="Med_Button">
        </form><br id="hide">
        <input type="submit" value="Produits" id="Big_Button" onclick="bout_prod();"><br id="hide">
        <form action="ajout_produit.php" method="POST" id="cont">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Ajouter un produit" class="Big_Button_H" id="Med_Button">
        </form>
        <form action="supp_produit.php" method="POST" id="cont">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Modifier un produit" class="Big_Button_H" id="Med_Button">
        </form><br id="hide">
        <form action="voir.php" method="POST">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Voir les commandes" id="Big_Button">
        </form>
        <form action="historique.php" method="POST">
          <input type="hidden" name="usr" value="<?php echo $usr; ?>">
          <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
          <input type="submit" value="Historique" id="Big_Button">
        </form><br><br>
        <footer>
        <form action="index.php" method="POST">
          <input type="submit" value="Se déconnecter" id="Ret_Button">
        </form>
      </footer></center>
        <?php
      }
      else
      {
        echo "Mauvais mot de passe désolé, veuillez reesayer : <br><br>";
        ?>
        <form action="index.php" method="POST">
          <input type="text" name="usr" id="focus"/>
          <input type="password" name="mdp" />
          <input type="submit" name="Valider">
        </form>
        <script>
          document.getElementById('focus').focus();
        </script>
        <footer>
        <form action="credits.php" method="POST">
          <input type="hidden" name="usr" value="<?php echo $_POST['usr']; ?>">
          <input type="hidden" name="mdp" value="<?php echo $_POST['mdp']; ?>">
          <input type="submit" value="Credits" id="Ret_Button">
        </form>
      </footer>
        <?php
      }
    }
    ?>
