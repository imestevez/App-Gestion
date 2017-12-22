<?php
/*
//Clase : FUNC_GRUPO_EDIT
//Creado el : 09-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Vista que permite editar las acciones de una funcionalidad

*/
    class FUNC_GRUPO_EDIT{
    var $IdGrupo; //declaración del atributo IdGrupo
    var $NombreGrupo; //declaración del atributo NombreGrupo
    var $DescripGrupo; //declaración del atributo DescripGrupo
    var $lista; //lista con las acciones de una funcionalidad
    var $propios; //las acciones de una funcionalidad
    var $todos; //todas las acciones que hay en la BD
    var $ListaPropios; //Lista de acciones de la funcionalidad
    var $ListaRestantes;//Lista de acciones restantes a las de la funcionalidad
  

//constructor de la clase
function __construct($lista, $propios, $todos){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdGrupo = $lista['IdGrupo'];
    $this->NombreGrupo = $lista['NombreGrupo'];
    $this->DescripGrupo = $lista['DescripGrupo'];
    $this->propios = $propios;
    $this->todos = $todos;
    $this->numPropios = 0;
    $this->numTodos = 0;
    $this->ListaPropios = null;
    $this->ListaRestantes  = null;;//Lista de acciones restantes a las de la funcionalidad


    $this->rellenarPropios();
    $this->rellenarRestantes();

    $this->render();
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>

<script type="text/javascript">
    
    <?php include '../Views/js/validacionesCheckbox.js' ?>

</script>

    <section class="pagina">
        
        <form method="post" name="EDIT" action="../Controllers/FUNC_GRUPO_Controller.php" enctype="multipart/form-data">

            <table class="showcurrent">
                <caption><?php echo $strings['Asignar/Desasignar Acciones'] ?></caption>
                <tr><th style="width: 5%"><?php echo $strings['Campo'] ?></th><th colspan="3" style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['Valor'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['IdGrupo'] ?></th><td colspan="3" style="border-right-style: collapse; border-right:  5px solid black;"> <?php echo $this->IdGrupo ?> </td></tr>
                <tr><th style="width: 5%"><?php echo $strings['NombreGrupo'] ?></th><td colspan="3" style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->NombreGrupo ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['DescripGrupo'] ?></th><td colspan="3" style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->DescripGrupo ?></td></tr>

                <tr ><th style="border-top-style: collapse; border-top:  5px solid black; " COLSPAN="2" ><?php echo $strings['Funcionalidades'] ?></th>
                <th style="border-top-style: collapse; border-top:  5px solid black; border-right-style: collapse; border-right:  5px solid black;" COLSPAN="2" ><?php echo $strings['Acciones'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['Id Funcionalidad'] ?></th><th><?php echo $strings['Nombre Funcionalidad'] ?></th> <th style="width: 5%"><?php echo $strings['Id de la accion'] ?></th><th style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['Nombre de la accion'] ?></th> <th style="border-top-style: collapse; border-top:  5px solid black;"><?php echo $strings['Seleccionar Acciones'] ?></th></tr>
<?php
                //Si el usuario tiene grupos asignados
                if(count($this->ListaPropios) > 0){
                foreach ($this->ListaPropios as $key => $value) { //recorremos la lista de sus grupos

?>
                <tr> 
                <td style="width: 5%"><?php echo $value[0] ?></td>
                <td><?php echo $value[1] ?></td>
                <td style="width: 5%"><?php echo $value[2]  ?></td>
                <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $value[3] ?></td>
                <td ><input type="checkbox" name="checkbox[]" id="<?php echo  $key ?>" value="<?php echo $value[0] . "+" .$value[2] ?>" checked > </td>

            </tr>
<?php
                } //fin foreach
            }//fin if
?>

<?php
                //Si hay mas grupos de los asignados
                if(count($this->ListaRestantes) > 0){
                    foreach ($this->ListaRestantes as $key => $value) {//recorremos la lista de grupos
    ?>
                     <tr> 
                <td style="width: 5%"><?php echo $value[0] ?></td>
                <td><?php echo $value[1] ?></td>
                <td style="width: 5%"><?php echo $value[2]  ?></td>
                <td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $value[3] ?></td>
                <td ><input type="checkbox" name="checkbox[]" id="<?php echo  $key ?>" value="<?php echo $value[0] . "+" .$value[2] ?>" > </td>

            </tr>
    <?php
                 } //fin foreach
            }//fin if
?>
            </table>

                <input type="text" name="IdGrupo" value="<?php echo $this->IdGrupo?>" style="visibility: hidden;" >
                <div  style="float: right; margin-left: 0%; margin-right: 50% ; margin-top: 2%">
                    <a href="../Controllers/FUNC_GRUPO_Controller.php?action=ASIG"> <input type="image" name="action" value="ASIG"  onclick="return validarCheck('EDIT');" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" "></a>
                </div>
 <input type="text" name="IdGrupo" value="<?php echo $this->IdGrupo ?>" style="visibility: hidden;" >
        </form>
            <div class="acciones" style="float: left; ">
                <a href="../Controllers/FUNC_GRUPO_Controller.php?action=ALL&IdGrupo=<?php echo $this->IdGrupo ?>"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

    </section>  
<?php
  include '../Views/Footer.php';

    }//fin de render()


//Funcion para rellenar las ListaPropios
function rellenarPropios(){
$num=0;
    while($row = mysqli_fetch_array($this->propios)){
        $this->ListaPropios[$num]= array($row['IdFuncionalidad'], $row['NombreFuncionalidad'], $row['IdAccion'], $row['NombreAccion']);
        $num++;
    }


}
//Funcion para rellenar las ListaRestantes
function rellenarRestantes(){
$num=0;
  while($row = mysqli_fetch_array($this->todos)){
    //Si tiene alguno asignado y existe el ID en propios

    if( (count($this->ListaPropios) > 0)){

        if($this->comprobarExistencia($row) ==  false) { 
           $this->ListaRestantes[$num]= array($row['IdFuncionalidad'], $row['NombreFuncionalidad'], $row['IdAccion'], $row['NombreAccion']);
        $num++;
        } 
    }else{
          $this->ListaRestantes[$num]= array($row['IdFuncionalidad'], $row['NombreFuncionalidad'], $row['IdAccion'], $row['NombreAccion']);
        $num++;
    }
     
    }
}

function comprobarExistencia($row){
    foreach ($this->ListaPropios as $key => $value) {
        if(($value[0] == $row["IdFuncionalidad"]) && ($value[2] == $row["IdAccion"]) ){
            return true;
        }

        # code...
    }
    return false;
}
}//fin de la clase



?>