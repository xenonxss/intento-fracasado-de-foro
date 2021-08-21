<?php
include("auth.php");
$autor = 'webmaster';



    include_once("database.php");

    #subir mensajes
    if(isset($_POST['subirmensaje'])){
        $time = time();
        $date = gmdate("Y-m-d\TH:i:s\Z", $time);
        $mensaje = $_POST['subirmensaje'];
        $sql = "INSERT INTO `chatmensajes` (`time`, `autor`, `mensaje`) VALUES ('$date', '$autor', '$mensaje');";
        mysqli_query($link, $sql);
        
    }
    
    #imprimir mensajes
    $sql = "SELECT * FROM `chatmensajes`";
    $resultado = mysqli_query($link, $sql);
    $resultadocheck = mysqli_num_rows($resultado);
    $stylemensajes = "mensajes";

    
?>

<html>
<head>
    <title>Forox chat</title>
    <link type="text/css" rel="stylesheet" href="chatstyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<div class="webchat">
    <div class="barra-navegacion">
        <nav class="nav-elementos">
            <a>si</a>
            <a>aaaa</a>
        </nav>
    </div>
    
    <div class="box">
        <?php
            if ($resultadocheck > 0){
                    while($row = mysqli_fetch_assoc($resultado)){
                        ?><div class="mensaje"> <?php
                            echo "<a class=".$stylemensajes.">(" . $row['time'] . ") " . $row['autor'] .": ". $row['mensaje'] . "</a>";
                            echo "<br>";
                        ?></div><?php
                    }
                }
        ?>
    </div>
    <div class="boxform">
        <div class="formulario">    
            <form id="chat" name="chat" method="POST">
                <input name="subirmensaje" type="text" class="msgbox" id="msgbox" size="63" required />
                <input name="subirboton" type="submit"  class="msgbutton" id="msgbutton" value="Enviar" onclick="enviar()" />
            </form>
        </div>
    </div>
    
</div>
<script type="text/javascript">
    function enviar(){
        document.getElementById('form').submit()
    }
</script>
</body>
</html>