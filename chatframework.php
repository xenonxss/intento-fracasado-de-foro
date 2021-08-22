<?php
include_once('auth.php');
if (!isset($link)) {
    $link = "";
}
function updatechat()
{
    include("database.php");
    $sql = "SELECT * FROM `chatmensajes`";
    $resultado = mysqli_query($link, $sql);
    $resultadocheck = mysqli_num_rows($resultado);
    if ($resultadocheck > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
        <div class="mensaje">
        <div class='msgprofilepicbox'>
            <?php
            echo "<img class='msgprofilepic' src=" . $row['profilepic'] . ">";
            ?>
        </div>
        <div class="msgcontent">
            <?php
            echo "<a class=msgautor>" . $row['autor'] . "</a>" . "<a class=msgtime>" . " " . date('m/d H:i', $row['time']) . "</a>";
            echo "<br>";
            echo "<a class=msgbody" . ">" . $row['mensaje'] . "</a>";
            echo "<br>";
            ?>
        </div>
        </div>
        <?php
        }
    }
}
function sendchat($chat = "", $mensaje = "", $autor = "desconocido")
{
    $stylemensajes = "mensajes";

    include("database.php");
    $time = time(); //El tiempo guardalo como una variable en UNIX, mucho mejor
    $sql = "INSERT INTO `chatmensajes` (`time`, `autor`, `mensaje`) VALUES ('$time', '$autor', '$mensaje');";
    if (mysqli_query($link, $sql)) {
        updatechat();
    } else {
        //reportar error al insertar

        echo mysqli_error($link);
    }
}

if (isset($_POST['subirmensaje'])) {

    sendchat('', $_POST['subirmensaje'], $userdata["user"]);
}

if(isset($_POST["updatechat"])){
    updatechat();
}