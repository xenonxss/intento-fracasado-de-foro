<?php
include("auth.php");
$autor = 'webmaster';



include_once("database.php");

#subir mensajes


#imprimir mensajes

//NO HAGAS ESTO NUNCA @xenonxss
//NUNCA DECLARES UN QUERY EN EL TOP DE LA PAGINA PARA USARLO MAS ABAJO, DECLARALO DONDE LO VAYAS A USAR

//$sql = "SELECT * FROM `chatmensajes`";
//$resultado = mysqli_query($link, $sql);
//$resultadocheck = mysqli_num_rows($resultado); 


?>

<html>
<head>
    <title>Forox chat</title>
    <link type="text/css" rel="stylesheet" href="chatstyle.css" />
    <link type="text/css" rel="stylesheet" href="./webchatcolors.css"/>
    <link type="text/css" rel="stylesheet" href="./msgstyle.css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<body>
<div class="webchat">
    

    <div class="box" id="chatbox">
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