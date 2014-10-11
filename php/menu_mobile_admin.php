<div id="mobile-men-ic"><img src="menu2.png"></div>
<div id="mobile-men">
  <center>
    <input type="submit" value="Cacher le menu" id="Big_Button" class="menu_h">
    <form action="index.php" method="POST" id="B_mob">
      <input type="submit" value="Accueil" id="Big_Button">
    </form>
    <form action="date.php" method="POST" id="B_mob">
      <input type="submit" value="Rentrer une date" id="Big_Button">
    </form>
    <form action="supp_date.php" method="POST" id="B_mob">
      <input type="submit" value="Supprimer une date" id="Big_Button">
    </form><br id="hide">
    <form action="ajout_produit.php" method="POST" id="B_mob">
      <input type="submit" value="Ajouter un produit" id="Big_Button">
    </form>
    <form action="supp_produit.php" method="POST" id="B_mob">
      <input type="submit" value="Modifier un produit" id="Big_Button">
    </form><br id="hide">
    <form action="voir.php" method="POST" id="B_mob">
      <input type="submit" value="Voir les commandes" id="Big_Button">
    </form>
    <form action="historique.php" method="POST" id="B_mob">
      <input type="submit" value="Historique" id="Big_Button">
    </form><br><br>
  </center>
</div>
<script>
  //$('#mobile-men').hide();
  $('#mobile-men-ic').click(function(){
    $('#mobile-men').slideDown();
    $('footer').fadeOut();
    $('header').fadeOut();
    $('#Ret_Button').fadeOut();
    $('#B').fadeOut();
    $('#L').fadeOut();
  });
  $('.menu_h').click(function(){
    $('#mobile-men').fadeOut();
    $('footer').fadeIn();
    $('header').fadeIn();
    $('head').fadeIn();
    $('#Ret_Button').fadeIn();
    $('#B').fadeIn();
    $('#L').fadeIn();
  });
</script>
