<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <?php include("php/head.php"); ?>
   <body>
     <?php include("php/header.php"); ?>
     <div id="titre">Credits</div>
     <div id="content">
       <center>
         <div id="all">
           <div id="droite">
             <br>Icone réalisée par le site : <br> <a HREF="http://www.boulangerie-mittenaere.com/">Boulangerie Mittenaere</a><br><br>
           </div>
           <div id="milieu">
             <br><br>Site demandé par Pierre Nöel.
           </div>
           <div id="gauche">
             Site réalisé par Micheau Bastien.
             <br>
             <a title="micheau@etud.insa-toulouse.fr" HREF="mailto:micheau@etud.insa-toulouse.fr">Mail</a>
           </div>
         </div>
       </center>
     </div>
     <script>
       $('#milieu').hide();
       $('#droite').hide();
       $('#gauche').hide();
       $('#milieu').fadeIn(function(){
         $('#gauche').slideDown(function(){
           $('#droite').slideDown();
         });
       });
    </script>
   </body>
</html>
