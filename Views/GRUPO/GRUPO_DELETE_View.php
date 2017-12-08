<?php
/*
//Clase : GRUPO_DELETE
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado del grupo seleccionado

*/
class GRUPO_DELETE{

    var $IdGrupo; //declaración del atributo identificador del grupo
    var $NombreGrupo; //declaración del atributo nombre del grupo
    var $DescripGrupo; //declaración del atributo descripcion del grupo


function __construct($tupla){

    //asignación de valores de parámetro a los atributos de la clase
    $this->IdGrupo = $tupla['IdGrupo'];
    $this->NombreGrupo = $tupla['NombreGrupo'];
    $this->DescripGrupo = $tupla['DescripGrupo'];

    $this->render();
}

//funcion que muestra los datos al usuario

function render(){
    include '../Views/Header.php';

?>
     <section class="pagina" style="min-height: 900px">

           <table class="showcurrent">
             <caption><?php echo $strings['BorrarGrupo'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['IdGrupo'] ?></th><td><?php echo $this->IdGrupo ?></td></tr>
                <tr><th><?php echo $strings['NombreGrupo'] ?></th><td><?php echo $this->NombreGrupo ?></td></tr>
                <tr><th><?php echo $strings['DescripGrupo'] ?></th><td><?php echo $this->DescripGrupo ?></td></tr>
            </table>


       <form method="post" name="DELETE" action="../Controllers/GRUPO_Controller.php" enctype="multipart/form-data" >
                <input class="del" type="text" name="IdGrupo" maxlength="6" size="<?php echo strlen($this->IdGrupo); ?>" readonly value="<?php echo $this->IdGrupo ?>" >
                <input class="del" type="text" name="NombreGrupo" maxlength="60" size="<?php echo strlen($this->NombreGrupo); ?>" readonly value="<?php echo $this->NombreGrupo ?>">
                <input class="del" type="text"  name="DescripGrupo" maxlength="100" size="<?php echo strlen($this->DescripGrupo); ?>" readonly value="<?php echo $this->DescripGrupo ?>" >

                <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%">

                    <a href="../Controllers/GRUPO_Controller.php?action=DELETE&IdGrupo=<?php echo $this->IdGrupo ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['BorrarGrupo'] ?>" ></a>
                </div>
       </form>

                  <div class="accionesTable" style="float: left;">
                    <a href="../Controllers/GRUPO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
                    </div>    
        </section>
<?php

  include '../Views/Footer.php';

    }
}
?>