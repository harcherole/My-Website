<?php
session_start();
require('bootstrap/locale.php');
include('filters/authentification_filter.php');
require('config/database.php');
require('include/functions.php');
require('include/constantes.php');

// Récupérer l'identifiant du code
if(!empty($_GET['id'])){
    $data = find_code_by_id($_GET['id']);
        
    if(!$data){
        $code="";
    }else{
        $code = $data->code;
    }

}else{
    $code = "";
}


// Si le formulaire a été soumis
if(isset($_POST['save'])){
    if(!empty(['code'])){

        extract($_POST);

        $q = $db->prepare('INSERT INTO codes(code) VALUES(?)');
        $success = $q->execute([$code]);

        if($success){
            // Afficher le code source
            $id = $db->lastInsertId();
            redirect('show_code.php?id='.$id);
        }else{
            set_flash("Erreur lors de l'ajout du code source. Veuillez réessayer SVP.");
            redirect("share_code.php");
        }

    }else{
        redirect("share_code.php");
    }

}

?>


<?php
require('views/share_code.view.php'); ?>