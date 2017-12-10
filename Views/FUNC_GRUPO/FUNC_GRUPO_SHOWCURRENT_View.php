<?php
/*
//Clase : FUNC_GRUPO_SHOWALL
//Creado el : 09-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista de los usuarios de la BD

*/
    class FUNC_GRUPO_SHOWALL{
    var $IdGrupo; //declaración del atributo IdFuncionalidad
    var $NombreGrupo; //declaración del atributo NombreFuncionalidad
    var $DescripGrupo; //declaración del atributo DescripFuncionalidad
    var $lista; //lista con los grupos de un usuario
    var $datos;
//constructor de la clase
function __construct($lista, $datos){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdGrupo = $lista['IdGrupo'];
    $this->NombreGrupo = $lista['NombreGrupo'];
    $this->DescripGrupo = $lista['DescripGrupo'];
    $this->datos = $datos;



    $this->render();
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina">
            <table class="showcurrent">
                <caption><?php echo $strings['Acciones de grupo'] ?></caption>
                <tr><th style="width: 5%"><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th><th><?php echo $strings['Acciones'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['IdGrupo'] ?></th><td><?php echo $this->IdGrupo ?></td><td style="border-right-style: collapse; border-bottom:  5px solid black;"> <a href="../Controllers/FUNC_GRUPO_Controller.php?action=EDIT&IdGrupo=<?php echo $this->IdGrupo ?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="EDIT"></a></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['NombreGrupo'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->NombreGrupo ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['DescripGrupo'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->DescripGrupo ?></td></tr>
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