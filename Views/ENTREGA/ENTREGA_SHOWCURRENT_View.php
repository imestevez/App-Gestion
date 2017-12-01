<?php
/*
//Clase : ENTREGA_SHOWCURRENT
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado del usuario seleccionado

*/
class ENTREGA_SHOWCURRENT{
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
     <section class="pagina">
             <table class="showcurrent">
             <caption><?php echo $strings['Mostrar entrega'] ?></caption>
                  <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                 <tr><th><?php echo $strings['login'] ?></th><td><?php echo $this->login ?></td></tr>
                 <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                <tr><th><?php echo $strings['Alias'] ?></th><td><?php echo $this->Alias ?></td></tr>
                <tr><th><?php echo $strings['Horas'] ?></th><td><?php echo $this->Horas ?></td></tr>
                  <tr><th><?php echo $strings['Ruta'] ?></th><td><a type="download" href="<?php echo $this->Ruta ?>"><?php echo $this->Ruta ?></a></td></tr>
                </table>

                    <div class="accionesTable">
                     <a href="../Controllers/ENTREGA_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
                 </div>

        </section>	
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>