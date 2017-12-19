<?php
/*

//Clase : EVALUACION_RESULTS_View
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear editar los tabajos

*/
class EVALUACION_RESULTS{

    var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA
    var $listaHistorias;
    var $listaComentarios;
    var $datos;
    var $contar;
    var $contarHistorias;
    var $rellenarHistorias;

function __construct($lista, $listaHistorias, $contar, $contarHistorias, $rellenarHistorias){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->AliasEvaluado = $lista['AliasEvaluado'];
    $this->lista = $lista;
    $this->listaHistorias = $listaHistorias;
    $this->contar = $contar;
    $this->contarHistorias = $contarHistorias;
    $this->rellenarHistorias = $rellenarHistorias;
    $this->rellenarLista();


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
                 
                    
                <?php

                    $init = 0; //variable de inicio para for1
                    $fin = $init + $this->contar; //variable de fin para for1

                    $init2 = 0;
                    $fin2 = $init2 + $this->contar;

                    for ($j=0; $j < $this->contarHistorias ; $j++) { //mientras haya historias
                     
                ?>   
                        <tr>
                            <td colspan="1" class="InicialIzq"><?php echo $strings['IdHistoria']?></td>
                            <td colspan="4" class="InicialDer"><?php echo $strings['Texto de la historia'] ?></td>
                        </tr>
                        <tr> 
                            <td colspan="1" class="TstringsIzq"><?php echo $this->rellenarHistorias[$j][0]?></td> 
                            <td colspan="4" class="TstringsDer"><?php echo $this->rellenarHistorias[$j][1]?></td>
                        </tr>
                        <tr>
                            <td class="Comments" colspan="5">
                                <?php echo $strings['CorrectoA'] ?>  
                            </td>
                        </tr>

                    <?php
                       
                    ?>
                       
                        <?php
                            for ($i=$init; $i < $fin ; $i++) { 
                                $colorA = "#F5DCDC";
                                if($this->datos[$i][2] == 0){
                                    $colorA = '#FC2C2C';
                                }else{
                                    $colorA = '#30CE30';
                                }
                        ?>
                            <tr> 
                            
                                <td class="tdRESULTS" bgcolor="<?php echo $colorA?>" colspan="5" ></td>
                             </tr>
                        <?php
                              
                            }//fin for2
                            
                            $init = $i;
                            $fin = $init + $this->contar;

                        ?>
                       
                        <tr>
                                <td class="Comments" colspan="5"><?php echo $strings['ComenIncorrectoAlumnos']?></td>
                        </tr>
                        <?php
                            for ($k=$init2; $k < $fin2 ; $k++) { 
                            ?>
                            <tr>
                                <td class="comentA" colspan="5">


                                    <textarea name="ComenIncorrectoA" readonly maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue; width: 90%;" ><?php echo $this->datos[$k][3] ?></textarea>


                                    <?php //echo $this->datos[$k][3]?> 
                                </td>
                            </tr>
                            <?php
                              
                            }//fin for3
                            $init2 = $k;
                            $fin2 = $init2 + $this->contar;

                            $indiceComentarioP = $j* $this->contar;

                        ?>
                        <tr>
                                <td class="Comments" colspan="5"><?php echo $strings['ComentIncorrectoPCP']?></td>
                        </tr>
                        <?php 
                                        if($this->datos[$indiceComentarioP][4] == 0){
                                            $colorP = '#FC2C2C';
                                        }else{
                                            $colorP = '#43D23B';
                                        }
                         ?>
                        <tr> 
                            
                                <td class="tdRESULTS" bgcolor="<?php echo $colorP?>" colspan="5" ></td>
                        </tr>
                        <tr>
                            <td class="comentA" colspan="5"> 

                                <textarea name="ComentIncorrectoP" readonly maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue; width: 90%;" ><?php echo $this->datos[$indiceComentarioP][5] ?></textarea>


                                    <?php //echo $this->datos[$indiceComentarioP][5] ?>
                            </td>                          
                        </tr>

                        <?php
                    }// fin for1
                  
                ?>
        </table>
                          
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }


//rellenarLista)()
function rellenarLista(){
    $num = 0;
    while ($row = mysqli_fetch_array($this->listaHistorias)) {
        $this->datos[$num] = array($row['IdHistoria'], $row['LoginEvaluador'], $row['CorrectoA'], $row['ComenIncorrectoA'], $row['CorrectoP'], $row['ComentIncorrectoP'], $row['OK']);


        $num++;
    }

}

}

?>
