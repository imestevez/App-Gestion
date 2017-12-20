<?php
/*
//Clase : USU_GRUPO_SHOWALL
//Creado el : 06-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista de los usuarios de la BD

*/
    class USU_GRUPO_SHOWALL{
    var $login; //declaración del atributo login del usuario
    var $nombre; //declaración del atributo nombre
    var $apellidos; //declaración del atributo apellidos
    var $lista; //lista con los grupos de un usuario
    var $acciones; //acciones que puede realizar el usuario
    var $datos;
//constructor de la clase
function __construct($lista, $datos,$acciones){
    //asignación de valores de parámetro a los atributos de la clase
    $this->login = $lista['login'];
    $this->nombre = $lista['Nombre'];
    $this->apellidos = $lista['Apellidos'];
    $this->acciones = $acciones;

    $this->datos = $datos;



    $this->render();
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina">
            <table class="showcurrent">
                <caption><?php echo $strings['Grupos de Usuario'] ?></caption>
                <tr><th style="width: 5%"><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th><th><?php echo $strings['Acciones'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['Login'] ?></th><td><?php echo $this->login ?></td>


                <td style="border-right-style: collapse; border-bottom:  5px solid black;">

                <?php 
                    foreach ($this->acciones as $key => $value) {
                        if($value == 'ASIG'){
                ?>
                    <a href="../Controllers/USU_GRUPO_Controller.php?action=ASIG&login=<?php echo $this->login ?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="ASIG"></a>
                    <?php
                }

                    }
                ?>
                 
             </td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Nombre'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->nombre ?></td></tr>
                <tr><th style="width: 5%"><?php echo $strings['Apellidos'] ?></th><td style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $this->apellidos ?></td></tr>
                <tr ><th  style="border-top-style: collapse; border-top:  5px solid black; border-right-style: collapse; border-right:  5px solid black;" COLSPAN="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strings['Grupos'] ?></th></tr>
                <tr><th style="width: 5%"><?php echo $strings['IdGrupo'] ?></th><th style="border-right-style: collapse; border-right:  5px solid black;"><?php echo $strings['NombreGrupo'] ?></th></tr>
<?php
                while($row = mysqli_fetch_array($this->datos)){

?>
                <tr> 
                <td style="width: 5%"><?php echo $row['IdGrupo'] ?></td>
                <td style="border-right-style: collapse; border-right:  5px solid black;"> <?php echo $row['NombreGrupo'] ?></td>

            </tr>
<?php
                }
?>
            </table>
            <div class="accionesTable">
                <a href="../Controllers/USUARIO_Controller.php?action=ALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

    </section>  
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>