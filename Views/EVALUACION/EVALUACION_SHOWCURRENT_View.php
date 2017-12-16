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
    var $listaHistorias; //atributo para almacenar el recordset de historias de una evaluacion

function __construct($lista, $listaHistorias){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->LoginEvaluador = $lista['LoginEvaluador'];
    $this->AliasEvaluado = $lista['AliasEvaluado'];
    //$this->IdHistoria = $lista['IdHistoria'];
    $this->CorrectoA = $lista['CorrectoA'];
    $this->ComenIncorrectoA = $lista['ComenIncorrectoA'];
    $this->CorrectoP = $lista['CorrectoP'];
    $this->ComentIncorrectoP = $lista['ComentIncorrectoP'];
    $this->OK = $lista['OK'];
    $this->listaHistorias = $listaHistorias;

    $this->render();
}


//funcion que muestra los datos al usuario

function render(){

  include '../Views/Header.php';   

?>
     <section class="pagina">
            <table class="showcurrent" style="width: 70%; margin-left: 15%">
             <caption><?php echo $strings['Mostrar evaluacion'] ?></caption>
                <tr><th colspan="2"><?php echo $strings['Campo'] ?></th>
                    
                    <th style="border-right-style: collapse; border-right:  5px solid black;" ><?php echo $strings['Valor'] ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo $strings['IdTrabajo'] ?></th>
                    <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->IdTrabajo ?></td>     
                </tr>
                <tr>
                    <th colspan="2"><?php echo $strings['LoginEvaluador'] ?></th>
                    <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->LoginEvaluador ?></td>
                </tr>
                <tr>
                    <th colspan="2"><?php echo $strings['AliasEvaluado'] ?></th>
                    <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->AliasEvaluado ?></td>
                </tr>    

                <tr>
                    <th colspan="8" style="border-top-style: collapse; border-top:  5px solid black;
                                           border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['Historias'] ?></th>
                </tr>
                    
                <tr>
                    <th colspan="1"><?php echo $strings['Id de la historia'] ?></th>
                    <th colspan="2"><?php echo $strings['Texto de la historia'] ?></th>
                    <th colspan="2"><?php echo $strings['ComentarioInc'] ?></th>
                    <th colspan="2"><?php echo $strings['CorrectoA'] ?></th>
                    <th colspan="1" style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['Acciones'] ?></th>
                </tr>
                


    <?php       
 
            while($row = mysqli_fetch_array($this->listaHistorias)) { //Mientras haya tuplas en la BD
    ?>
                <tr>
                    <td style="width: 5%"><?php echo $row["IdHistoria"]; ?></td>
                    <td colspan="2"><?php echo $row["TextoHistoria"]; ?></td>
                    <td colspan="2"><?php echo $row["ComenIncorrectoA"]; ?></td>
                    <td colspan="2"><?php echo $row["CorrectoA"]; ?></td>
                    <td>
                        <a href="../Controllers/EVALUACION_Controller.php?action=EDIT&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $row["IdHistoria"] ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="EDIT"></a>
                    </td>
                </tr>              
           
    <?php
              }//fin del while
    ?>

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