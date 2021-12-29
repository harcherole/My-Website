<?php
// fonction vérifie si l'on a donner tous les champs
if(!function_exists('e')) {
    function e($string){
        if ($string){
            return htmlspecialchars($string);

        }
    }
}

// fonction qui va crypter le mot de passe avec Blowfish Algorithm
if(!function_exists('bcrypt_hash_password')) {
    function bcrypt_hash_password($value, $options = array()){
        $cost = isset($options['rounds']) ? $options['rounds'] : 10;
        $hash = password_hash($value, PASSWORD_BCRYPT, array('cost' => $cost));

        if($hash === false){
            throw new Exception("Bcrypt hashing n'est pas supporté.");
        }

        return $hash;
    }
}


// Vérifier Password
if(!function_exists('bcrypt_verify_password')) {
    function bcrypt_verify_password($value, $hashedValue){
        return password_verify($value, $hashedValue);
    }
}

// fonction récupère la session de l'utilisateur
if(!function_exists('get_session')) {
    function get_session($key){
        if ($key){
            // le ternaire
            return !empty($_SESSION[$key])
            ? e($_SESSION[$key])
            : null;

        }
    }
}


// fonction récupère la langue courante
if(!function_exists('get_current_locale')) {
    function get_current_locale(){
        return $_SESSION['locale'];
    }
}

// fonction qui cherche un utilisateur en fonction de son id
if(!function_exists('find_user_by_id')) {
    function find_user_by_id($id){
        global $db;

        $q = $db->prepare('SELECT name, pseudo, email, city, country, twitter, github, sex, available_for_hiring, bio FROM users WHERE id = ?');
        $q->execute([$id]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
        return $data;
    }
}

// fonction qui cherche un code en fonction de son id
if(!function_exists('find_code_by_id')) {
    function find_code_by_id($id){
        global $db;

        $q = $db->prepare('SELECT code FROM codes WHERE id = ?');
        $q->execute([$id]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
        return $data;
    }
}


// fonction qui cherche va récupérer l'avatar de l'utulisateur
if(!function_exists('get_avatar_url')) {
    function get_avatar_url($email, $size = 25){
        return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))))."?s=".$size;
    }
}

// fonction qui vérifie si 'lutilisateur est connecté
if(!function_exists('is_logged_in')) {
    function is_logged_in(){
        return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
    }
}

// fonction vérifie si l'on a donner tous les champs
if(!function_exists('not_empty')) {
    function not_emplty($fields = []){
        if(count($fields) != 0){
            foreach ($fields as $field){ // on vérifie pour chaque élements
                if(empty($_POST[$field]) || trim($_POST[$field]) == ""){
                    return false;
                }
            }
            return true;
        }

    }
}

// pour la fonction is_already_in_use
if(!function_exists('is_already_in_use')){
    function is_already_in_use($field, $value, $table){
        global $db;

        // requete SQL pour selectionner id
        $q = $db->prepare("SELECT id FROM $table WHERE $field = ?");
        $q->execute([$value]);
        // pour compter le nombre de resultats
        $count = $q->rowCount();
        // on ferme le curseur
        $q->closeCursor();
        return $count;

    }
}

if (!function_exists('set_flash')){
    function set_flash($message, $type = 'info'){
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;
    }
}

if (!function_exists('redirect')){
    function redirect($page){
        header('Location: ' . $page);
        exit();
    }
}
// pour save les infos de l'utilisateur
if (!function_exists('save_input_data')){
    function save_input_data(){
        foreach ($_POST as $key => $value){
            if (strpos($key, 'password') == false){
                $_SESSION['input'][$key] = $value;
            }
        }
    }
}

// pour recuperer les infos de l'utilisateur
if (!function_exists('get_input')){
    function get_input($key){
        // le ternaire
        return !empty($_SESSION['input'][$key])
            ? e($_SESSION['input'][$key])
            : null;
    }
}

// pour effacer les infos de l'utilisateur
if (!function_exists('clear_input_data')){
    function clear_input_data(){
        // le ternaire
        if(isset($_SESSION['input'])){
            $_SESSION['input'] = [];
        }
    }
}

// fonction qui gere l'état actif de nos differents lien
if(!function_exists('set_active')) {
    function set_active($file){
        $path = explode('/', $_SERVER['SCRIPT_NAME']);
        $page = array_pop($path);

        if($page == $file.'.php'){
            return "active";
        }else {
            return "";
        }
    }
}