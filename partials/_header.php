<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Réseau social pour développeurs">
    <meta name="author" content="MIGUIAMA BAMBA georf harcherole">

    <title>
        <?php
            echo isset($title)
                ? $title .' - '.WEBSITE_NAME
                : WEBSITE_NAME. '- Simple Rapide Efficace:';
        ?>
    </title>

    <!-- DIFFERENTS FICHIERS CSS -->
    <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/readable/bootstrap.min.css" rel="stylesheet" integrity="sha384-Li5uVfY2bSkD3WQyiHX8tJd0aMF91rMrQP5aAewFkHkVSTT2TmD2PehZeMmm7aiL" crossorigin="anonymous">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/google-code-prettify/prettify.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->


    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php include('partials/_nav.php'); ?>
<?php include('partials/_flash.php'); ?>
