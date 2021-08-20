<?php
    include("database.php");
   
    $sql = "SELECT * FROM `chatmensajes`";
    $resultado = mysqli_query($link, $sql);
    $resultadocheck = mysqli_num_rows($resultado);
    
    if ($resultadocheck > 0){
        while($row = mysqli_fetch_assoc($resultado)){
            echo $row['mensaje'];
            echo "<br>";
        }
    }
?>

<html>
<head>
    <title>Forox chat</title>
    <link type="text/css" rel="stylesheet" href="indexstyle.css" />
</head>
 
<div>
  <div id="menu">
        <p class="welcome">Forox private chat, </p>
        <p class="logout"><a id="exit" href="#">Salir</a></p>
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox"></div>
    
    <form id="chat" name="chat" method="POST">
        <input name="subirmensaje" type="text" id="usermsg" size="63" />
        <input name="subirboton" type="submit"  id="submitmsg" value="Enviar" onclick="enviar()" />
    </form>
</div>

<script type="text/javascript">
    function enviar(){
        document.getElementById("").submit();
        <?php
            $mensaje = $_POST['subirmensaje'];
            $sql = "INSERT INTO `chatmensajes` (`autor`, `mensaje`) VALUES ('guest', '$mensaje');";
            mysqli_query($link, $sql);
            ?>
            window.location.reload()
            document.getElementById("subirmensaje").remove
            <?php
        ?>
    }

</script>
</body>
</html>