<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 07/12/2017
	Descripción: Vista para mostrar todas las asignaciones de QAs.

*/

class ASIGNAC_QA_SHOWALL{

    var $datos;  //tuplas almacenadas en la BD
    var $origen; //Almacena el origen de la orden
    var $lista; // array para almacenar los datos del usuario
    var $total_tuplas; //El numero te tuplas del recordset
    var $num_tupla; //Variable para almacenar el número de tuplas mostradas
    var $max_tuplas ; //Máximo de tuplas a mostrar por página
    var $num_pagina; //Numero de página a mostrar
    var $orden ; //Vista desde la que se envia la orden

//constructor de la clase
function __construct($lista, $datos,$num_tupla,$max_tuplas,$totalTuplas,$num_pagina, $orden, $origen){
    //asignación de valores de parámetro a los atributos de la clase
    $this->datos = $datos;
    $this->origen = $origen;
    $this->lista = $lista;
    $this->total_tuplas = $totalTuplas;
    $this->num_tupla = $num_tupla;
    $this->max_tuplas = $max_tuplas;
    $this->num_pagina = $num_pagina;
    $this->orden = $orden ;
    
    if( $this->orden <>'SEARCH'){ //si no viene del search
        $this->render();
    }else{//si viene del search
        $this->renderSearch();
    }
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina" style="min-height: 800px; height: 100%;" >

				<table class="showAll">
                <caption><?php echo $strings['Asignación de QAs']?></caption>
                <tr>
                <th rowspan="2"><?php echo $strings['Id del trabajo']?></th> 
                <th rowspan="2"><?php echo $strings['Nombre del trabajo']?></th>  
                <th rowspan="2"><?php echo $strings['Login del evaluador']?></th>
                <th rowspan="2"><?php echo $strings['Login del evaluado']?></th>
                <th rowspan="2"><?php echo $strings['Alias del evaluado']?></th>      
                <td rowspan="2">
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=SEARCH"><input type="image" src="../Views/images/search.png" name="action" title="<?php echo $strings['Buscar']?>" value="SEARCH"></a>
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=ADD" ><input type="image" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Añadir']?>" value="ADD" ></a>
                </td>
                    <th><?php echo $strings['Asignación auto. de QAs']?></th>
                    <td>
                        <a href="../Controllers/ASIGNAC_QA_Controller.php?action=GENQA" ><input type="image" src="../Views/images/flecha-reproducir.png" name="action" title="<?php echo $strings['Asignación automática de QAs']?>" value="GENQA" ></a>
                    </td>    
                </tr>
                <tr>
                    <th><?php echo $strings['Gen. historias evaluación']?></th>
                    <td>
                        <a href="../Controllers/ASIGNAC_QA_Controller.php?action=GENEV" ><input type="image" src="../Views/images/flecha-reproducir.png" name="action" title="<?php echo $strings['Generación de historias a evaluar']?>" value="GENEV" ></a>
                    </td> 
                </tr>
<?php		
 
			while( ($this->num_tupla < $this->max_tuplas) && ($row = mysqli_fetch_array($this->datos)) ) { //Mientras el numero de tuplas no llegue al máximo y haya tuplas en la BD
?>
                <tr>
                <td><?php echo $row["IdTrabajo"]; ?></td>
                <td><?php echo $row["NombreTrabajo"]; ?></td>
                <td><?php echo $row["LoginEvaluador"]?></td>
                <td><?php echo $row["LoginEvaluado"]?></td>
                <td><?php echo $row["AliasEvaluado"]; ?></td>

                <td class="edit_tabla">
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=SHOWCURRENT&IdTrabajo=<?php echo $row["IdTrabajo"]?>&LoginEvaluador=<?php echo $row["LoginEvaluador"]?>&AliasEvaluado=<?php echo $row["AliasEvaluado"]?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOWCURRENT" action=""></a>
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=EDIT&IdTrabajo=<?php echo $row["IdTrabajo"]?>&LoginEvaluador=<?php echo $row["LoginEvaluador"]?>&AliasEvaluado=<?php echo $row["AliasEvaluado"]?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="EDIT"></a>
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=DELETE&IdTrabajo=<?php echo $row["IdTrabajo"]?>&LoginEvaluador=<?php echo $row["LoginEvaluador"]?>&AliasEvaluado=<?php echo $row["AliasEvaluado"]?>"><input type="image" src="../Views/images/delete.png" name="action" title="<?php echo $strings['Eliminar'] ?>" value="DELETE"></a>
                </td>
                </tr>              
           
<?php
	$this->num_tupla++;//incremento del numero de tupla
	}//fin del while
?>
     </table>
    <div class="acciones">

<?php


        if($this->num_pagina > 0){ // Si la tupla 1 mostrada es la primera de la BD
?>
         <a href="../Controllers/ASIGNAC_QA_Controller.php?num_pagina=<?php echo $this->num_pagina-1?>&action=SHOWALL"><input type="image" src="../Views/images/prev.png" name="action" title="<?php echo $strings['Anterior'] ?>" value="PREV"></a>
<?php
        } //Fin del if si es la 1ª tupla

        if($this->max_tuplas < $this->total_tuplas){ //Si la tupla mostrada es la última de la BD
?>
        <a href="../Controllers/ASIGNAC_QA_Controller.php?num_pagina=<?php echo $this->num_pagina+1?>&action=SHOWALL"><input type="image" src="../Views/images/next.png" name="action" title="<?php echo $strings['Siguiente'] ?>" value="NEXT"></a>
<?php
        }//Fin del if si es la ultima tupla

?>
    </div>
</section>


<?php
  include '../Views/Footer.php';
    
	}//fin render()

function renderSearch(){
  include '../Views/Header.php';

?>
     <section class="pagina"  style="min-height: 500px; height: 100%;">
                <table class="showAll">
                 <caption><?php echo $strings['Resultado de búsqueda: Asignación de QAs']?></caption>
                <tr>
                <th><?php echo $strings['Id del trabajo']?></th> 
                <th><?php echo $strings['Nombre del trabajo']?></th>  
                <th><?php echo $strings['Login del evaluador']?></th>
                <th><?php echo $strings['Login del evaluado']?></th>
                <th><?php echo $strings['Alias del evaluado']?></th> 

                <td><a href="../Controllers/ASIGNAC_QA_Controller.php?action=SEARCH"><input type="image" src="../Views/images/search.png" name="action" title="<?php echo $strings['Buscar']?>" value="SEARCH"></a>
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=ADD" ><input type="image" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Añadir']?>" value="ADD" ></a>
                </td>
                </tr>
<?php
            while( $row = mysqli_fetch_array($this->datos)) { //Mientras el numero de tuplas no llegue al máximo y haya tuplas en la BD
?>  <tr>
                <td><?php echo $row["IdTrabajo"]; ?></td>
                <td><?php echo $row["NombreTrabajo"]; ?></td>
                <td><?php echo $row["LoginEvaluador"]?></td>
                <td><?php echo $row["LoginEvaluado"]?></td>
                <td><?php echo $row["AliasEvaluado"]; ?></td>
                

             <td class="edit_tabla">
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=SHOWCURRENT&IdTrabajo=<?php echo $row["IdTrabajo"]?>&LoginEvaluador=<?php echo $row["LoginEvaluador"]?>&AliasEvaluado=<?php echo $row["AliasEvaluado"]?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOWCURRENT" action=""></a>
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=EDIT&IdTrabajo=<?php echo $row["IdTrabajo"]?>&LoginEvaluador=<?php echo $row["LoginEvaluador"]?>&AliasEvaluado=<?php echo $row["AliasEvaluado"]?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="EDIT"></a>
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=DELETE&IdTrabajo=<?php echo $row["IdTrabajo"]?>&LoginEvaluador=<?php echo $row["LoginEvaluador"]?>&AliasEvaluado=<?php echo $row["AliasEvaluado"]?>"><input type="image" src="../Views/images/delete.png" name="action" title="<?php echo $strings['Eliminar'] ?>" value="DELETE"></a>
                </td>
                </tr>                
           
<?php
    }
?>
     </table>
    <div class="acciones">

<?php

    if(isset($_REQUEST['action'])){ //si viene de un formulario
        if($_REQUEST['action'] == 'SEARCH'){  //Si se muestra a partir de un SEARCH
?>
           <a href="../Controllers/ASIGNAC_QA_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" name="action" title="<?php echo $strings['Volver'] ?>" value="BACK"></a>
<?php
        }
    }//Fin del if si es SEARCH
?>
    </div>
</section>


<?php
  include '../Views/Footer.php';
    
    }    //fin renderSearch()

} //fin de la clase SHOWALL
?>
