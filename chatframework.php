<?php
include_once('auth.php');
if (!isset($link)) {
    $link = "";
}
function sendchat($chat = "", $mensaje = "", $autor = "desconocido")
{
    $stylemensajes = "mensajes";

    include("database.php");
    $time = time(); //El tiempo guardalo como una variable en UNIX, mucho mejor
    $sql = "INSERT INTO `chatmensajes` (`time`, `autor`, `mensaje`) VALUES ('$time', '$autor', '$mensaje');";
    if (mysqli_query($link, $sql)) {
        $sql = "SELECT * FROM `chatmensajes`";
        $resultado = mysqli_query($link, $sql);
        $resultadocheck = mysqli_num_rows($resultado);
        if ($resultadocheck > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
?>
                <div class="mensaje">
                    <?php
                    echo "<a class=" . $stylemensajes . ">(" . date('Y/m/d H:i',$row['time']) . ") " . $row['autor'] . ": " . $row['mensaje'] . "</a>";
                    echo "<br>";
                    ?>
                </div><?php
                    }
                }
            } else {
                //reportar error al insertar

                echo mysqli_error($link);
            }
        }

        if (isset($_POST['subirmensaje'])) {
            
            sendchat('',$_POST['subirmensaje'], $userdata["user"]);
        }
