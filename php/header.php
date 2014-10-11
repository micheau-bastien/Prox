<header>
</header>
<form action="index.php" method="POST">
  <input type="submit" value="ProxiPain" id="head">
</form>
<script>
  $(document).ready(function () {
    $('#content').hide();
    $('#titre').hide();
    $('#content').slideDown(function(){
      $('#titre').fadeIn();
    });
  });
</script>
