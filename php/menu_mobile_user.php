<div id="mobile-men-ic"><img src="menu2.png"></div>
<div id="mobile-men">
  <center>
    <input type="submit" value="Cacher le menu" id="Big_Button" class="menu_h">
    <form action="index.php" method="POST" id="B_mob_u">
      <input type="submit" value="Accueil" id="Big_Button">
    </form>
    <form action="commande.php" method="POST" id="B_mob_u">
      <input type="submit" value="Commander" id="Big_Button">
    </form>
    <form action="modif.php" method="POST" id="B_mob_u">
      <input type="submit" value="Voir / Supprimer" id="Big_Button">
    </form>
    <form action="histo_client.php" method="POST" id="B_mob_u">
      <input type="submit" value="Historique" id="Big_Button">
    </form>
    <form action="contact.php" method="POST" id="B_mob_u">
      <input type="submit" value="Nous contacter" id="Big_Button">
    </form>
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
