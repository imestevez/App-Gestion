<?php
/*
//Clase : EVALUACION_SHOWCURRENT
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado del usuario seleccionado

*/
class EVALUACION_SHOWCURRENT{

    var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA

function __construct($lista){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->LoginEvaluador = $lista['LoginEvaluador'];
    $this->AliasEvaluado = $lista['AliasEvaluado'];
    $this->IdHistoria = $lista['IdHistoria'];
    $this->CorrectoA = $lista['CorrectoA'];
    $this->ComenIncorrectoA = $lista['ComenIncorrectoA'];
    $this->CorrectoP = $lista['CorrectoP'];
    $this->ComentIncorrectoP = $lista['ComentIncorrectoP'];
    $this->OK = $lista['OK'];


    $this->render();
}


//funcion que muestra los datos al usuario

function render(){

  include '../Views/Header.php';   

?>
     <section class="pagina">
            <table class="showcurrent" style="width: 70%; margin-left: 15%">
             <caption><?php echo $strings['Mostrar evaluacion'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th><th><?php echo $strings['Acciones'] ?></th></tr>
                <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?>
                </td>
                     <td  style="border-bottom-style: collapse; border-bottom:  5px solid black;border-top:  5px solid black;" >
                    <a href="../Controllers/TRABAJO_Controller.php?action=SHOWCURRENT&IdTrabajo=<?php echo $this->IdTrabajo ?>&origen=../Controllers/EVALUACION_Controller.php?action=SHOWCURRENT&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOWCURRENT" action=""></a>
                  
                </td>


                </tr>
                <tr><th><?php echo $strings['LoginEvaluador'] ?></th><td><?php echo $this->LoginEvaluador ?></td>

                <td style="border-bottom-style: collapse; border-bottom:  5px solid black;">
                    <a href="../Controllers/USUARIO_Controller.php?action=SHOWCURRENT&login=<?php echo $this->LoginEvaluador ?>&origen=../Controllers/EVALUACION_Controller.php?action=SHOWCURRENT&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOWCURRENT" action=""></a>
                </td>

                <tr><th><?php echo $strings['AliasEvaluado'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->AliasEvaluado ?></td>
                </tr>    

                </tr>
                 <tr><th><?php echo $strings['IdHistoria'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;" ><?php echo $this->IdHistoria ?></td></tr>
                <tr><th><?php echo $strings['CorrectoA'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->CorrectoA ?></td></tr>
                <tr><th><?php echo $strings['ComenIncorrectoA'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->ComenIncorrectoA ?></td></tr>
                <tr><th><?php echo $strings['CorrectoP'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->CorrectoP ?></td></tr>
                <tr><th><?php echo $strings['ComentIncorrectoP'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->ComentIncorrectoP ?></td></tr>
                <tr><th><?php echo $strings['OK'] ?></th>
                        <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->OK ?></td></tr>
            </table>

            <div class="accionesTable">
                <a href="../Controllers/EVALUACION_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

        </section>	
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>