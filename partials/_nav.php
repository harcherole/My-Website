
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?php echo WEBSITE_NAME; ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?= set_active('index') ?>"><a href="index.php"><?= $menu['accueil'][$_SESSION['locale']] ?></a></li>
                
                <?php if( is_logged_in()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="<?= get_avatar_url(get_session('email')) ?>" 
                                      alt="Image de profil de <?= get_session('pseudo') ?>" class="img-circle"><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="<?= set_active('profile') ?>">
                                <a href="profile.php?id=<?= get_session('user_id') ?>"><?= $menu['mon_profil'][$_SESSION['locale']] ?></a>
                            </li>
                            <li class="<?= set_active('share_code') ?>"><a href="share_code.php"><?= $menu['share_code'][$_SESSION['locale']] ?></a></li>
                            <li><a href="logout.php"><?= $menu['deconnexion'][$_SESSION['locale']] ?></a></li>
                        </ul>
                    </li>                
                <?php else: ?>
                    <li class="<?= set_active('login') ?>"><a href="login.php"><?= $menu['connexion'][$_SESSION['locale']] ?></a></li>
                    <li class="<?= set_active('register') ?>"><a href="register.php"><?= $menu['inscription'][$_SESSION['locale']] ?></a></li>
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

