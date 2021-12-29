<!-- ON introduit la variable title -->

<?php $title = "Accueil"; ?>
<?php include('include/constantes.php'); ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
    <div class="container">

        <div class="jumbotron">
            <h1><?= WEBSITE_NAME; ?></h1>
            <?= $long_text['accueil_intro'][$_SESSION['locale']] ?>
        </div>

    </div><!-- /.container -->
</div>


<?php include('partials/_footer.php'); ?>
