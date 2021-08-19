<?php
    if(isset($_POST["nombre"])){
        include("database.php");
        $nombre = $_POST["nombre"];
        $clave = $_POST["pass"];
        $clave_r = $_POST["pass_r"];

        if($clave == $clave_r){
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
            $ahora = time();
            $sql = "INSERT INTO `users` (`id`, `user`, `password`, `lastonline`) VALUES (NULL, '$nombre', '$clave_encriptada', '$ahora');";
            if(mysqli_query($link, $sql)){
                echo "Usuario registrado!";
                exit;
            }
        }
    }
?>

<form action="" method="post" id="form">
    <input type="text" name="nombre" required><br><br>
    <input type="password" name="pass" id="pass" required><br><br>
    <input type="password" name="pass_r" id="pass_r" required><br><br>
    <button type="action" onclick="submit()">Registrarse</button>
</form>

<script>
    function submit(){
        if(document.getElementById("pass").value == document.getElementById("pass_r").value){
            console.log("oK");
            document.getElementById("form").submit();
        }
    }
</script>