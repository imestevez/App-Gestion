<?php
/*
//Clase : FUNC_ACCION_SHOWALL
//Creado el : 09-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista de los usuarios de la BD

*/
    class FUNC_ACCION_SHOWALL{
    var $IdFuncionalidad; //declaración del atributo IdFuncionalidad
    var $NombreFuncionalidad; //declaración del atributo NombreFuncionalidad
    var $DescripFuncionalidad; //declaración del atributo DescripFuncionalidad
    var $lista; //lista con los grupos de un usuario
    var $datos;
//constructor de la clase
function __construct($lista, $datos){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdFuncionalidad = $lista['IdFuncionalidad'];
    $this->NombreFuncionalidad = $lista['NombreFuncionalidad'];
    $this->DescripFuncionalidad = $lista['DescripFuncionalidad'];
    $this->datos = $datos;



    $this->render();
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina">
            <table class="showcurrent">
                <caption><?php echo $strings['Acciones de Funcionalidad'] ?></caption>
                <tr><th style="width: 5%"><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th><th><?php echo $strings['Acciones'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['Id Funcionalidad'] ?></th><td><?php echo $this->IdFuncionalidad ?></td>


                    <td style="border-right-style: collapse; border-bottom:  5px solid black;">

<?php 
                    foreach ($acciones as $key => $value) {
                        if($value == 'ASIG'){
                ?>
                     <a href="../Controllers/FUNC_ACCION_Controller.php?action=ASIG&IdFuncionalidad=<?php echo $this->IdFuncionalidad ?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="ASIG"></a>
                    
                    <?php
                }

                    }
                ?>

                    </td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Nombre Funcionalidad'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->NombreFuncionalidad ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Descripción Funcionalidad'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->DescripFuncionalidad ?></td></tr>
                <tr ><th  style="border-top-style: collapse; border-top:  5px solid black; border-right-style: collapse; border-right:  5px solid black;" COLSPAN="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strings['Acciones'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['Id de la accion'] ?></th><th style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['Nombre de la accion'] ?></th></tr>
<?php
                while($row = mysqli_fetch_array($this->datos)){

?>
                <tr> 
                <td style="width: 5%"><?php echo $row['IdAccion'] ?></td>
                <td style="border-right-style: collapse; border-right:  5px solid black;"> <?php echo $row['NombreAccion'] ?></td>

            </tr>
<?php
                }
?>
            </table>
            <div class="accionesTable">
                <a href="../Controllers/ACCION_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

    </section>  
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>