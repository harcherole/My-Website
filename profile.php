<?php
session_start();

require('bootstrap/locale.php');
include('filters/authentification_filter.php');
require('config/database.php');
require('include/functions.php');
require('include/constantes.php');

if(!empty($_GET['id'])){
    // récupère les infos de l'utilisateur dans la base de donnée en utilisant son id
    $user = find_user_by_id($_GET['id']);

    if(!$user){
        redirect('index.php');
    }
}else{
    redirect('profile.php?id='.get_session('user_id'));
}

// Si le formulaire a été soumie
if(isset($_POST['update'])){

    // Si tous les champs ont été remplis
    if(not_emplty(['name', 'city', 'country', 'sex', 'bio'])){

        extract($_POST); // pour accèder facilement aux variables

        $errors = [];

        $q = $db->prepare('UPDATE users 
                           SET name = :name, city = :city, country = :country,
                           sex = :sex, twitter = :twitter, github = :github,
                           available_for_hiring = :available_for_hiring, bio = :bio
                           WHERE id = :id');
        $q->execute([
            'name' => $name,
            'city' => $city,
            'country' => $country,
            'sex' => $sex,
            'twitter' => $twitter,
            'github' => $github,
            'available_for_hiring' => !empty($available_for_hiring) ? '1' : '0',
            'bio' => $bio,
            'id' => get_session('user_id'),
        ]);

        set_flash("Félicitations, votre profil a été mis à jour");
        redirect('profile.php?id='.get_session('user_id'));

    }else{
        save_input_data();
        $errors[] = "Veuillez remplir tous les champs marqés d'un (*)";
    }
        
} else {
    clear_input_data();
}

require('views/profile.view.php'); // on incus le fichier
