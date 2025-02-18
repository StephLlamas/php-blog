<?php
if(isset($_POST)){
    
    // Conexión a la base de datos
    require_once 'includes/conexion.php';

    // Recoger los valores del formulario de actualización
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
   
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
        $errores['email'] = 'The email is invalid.';
    }
    
    // Guardar información en BBDD
    $guardar_usuario = false;
    
    if (count($errores) == 0){
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;
        
        // Comprobar si el email ya existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
            // ACTUALIZAR USUARIO EN SU TABLA CORRESPONDIENTE DE LA BBDD
            $sql = "UPDATE usuarios SET
                    nombre = '$nombre', 
                    apellidos = '$apellidos', 
                    email = '$email' 
                    WHERE id =".$usuario['id'];
            $guardar = mysqli_query($db, $sql);

            // var_dump(mysqli_error($db));
            // die();

            if($guardar){
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                
                $_SESSION['completado'] = 'The account details have updated successfully.';
            } else {
                $_SESSION['errores']['general'] = 'An error has occured. The account details could not be updated. Please, try again later.';
            }
        } else {
            $_SESSION['errores']['general'] = 'The user already exists.';
        }
        
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: misdatos.php');

?>