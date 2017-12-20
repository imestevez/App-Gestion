<?php
/*
//Clase : NOTA_TRABAJO_DELETEALL
//Creado el : 20-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado de la nota seleccionada

*/
class NOTA_TRABAJO_DELETEALL{
    var $login; //declaración del atributo login
    var $Nombre; //declaración del atributo Nombre
    var $notas; //declaración del atributo donde vamos guardar la nota total
    var $case2;
    
function __construct($lista,$notas){
    $this->login = $lista['login'];
    $this->Nombre = $lista['Nombre'];
    $this->notas = $notas;
    $this->case2 = 0;
    $this->render();
}


function render(){

  include '../Views/Header.php';   

?>
    <section class="pagina" style="min-height: 500px">
        <table class="showcurrent">
            <caption><?php echo $strings['Borrar todas las notas para este usuario'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Login'] ?></th><td><?php echo $this->login ?></td></tr>
                <tr><th><?php echo $strings['Nombre'] ?></th><td><?php echo $this->Nombre ?></td></tr>
                <tr><th><?php echo $strings['Nota Total'] ?></th><td><?php echo $this->notas[$this->login] ?></td></tr>
                
        </table>

        <form method="post" name="DELETE" action="../Controllers/NOTA_TRABAJO_Controller.php">
            <input class="del" type="text" name="login" size="<?php echo strlen($this->login); ?>" readonly value="<?php echo $this->login ?>" >
            <input class="del" type="text" name="Nombre" size="<?php echo strlen($this->Nombre); ?>" readonly  value="<?php echo $this->Nombre ?>">
            <input class="del" type="text" name="notas" size="<?php echo strlen($this->notas[$this->login]); ?>" readonly value="<?php echo $this->notas[$this->login] ?>" >
            <input class="del" type="text" name="case2" size="<?php echo strlen($this->case2); ?>" readonly value="<?php echo $this->case2?>">
           
            <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%">
                <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=DELETE&login=<?php echo $this->login ?>&case2=<?php echo $this->case2?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar Nota'] ?>" ></a>
            </div>
        </form>

        <div class="accionesTable" style="float: left;">
            <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
        </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>