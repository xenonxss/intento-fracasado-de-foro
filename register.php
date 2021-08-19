<?php
$c = true;
include("database.php");
if (isset($_GET["token"])) {
    $ahora = time();
    $token = $_GET["token"];
    $sql = "SELECT * FROM users WHERE token = '" . $token . "'";
    $do = mysqli_query($link, $sql);

    if ($do->num_rows > 0) {
        $sql = "UPDATE `users` SET `verify` = '1' WHERE `users`.`token` = '$token';";

        if (mysqli_query($link, $sql)) {
            echo "Correctamente registrado y verificado!";
            $sql = "UPDATE `users` SET `sincedate` = '$ahora' WHERE `users`.`token` = '$token';";

            if (mysqli_query($link, $sql)) {
                echo 'si';
            } else {
                echo mysqli_error($link);
            }
            exit;
        } else {
            echo mysqli_error($link);
        }
    }
}
if (isset($_POST["correo"])) {
    include("mail.php");
    $correo = $_POST["correo"];
    $clave = $_POST["pass"];
    $clave_r = $_POST["pass_r"];
    $token = generateRandomString(50);

    function checkEmail($email)
    {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }

    if (checkEmail($correo)) {
        $c = true;
        if ($clave == $clave_r) {
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
            $ahora = time();

            $sql = "SELECT * FROM `users` WHERE `correo`='$correo';";
            $do = mysqli_query($link, $sql);
            if ($do->num_rows > 0) {
                echo '<script>alert("Ya hay un usuario con este correo.")</script>';
            } else {
                $sql = "INSERT INTO `users` (`id`, `user`, `correo`, `password`, `token`, `lastonline`) VALUES (NULL, '$correo', '$correo', '$clave_encriptada', '$token', '$ahora');";
                if (mysqli_query($link, $sql)) {
                    if (enviarmail("Registrate en PORNHUB!", $correo, "Nah es coña, regitrate aqui <a href='http://localhost/foroxs/register.php?token=$token'>Pincha aqui :)</a>")) {
                    }
                    echo "Usuario registrado! Tienes que verificar tu mail...";
                    exit;
                }
            }
        }
    } else {
        echo 'el correo no es valido';
        $c = false;
    }
}
?>

<head>
    <title>Bienvenido a foroxss</title>
    <link rel="stylesheet" href="./registerstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<!--<body onload='document.getElementById("señala").classList.add("bu")'>-->

<body>
    <div class="form-holder">
        <form class="formulario <?php if ($c == false) {
                                    echo 'error';
                                } ?>" method="post" id="form">
            <div id="form-items">
                <input type="text" name="correo" placeholder="Correo" required><br><br>
                <input type="password" name="pass" placeholder="Contraseña" id="pass" required><br><br>
                <input type="password" name="pass_r" placeholder="Confirmar contraseña" id="pass_r" required><br><br>
            </div>
            <div id="register-boton">
                <button type="action" onclick="submit()">Registrarse</button>
            </div>
        </form>
    </div>

    <img id="señala" class="susto" src="./señalar.png">
</body>
<script>
    function submit() {
        if (document.getElementById("pass").value == document.getElementById("pass_r").value) {
            document.getElementById("form").submit();
        }
    }
</script>