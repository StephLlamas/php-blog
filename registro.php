<?php
/*if(isset($_POST)){
    if (isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
    } else {
        $nombre = false;
    }
    if (isset($_POST['apellidos'])){
        $apellidos = $_POST['apellidos'];
    } else {
        $apellidos = false;
    }
    if (isset($_POST['email'])){
        $email = $_POST['email'];
    } else {
        $email = false;
    }
    if (isset($_POST['password'])){
        $password = $_POST['password'];
    } else {
        $password = false;
    }
}
*/

if(isset($_POST)){
    
    // Conexión a la base de datos
    require_once 'includes/conexion.php';

    // Iniciar sesión
    if(!isset($_SESSION)){ 
        session_start(); 
    } 

    // Recoger los valores del formulario de registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    
    // Array de errores
    $errores = array();
    
    // Validar los datos antes de guardarlos en la base de datos

    // Validar campo nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = 'The name is invalid.';
    }
    
    // Validar campo apellidos
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validados = true;
    } else {
        $apellidos_validados = false;
        $errores['apellidos'] = 'The surname is invalid.';
    }
    
    // Validar campo email
    if (!empty($email) && !is_numeric($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = 'The e-mail is invalid.';
    }
    
    // Validar campo contraseña
    if (!empty($password)){
        $password_validada = true;
    } else {
        $password_validada = false;
        $errores['password'] = 'The password is empty.';
    }
    
    // Guardar información en BBDD
    $guardar_usuario = false;
    if (count($errores) == 0){
        $guardar_usuario = true;
        
        // CIFRAR LA CONTRASEÑA
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        // INSERTAR USUARIO EN SU TABLA CORRESPONDIENTE DE LA BBDD
        $sql = "INSERT INTO usuarios VALUES(null,'$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);
        
        // var_dump(mysqli_error($db));
        // die();
        
        if($guardar){
            $_SESSION['completado'] = 'Registration has been successfully completed.';
        } else {
            $_SESSION['errores']['general'] = 'Failed to save user.';
        }
        
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');

?>