<?php
session_start();
require('bootstrap/locale.php');
include('filters/guest_filter.php');
require('config/database.php');
require('include/functions.php');
require('include/constantes.php');


    // Si le formulaire a été soumie
    if(isset($_POST['register'])){

        // Si tous les champs ont été remplis
        if(not_emplty(['name', 'pseudo', 'email', 'password', 'password_confirm'])){

            $errors = []; // tableau des erreurs

            extract($_POST); // pour accèder facilement aux variables

            //vérification du pseudo
            if(mb_strlen($pseudo) < 3){
                $errors[] = "Pseudo trop court! (Minimum 3 caractères)";
            }
            //vérification de l'email
            if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Adresse email est invalide";
            }
            //vérification du mot de passe
            if(mb_strlen($password) < 6){
                $errors[] = "Mot de passe trop court! (Minimum 6 caractères)";
            }else {
                if($password != $password_confirm){
                    $errors[] = "Les deux mots de passes sont différents";
                }
            }

            // vérifie dans la tables useurs si le pseudo est déjà utilisé
            if(is_already_in_use('pseudo', $pseudo, 'users')){
                $errors[] = "Pseudo déjà utilisé!";
            }

            // vérifie dans la tables useurs si l'email est déjà utilisé
            if(is_already_in_use('email', $email, 'users')){
                $errors[] = "Adresse E-mail déjà utilisée!";
            }

            if(count($errors) == 0){
                // envoi d'un mail d'activation
                $to = $email;
                $subject = WEBSITE_NAME. " - ACTIVATION DE COMPTE";
                $password = bcrypt_hash_password($password); // pour hacher le mot de passe
                $token = sha1($pseudo.$email.$password);

                ob_start(); //garde en memoir tanpom
                require('template/emails/activation.email.php');
                $content = ob_get_clean();

                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // pour envoyer le mail
                mail($to, $subject, $content, $headers);
                // informer l'utilisateur pour qu'il vérifie sa boite de reception
                set_flash("Mail d'activation envoyé!",'success');

                // insersion dans la base de données mysql
                $q = $db->prepare('INSERT INTO users(name,pseudo,email,password)
                                 VALUES(:name, :pseudo, :email, :password)');
                $q->execute([
                    'name' => $name,
                    'pseudo' => $pseudo,
                    'email' => $email,
                    'password' => $password
                ]);

                redirect('index.php');

            } else{
                save_input_data();
            }

        } else {
            $errors[] = "Veuillez SVP remplir tous les champs!";
            save_input_data();
        }
    } else {
        clear_input_data();
    }
?>


<?php
require('views/register.view.php'); ?>