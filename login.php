<?php
session_start();
require('bootstrap/locale.php');
include('filters/guest_filter.php');
require('config/database.php');
require('include/functions.php');
require('include/constantes.php');


    // Si le formulaire a été soumie
    if(isset($_POST['login'])){

        // Si tous les champs ont été remplis
        if(not_emplty(['identifiant', 'password'])){

            extract($_POST); // pour accèder facilement aux variables

            $q = $db->prepare("SELECT id, pseudo, password AS hashed_password, email FROM users
                               WHERE (pseudo = :identifiant OR email = :identifiant)
                               AND active = '1'");
            $q->execute([
                'identifiant' => $identifiant,
            ]);


            $user = $q->fetch(PDO::FETCH_OBJ);

            if($user && bcrypt_verify_password($password, $user->hashed_password)){
                // récupère l'ensemble des données
                // Affichage du resultat
                //die($user->pseudo);
                // on peut accéder à ces information dans toutes les pages
                $_SESSION['user_id'] = $user->id;
                $_SESSION['pseudo'] = $user->pseudo;
                $_SESSION['email'] = $user->email;

                redirect('profile.php?id='.$user->id);
            }else{
                set_flash('Combinaison Identifiant/Password incorrecte!', 'danger');
                save_input_data();
            }
        }
            
    } else {
        clear_input_data();
    }
?>


<?php
require('views/login.view.php'); ?>