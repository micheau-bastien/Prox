<head>
  <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway:200">
  <link rel="stylesheet" href="css/style.css"/>
  <?php
    if (isset($_SESSION['theme'])){
      if ($_SESSION['theme']==dark){
        ?><link rel="stylesheet" href="css/style-dark.css"/><?php
      } elseif ($_SESSION['theme']==light) {
        ?><link rel="stylesheet" href="css/style-light.css"/><?php
      }
    }
    else{
      ?><link rel="stylesheet" href="css/style-light.css"/><?php
    }
  ?>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <title> ProxiPain </title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no"/>
  <meta name="google-site-verification" content="CM0DSksnZH3cBKTWXBgIz-TPyfcMDuIyoBGaRRbHIis" />
  <link rel="apple-touch-icon" sizes="57x57" href="apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="60x60" href="apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="76x76" href="apple-touch-icon-76x76.png">
  <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#da532c">
</head>
