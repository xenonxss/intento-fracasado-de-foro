<?php
include("auth.php");
include_once("database.php");

?>

<html>
<head>
    <title>Forox chat</title>
    <link type="text/css" rel="stylesheet" href="chatstyle.css" />
    <link type="text/css" rel="stylesheet" href="./webchatcolors.css"/>
    <link type="text/css" rel="stylesheet" href="./msgstyle.css"/>
    <link type="text/css" rel="stylesheet" href="./navheadchat.css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<body onload="mueveReloj()">
<div class="nav-head">
    <div class="nav-items">
        <?php
            $sql = "SELECT * FROM `users`";
            $resultado = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($resultado)
        ?>
        <a class="bienvenida">Bienvenid@ a Forox <?php echo $row['user'] . "!"; ?></a>
        <a class="info" href="#info">Sobre Forox</a>
        <a class="reloj" id="reloj"></a>
        <script>
            function mueveReloj(){
                momentoActual = new Date()
                hora = momentoActual.getHours()
                minuto = momentoActual.getMinutes()
                segundo = momentoActual.getSeconds()

                horaImprimible = hora + " : " + minuto + " : " + segundo

                document.getElementById('reloj').textContent = horaImprimible 
                setTimeout("mueveReloj()",1000)
            }
        </script>
    </div>
</div>
<div class="webchat">
    <div class="box" id="chatbox">
        <h3>.................Que haces aquí?............................................................. No querrás descubrir algo de lo que puedas arrepentirte.</h3>
        <?php
        $sql = "SELECT * FROM `chatmensajes`";
        $resultado = mysqli_query($link, $sql);
        $resultadocheck = mysqli_num_rows($resultado);
        if ($resultadocheck > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
        ?>      <div class="mensaje">
               
                <div class='msgprofilepicbox'><?php
                            echo "<img class='msgprofilepic' src=" . $row['profilepic'] . ">";
                        ?></div>
                        <div class="msgcontent"><?php
                            echo "<a class=msgautor>". $row['autor'] . "</a>" . "<a class=msgtime>" . " " . date('m/d H:i',$row['time']) . "</a>";
                            echo "<br>";
                            echo "<a class=msgbody" . ">" . $row['mensaje'] . "</a>";
                            echo "<br>";
                        ?></div>
                    </div>
               
    <?php
            }
        }
    ?>
    </div>
    
        
  
</div>
<div class="boxform">
            <div class="formulario">
                <input name="subirmensaje" type="text" class="msgbox" id="msgbox" size="63" required />
                <input name="subirboton" type="submit" class="msgbutton" id="msgbutton" value="Enviar" onclick="enviar()" />
            </div>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function enviar() {
        var mensaje = document.getElementById('msgbox').value;
        if (mensaje != "") {

            document.getElementById('msgbox').disabled = true;
            $.ajax({
                type: "POST",
                url: "chatframework.php",
                data: {
                    subirmensaje: mensaje,
                },
                success: function(datos) {
                    document.getElementById('chatbox').innerHTML = datos;
                    document.getElementById('msgbox').value = '';
                    document.getElementById('msgbox').disabled = false;
                    document.getElementById('msgbox').focus();
                    var scrollingElement = document.getElementById('chatbox');
                    scrollingElement.scrollTop = scrollingElement.scrollHeight;
                }
            })
        } else {
            document.getElementById('msgbox').classList.add('error');
            document.getElementById('msgbox').focus();

            window.setTimeout(function() {
                document.getElementById('msgbox').classList.remove('error');

            }, 800)
        }
    }
</script>
</body>

</html>