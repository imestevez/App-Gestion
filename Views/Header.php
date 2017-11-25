<!--
Script : Header_View.php
Creado el : 14-10-2017
Creado por: vugsj4

Contiene el html de la cabecera de las vistas

 -->  
<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        
    <title>WEB</title>  <link rel="icon" href="../Views/images/cabeceraB.png" type="image/png">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="../Views/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="../Views/css/tcal.css" />

    <script lang="JavaScript" src="../Views/js/validaciones.js"></script>
    <script lang="JavaScript" src="../Views/js/md5.js"></script>
    <script type="text/javascript" src="../Views/js/tcal.js"></script> 
    <script src="../Views/js/jquery.js"></script>
    <script src="../Views/js/main.js"></script>
    </head>
    
    <body>
        
        <header>
          <h1><strong>WEB</strong></h1>
            
    <?php
    include_once '../Functions/Authentication.php';
    if (!isset($_SESSION['idioma'])) { //si no tiene idioma la sesion
        $_SESSION['idioma'] = 'SPANISH';
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
    }
    else{
        //$_SESSION['idioma'] = 'SPANISH'; // quitar y solucionar el problema de que inicilice el idioma a galego
        include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
    }

?>
        <nav class="menu_derecha">
             <label for="sesion" id="lab_sesion"></label>
<?php
    
    if (IsAuthenticated()){//si esta autenticado
?>
<div><p style="margin-top: 5%; "><strong>
<?php
        echo $strings['Usuario'] . ' : ' . $_SESSION['login'];
?>          
    </strong></p> &nbsp&nbsp&nbsp
           <input type="image" id="sesion" alt="Sesion" src="../Views/images/usuario.png" title="<?php echo $strings['Sesión iniciada'] ?>" style="width: 32px; height: 32px" >

           <a href='../Functions/Desconectar.php'>
            <input type="image" src="../Views/images/exit.png" title="<?php echo $strings['Desconectar'] ?>">  
        </a> &nbsp&nbsp&nbsp
        
    </div>
           

<?php
    
    }

  //  else{
        /*echo  '<form name=\'registerForm\' action=\'../Controllers/Register_Controller.php\' method=\'post\'>
                    <input type=\'submit\' name=\'action\' value=\'REGISTER\'>
                </form>';*/
?>
<div style="margin-top: 0px">
        <form name='idiomaform' action="../Functions/CambioIdioma.php" method="post">
            <input type="image" name="idioma" value="ENGLISH" src="../Views/images/uk.png" style="width: 35px; height: 30px">
            <input type="image" name="idioma" value="SPANISH" src="../Views/images/espana.png" style="width: 35px; height: 30px">
            <input type="image" name="idioma" value="GALICIAN" src="../Views/images/gal.png" style="width: 35px; height: 30px">
        
           <label for="idioma">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<strong><?php echo $strings['idiomaSeleccionado'] ?></strong></label>

        </form>
    </div>
 </nav>  
       
     </header>

<div id = 'main'>
<?php
    //session_start();
    if (IsAuthenticated()){ //si esta autenticado
        include 'Menu_Lateral.php';
    }
?>
</div>
            
        