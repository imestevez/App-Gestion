<?php
/*
//Clase : FUNC_ACCION_EDIT
//Creado el : 09-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Vista que permite editar las acciones de una funcionalidad

*/
    class FUNC_ACCION_EDIT{
    var $IdFuncionalidad; //declaración del atributo IdFuncionalidad
    var $NombreFuncionalidad; //declaración del atributo NombreFuncionalidad
    var $DescripFuncionalidad; //declaración del atributo DescripFuncionalidad
    var $lista; //lista con las acciones de una funcionalidad
    var $propios; //las acciones de una funcionalidad
    var $todos; //todas las acciones que hay en la BD
    var $ListaPropios; //Lista de acciones de la funcionalidad
    var $ListaRestantes;//Lista de acciones restantes a las de la funcionalidad
  

//constructor de la clase
function __construct($lista, $propios, $todos){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdFuncionalidad = $lista['IdFuncionalidad'];
    $this->NombreFuncionalidad = $lista['NombreFuncionalidad'];
    $this->DescripFuncionalidad = $lista['DescripFuncionalidad'];
    $this->propios = $propios;
    $this->todos = $todos;
    $this->numPropios = 0;
    $this->numTodos = 0;
    $this->ListaPropios ;
    $this->ListaPropios ;

    $this->rellenarPropios();
    $this->rellenarRestantes();

    $this->render();
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina">
        
        <form method="post" name="EDIT" action="../Controllers/FUNC_ACCION_Controller.php" enctype="multipart/form-data">

            <table class="showcurrent">
                <caption><?php echo $strings['Asignar/Desasignar Acciones'] ?></caption>
                <tr><th style="width: 5%"><?php echo $strings['Campo'] ?></th><th style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['Valor'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['Id Funcionalidad'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->IdFuncionalidad ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Nombre Funcionalidad'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->NombreFuncionalidad ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Descripción Funcionalidad'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->DescripFuncionalidad ?></td></tr>

                <tr ><th style="border-top-style: collapse; border-top:  5px solid black; border-right-style: collapse; border-right:  5px solid black;" COLSPAN="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strings['Acciones'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['Id de la accion'] ?></th><th><?php echo $strings['Nombre de la accion'] ?></th> <th style="border-top-style: collapse; border-top:  5px solid black;"><?php echo $strings['Seleccionar Acciones'] ?></th></tr>
<?php
                //Si el usuario tiene grupos asignados
                if(count($this->ListaPropios) > 0){
                foreach ($this->ListaPropios as $key => $value) { //recorremos la lista de sus grupos

?>
                <tr> 
                <td style="width: 5%"><?php echo $key ?></td>
                <td><?php echo $this->ListaPropios[$key] ?></td>
                <td ><input type="checkbox" name="checkbox[]" id="<?php echo  $this->ListaPropios[$key] ?>" value="<?php echo $key ?>" checked > </td>

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
                    <td style="width: 5%"><?php echo $key ?></td>
                    <td><?php echo $this->ListaRestantes[$key] ?></td>
                    <td><input type="checkbox" name="checkbox[]" id="<?php echo $this->ListaRestantes[$key] ?>" value="<?php echo $key ?>" > </td>

                </tr>
    <?php
                 } //fin foreach
            }//fin if
?>
            </table>

                <input type="text" name="IdFuncionalidad" value="<?php echo $this->IdFuncionalidad?>" style="visibility: hidden;" >
                <div  style="float: right; margin-left: 0%; margin-right: 50% ; margin-top: 2%">
                    <a href="../Controllers/FUNC_ACCION_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" "></a>
                </div>

        </form>
            <div class="acciones" style="float: left; ">
                <a href="../Controllers/FUNC_ACCION_Controller.php?action=SHOWALL&IdFuncionalidad=<?php echo $this->IdFuncionalidad ?>"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

    </section>  
<?php
  include '../Views/Footer.php';

    }//fin de render()


//Funcion para rellenar las ListaPropios
function rellenarPropios(){

    while($row = mysqli_fetch_array($this->propios)){
        $this->ListaPropios[$row["IdAccion"]] = $row["NombreAccion"];
    }
}
//Funcion para rellenar las ListaRestantes
function rellenarRestantes(){
  while($row = mysqli_fetch_array($this->todos)){
    //Si tiene alguno asignado y existe el ID en propios
    if( (count($this->ListaPropios) > 0)){
        if( !array_key_exists($row["IdAccion"], $this->ListaPropios)) { 
            $this->ListaRestantes[$row["IdAccion"]] = $row["NombreAccion"]; //almacenamos en REstantes el id
        } 
    }else{
         $this->ListaRestantes[$row["IdAccion"]] = $row["NombreAccion"]; //almacenamos en REstantes el id
    }
     
    }
}
}//fin de la clase



?>