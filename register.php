<?php
include("database.php");
if (isset($_GET["token"])) {
    $token = $_GET["token"];
    $sql = "SELECT * FROM users WHERE token = '" . $token . "'";
    $do = mysqli_query($link, $sql);
    if($do->num_rows > 0){
        echo "Correctamente registrado y verificado!";
        exit;
    }
}
if (isset($_POST["correo"])) {
    include("mail.php");
    $correo = $_POST["correo"];
    $clave = $_POST["pass"];
    $clave_r = $_POST["pass_r"];
    $token = generateRandomString(50);
    if ($clave == $clave_r) {
        $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
        $ahora = time();

        $sql = "INSERT INTO `users` (`id`, `user`, `correo`, `password`, `token`, `lastonline`) VALUES (NULL, '$correo', '$correo', '$clave_encriptada', '$token', '$ahora');";
        if (mysqli_query($link, $sql)) {
            if (enviarmail("Registrate en PORNHUB!", $correo, "Nah es coña, regitrate aqui <a href='http://localhost/foroxs/register.php?token=$token'>Pincha aqui :)</a>")) {
            }
            echo "Usuario registrado! Tienes que verificar tu mail...";
            exit;
        }
    }
}
?>

<head>
    <title>Bienvenido a foroxss</title>
    <link rel="stylesheet" href="./registerstyle.css">
</head>

<body>
    <form action="" class="formulario" method="post" id="form">
        <div id="form-items">

            <input type="text" name="correo" placeholder="Correo" required><br><br>
            <input type="password" name="pass" placeholder="Contraseña" id="pass" required><br><br>
            <input type="password" name="pass_r" placeholder="Confirmar contraseña" id="pass_r" required><br><br>

        </div>
        <div id="register-boton">
            <button type="action" onclick="submit()">Registrarse</button>
        </div>

    </form>
</body>
<script>
    function submit() {
        if (document.getElementById("pass").value == document.getElementById("pass_r").value) {
            console.log("oK");
            document.getElementById("form").submit();
        }
    }
</script>