<?php
/*
//Clase : ENTREGA_DELETE
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado del usuario seleccionado

*/
class ENTREGA_DELETE{
    var $login; //declaración del atributo login
    var $IdTrabajo; //atributo IdTrabajo
    var $Alias; //atributo Alias
    var $Horas; // declaración del atributo Horas
    var $Ruta; //declaración del atributo Ruta
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($tupla){
    //asignación de valores de parámetro a los atributos de la clase
    $this->login = $tupla['login'];
    $this->IdTrabajo = $tupla['IdTrabajo'];
    $this->Alias = $tupla['Alias'];
    $this->Horas = $tupla['Horas'];
    $this->Ruta = $tupla['Ruta'];

    $this->render();
}


//funcion que muestra los datos al usuario

function render(){

  include '../Views/Header.php';   

?>
     <section class="pagina" style="min-height: 500px">

           <table class="showcurrent">
             <caption><?php echo $strings['Borrar entrega'] ?></caption>
                  <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                 <tr><th><?php echo $strings['login'] ?></th><td><?php echo $this->login ?></td></tr>
                 <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                <tr><th><?php echo $strings['Alias'] ?></th><td><?php echo $this->Alias ?></td></tr>
                <tr><th><?php echo $strings['Horas'] ?></th><td><?php echo $this->Horas ?></td></tr>
                  <tr><th><?php echo $strings['Ruta'] ?></th><td><?php echo $this->Ruta ?></td></tr>
                </table>


       <form method="post" name="DELETE" action="../Controllers/ENTREGA_Controller.php" enctype="multipart/form-data" >
               <input class="del" type="text" name="login" size="<?php echo strlen($this->login); ?>" readonly  value="<?php echo $this->login ?>">
                <input class="del" type="text" name="IdTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->IdTrabajo ?>" >
                <input class="del" type="text" name="Alias" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->Alias ?>">
                <input class="del" type="text" name="Horas"  size="<?php echo strlen($this->Horas); ?>" readonly value="<?php echo $this->Horas ?>">
                <input class="del" type="text"  name="Ruta" size="<?php echo strlen($this->Ruta); ?>" readonly value="<?php echo $this->Ruta ?>" >
               

                  <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%;>

                    <a href="../Controllers/ENTREGA_Controller.php?action=DELETE&IdTrabajo=<?php echo $this->IdTrabajo ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar Usuario'] ?>" ></a>
                    </div>
             </form>

                  <div class="accionesTable" style="float: left;">
                    <a href="../Controllers/ENTREGA_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
                  </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>