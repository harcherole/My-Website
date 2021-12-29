<?php
session_start();
require('bootstrap/locale.php');
include('filters/authentification_filter.php');
require('config/database.php');
require('include/functions.php');
require('include/constantes.php');

if(!empty($_GET['id'])){
    $data = find_code_by_id($_GET['id']);
        
    if(!$data){
        redirect('share_code.php');
    }

}else{
    redirect('share_code.php');
}

?>


<?php
require('views/show_code.view.php'); ?>