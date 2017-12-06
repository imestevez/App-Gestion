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
    var $Nombre; //declaración del atributo nombre
    var $IdTrabajo; //atributo IdTrabajo
    var $NombreTrabajo; //atributo NombreTrabajo
    var $Alias; //atributo Alias
    var $Horas; // declaración del atributo Horas
    var $Ruta; //declaración del atributo Ruta
    var $NotaTrabajo; //decalaracion de la nota de trabajo
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($lista){
    //asignación de valores de parámetro a los atributos de la clase
    $this->login = $lista['login'];
    $this->Nombre = $lista['Nombre'];
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->NombreTrabajo = $lista['NombreTrabajo'];
    $this->Alias = $lista['Alias'];
    $this->Horas = $lista['Horas'];
    $this->Ruta = $lista['Ruta'];
   $this->NotaTrabajo = $lista['NotaTrabajo'];
  //$this->NotaTrabajo = 8;


    $this->render();
}


//funcion que muestra los datos al usuario

function render(){

  include '../Views/Header.php';   

?>
     <section class="pagina">
             <table class="showcurrent" style="width: 70%; margin-left: 15%">
             <caption><?php echo $strings['Mostrar entrega'] ?></caption>
                  <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th><th><?php echo $strings['Acciones'] ?></th></tr>
                 <tr><th><?php echo $strings['login'] ?></th><td><?php echo $this->login ?></td>

                    <td style="border-bottom-style: collapse; border-bottom:  5px solid black;">
                    <a href="../Controllers/USUARIO_Controller.php?action=SHOWCURRENT&login=<?php echo $this->login ?>&origen=../Controllers/ENTREGA_Controller.php?action=SHOWCURRENT&login=<?php echo $this->login ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOWCURRENT" action=""></a>
                  
                </td>
                 <tr><th><?php echo $strings['Nombre'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->Nombre ?></td>

                </tr>    

                 </tr>
                 <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?>
                 </td>
                     <td  style="border-bottom-style: collapse; border-bottom:  5px solid black;border-top:  5px solid black;" >
                    <a href="../Controllers/TRABAJO_Controller.php?action=SHOWCURRENT&IdTrabajo=<?php echo $this->IdTrabajo ?>&origen=../Controllers/ENTREGA_Controller.php?action=SHOWCURRENT&login=<?php echo $this->login ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOWCURRENT" action=""></a>
                  
                </td>


                 </tr>
                 <tr><th><?php echo $strings['NombreTrabajo'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;" ><?php echo $this->NombreTrabajo ?></td></tr>
                <tr><th><?php echo $strings['Alias'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->Alias ?></td></tr>
                <tr><th><?php echo $strings['Horas'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->Horas ?></td></tr>
                  <tr><th><?php echo $strings['Ruta'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><a type="download" href="<?php echo $this->Ruta ?>"><?php echo $this->Ruta ?></a></td></tr>

                    <tr><th><?php echo $strings['NotaTrabajo'] ?></th>
                        <td > <?php if($this->NotaTrabajo <> ''){ echo $this->NotaTrabajo; } else{ echo $strings['Sin calificar']; } ?> </td>

                        <td style="border-right-style: collapse; border-right:  5px solid black;border-top:  5px solid black;"> <?php if($this->NotaTrabajo <> ''){ ?> <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=EDIT&IdTrabajo=<?php echo $row["IdTrabajo"]?>&login=<?php echo $row["login"]?>?>&origen=../Controllers/TRABAJO_Controller.php"> <input type="image" style="margin-bottom: 2%" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="EDIT"></a>  <?php } else{ ?> <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=ADD&IdTrabajo=<?php echo $row["IdTrabajo"]?>&login=<?php echo $row["login"]?>?>&origen=../Controllers/TRABAJO_Controller.php"> <input type="image" style="margin-bottom: 2%" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Añadir'] ?>" value="ADD"></a><?php } ?> </td>


                    </tr>
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