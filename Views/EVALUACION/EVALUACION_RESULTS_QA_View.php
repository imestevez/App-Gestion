<?php
/*

//Clase : EVALUACION_RESULTS_View
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear editar los tabajos

*/
class EVALUACION_RESULTS_QA{

    var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA
    var $datos;
    var $aliasEvaluados;
    var $contarHistorias;
    var $contarAlias;
    var $rellenarHistorias;

function __construct($lista, $aliasEvaluados, $contarAlias, $contarHistorias){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->lista = $lista;
    $this->LoginEvaluador = $lista['LoginEvaluador'];
    $this->aliasEvaluados = $aliasEvaluados;
    $this->contarHistorias = $contarHistorias;
    $this->contarAlias = $contarAlias;


    $this->render();
}

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';

?>

<script type="text/javascript">

</script>

     <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Resultados'] ?></legend>

            <table class="tablaRESULTS">
                 
    
                    <tr>
                        <td colspan="1" class="InicialIzq"><?php echo $strings['Login']?>:</td>
                        <td colspan="4" class="InicialDer"><?php echo $this->LoginEvaluador ?></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="InicialIzq"><?php echo $strings['IdTrabajo']?>:</td>
                        <td colspan="4" class="InicialDer"><?php echo $this->IdTrabajo ?></td>
                    </tr>
            
                <?php



                    for ($j=0; $j < $this->contarAlias ; $j++) { //mientras haya historias
                     

                    $init2 = 0;
                    $fin2 = $init2 + $this->contarHistorias;

                ?>   
                        
                        <tr>
                            <td colspan="1" class="InicialIzq"><?php echo $strings['Alias']?></td>
                            <td colspan="4" class="InicialDer"><?php echo $this->aliasEvaluados[$j*$this->contarHistorias][0]?></td>
                        </tr>

                       
                       
                <?php
                        for ($i=$init2; $i < $fin2 ; $i++) { 

                ?>

                            <tr>
                                <td colspan="1" class="InicialIzq"><?php echo $strings['IdHistoria']?></td>
                                <td colspan="4" class="InicialDer"><?php echo $strings['TextoHistoria']?></td>
                            </tr>
                            <tr>
                                <td colspan="1" class="InicialIzq"><?php echo $this->aliasEvaluados[$i][1]?></td>
                                <td colspan="4" class="InicialDer"><?php echo $this->aliasEvaluados[$i][2]?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="InicialIzq"><?php echo $strings['CorrectoAOK']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="InicialIzq"><?php echo $this->aliasEvaluados[$i][3]?></td>
                                <td colspan="3" class="InicialIzq"><?php echo $this->aliasEvaluados[$i][4]?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="InicialIzq"><?php echo $strings['ComenIncorrectoA']?></td>
                            </tr>
                            <tr>
                                <td class="comentA" colspan="5">
                                    <textarea name="ComenIncorrectoA" readonly maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue; width: 90%;" ><?php echo $this->aliasEvaluados[$i][5] ?></textarea> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="InicialIzq"><?php echo $strings['ComentIncorrectoP']?></td>
                            </tr>
                            <tr>
                                <td class="comentA" colspan="5"> 
                                <textarea name="ComentIncorrectoP" readonly maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue; width: 90%;" ><?php echo $this->aliasEvaluados[$i][6] ?></textarea>
                                </td>
                            </tr>




                <?php
                            }//fin for2
                              
                            $init2 = $i;
                            $fin2 = $init2 + $this->contarHistorias;  




                }//fin for1
                            
                

                ?>
                   </table>                        
         </fieldset> 
                          
                <div class="acciones" style="float: left; margin-left: 45%">
                     <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
    </section>
<?php
        include '../Views/Footer.php';
    }


}

?>
