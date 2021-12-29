
<?php $title = "Page de profil"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Profil de <?= e($user->pseudo) ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?= get_avatar_url($user->email, 100) ?>" alt="Image de profil de <?= e($user->pseudo) ?>" class="img-circle">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong><?= e($user->pseudo) ?></strong><br>
                                <a href="mailto:<?= e($user->email) ?>"><?= e($user->email) ?></a></br>
                                <?=
                                    $user->city && $user->country ? '<i class="fa fa-location-arrow" aria-hidden="true"></i>&nbsp;'.e($user->city) .' - ' .e($user->country).'</br>' 
                                    : '';
                                ?><a href="https://www.google.com/maps?q=<?= e($user->city) .' ' .e($user->country) ?>" target="_blank">Voir sur Google Maps</a>
                            </div>
                            <div class="col-sm-6">
                                <?=
                                    $user->twitter ? '<i class="fa fa-twitter" aria-hidden="true"></i>&nbsp;<a href="//www.twitter.com/'.e($user->twitter).'">@'.e($user->twitter).'</a></br>' : '';
                                ?>
                                <?=
                                    $user->github ? '<i class="fa fa-github" aria-hidden="true"></i>&nbsp;<a href="//www.github.com/'.e($user->github).'">'.e($user->github).'</a></br>' : '';
                                ?>
                                <?=
                                    $user->sex == "H" ? '<i class="fa fa-male" aria-hidden="true"></i>' : '<i class="fa fa-female" aria-hidden="true"></i>';
                                ?>
                                <?=
                                    $user->available_for_hiring ? 'Disponible pour emploi' : 'Non disponible pour emploi';
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 well">
                                <h5>Petite Biographie de <?= e($user->name) ?></h5>
                                <p>
                                    <?= 
                                        $user->bio ? nl2br(e($user->bio)) : "Aucune biographie pour le moment...";
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(!empty($_GET['id']) && $_GET['id'] == get_session('user_id')): ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Compléter mon profil</h3>
                    </div>
                    <div class="panel-body">
                        <?php include('partials/_errors.php'); ?>

                        <form data-parsley-validate method="post" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nom<spam class="text-danger">*</spam></label>
                                        <input type="text" name="name" id="name" required="required" class="form-control"
                                                placeholder="John" value="<?= get_input('name') ?: e($user->name) ?>"
                                                required="required"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">Ville<spam class="text-danger">*</spam></label>
                                        <input type="text" name="city" id="city" value="<?= get_input('city') ?: e($user->city) ?>" required="required" class="form-control"
                                                required="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Pays<spam class="text-danger">*</spam></label>
                                            <input type="text" name="country" id="country" value="<?= get_input('country') ?: e($user->country) ?>" required="required" class="form-control"
                                                   required="required"/>
                                        </div>
                                 </div>
                                 <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sex">Sexe<spam class="text-danger">*</spam></label>
                                            <select type="text" name="sex" id="sex" class="form-control">
                                                <option value="H" <?= $user->sex == "H" ? "selected" : "" ?>>
                                                    Homme
                                                </option>
                                                <option value="F" <?= $user->sex == "F" ? "selected" : "" ?>>
                                                    Femme
                                                </option>
                                            </select>
                                        </div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter">Twitter<spam class="text-danger"></label>
                                            <input type="text" name="twitter" id="twitter" value="<?= get_input('twitter') ?: e($user->twitter) ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="github">Github<spam class="text-danger"></label>
                                            <input type="text" name="github" id="github" value="<?= get_input('github') ?: e($user->github) ?>" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="available_for_hiring">
                                                    <input type="checkbox" name="available_for_hiring" 
                                                    id="available_for_hiring" <?= $user->available_for_hiring ? "checked" : "" ?>/>

                                                    Disponible pour emploi?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="bio">Biographie<spam class="text-danger">*</spam></label>
                                                    <textarea name="bio" id="bio" cols="30" required="required" rows="10" class="form-control"
                                                              placeholder="Je suis un amoureux de la programmation..."><?= get_input('bio') ?: e($user->bio) ?></textarea>
                                            </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Valider" name="update"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>

    </div><!-- /.container -->
</div>

<?php include('partials/_footer.php'); ?>
