<?php
/*
//Clase : USU_GRUPO_EDIT
//Creado el : 06-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista de los usuarios de la BD

*/
    class USU_GRUPO_EDIT{
    var $login; //declaración del atributo login del usuario
    var $nombre; //declaración del atributo nombre
    var $apellidos; //declaración del atributo apellidos
    var $lista; //lista con los grupos de un usuario
    var $propios; //los grupos de un usuario
    var $todos; //todos los grupo que hay en la BD
    var $ListaPropios; //Lista de grupos del usuario
    var $ListaRestantes;//Lista de grupos restantes a los del usuario
  

//constructor de la clase
function __construct($lista, $propios, $todos){
    //asignación de valores de parámetro a los atributos de la clase
    $this->login = $lista['login'];
    $this->nombre = $lista['Nombre'];
    $this->apellidos = $lista['Apellidos'];
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
        
        <form method="post" name="EDIT" action="../Controllers/USU_GRUPO_Controller.php" enctype="multipart/form-data">

            <table class="showcurrent">
                <caption><?php echo $strings['Asignar/Desasignar Grupos'] ?></caption>
                <tr><th style="width: 5%"><?php echo $strings['Campo'] ?></th><th style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['Valor'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['Login'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->login ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Nombre'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->nombre ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Apellidos'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->apellidos ?></td></tr>

                <tr ><th style="border-top-style: collapse; border-top:  5px solid black; border-right-style: collapse; border-right:  5px solid black;" COLSPAN="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strings['Grupos'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['IdGrupo'] ?></th><th><?php echo $strings['NombreGrupo'] ?></th> <th style="border-top-style: collapse; border-top:  5px solid black;"><?php echo $strings['Seleccionar Grupos'] ?></th></tr>
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

                <input type="text" name="login" value="<?php echo $this->login?>" style="visibility: hidden;" >
                <div  style="float: right; margin-left: 0%; margin-right: 50% ; margin-top: 2%">
                    <a href="../Controllers/USU_GRUPO_Controller.php?action=ASIG"> <input type="image" name="action" value="ASIG" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" "></a>
                </div>

        </form>
            <div class="acciones" style="float: left; ">
                <a href="../Controllers/USU_GRUPO_Controller.php?action=SHOWALL&login=<?php echo $this->login ?>"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

    </section>  
<?php
  include '../Views/Footer.php';

    }//fin de render()


//Funcion para rellenar las ListaPropios
function rellenarPropios(){

    while($row = mysqli_fetch_array($this->propios)){
        $this->ListaPropios[$row["IdGrupo"]] = $row["NombreGrupo"];
    }
}
//Funcion para rellenar las ListaRestantes
function rellenarRestantes(){
  while($row = mysqli_fetch_array($this->todos)){
    //Si tiene alguno asignado y existe el ID en propios
    if( (count($this->ListaPropios) > 0)){
        if( !array_key_exists($row["IdGrupo"], $this->ListaPropios)) { 
            $this->ListaRestantes[$row["IdGrupo"]] = $row["NombreGrupo"]; //almacenamos en REstantes el id
        } 
    }else{
         $this->ListaRestantes[$row["IdGrupo"]] = $row["NombreGrupo"]; //almacenamos en REstantes el id
    }
     
    }
}
}//fin de la clase



?>