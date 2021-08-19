<?php
    if(isset($_POST["correo"])){
        include("database.php");
        $correo = $_POST["correo"];
        $clave = $_POST["pass"];
        $clave_r = $_POST["pass_r"];

        if($clave == $clave_r){
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
            $ahora = time();

            $sql = "INSERT INTO `users` (`id`, `user`, `password`, `lastonline`) VALUES (NULL, '$correo', '$clave_encriptada', '$ahora');";
            if(mysqli_query($link, $sql)){
                echo "Usuario registrado!";
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
    <form action="" method="post" id="form">
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
    function submit(){
        if(document.getElementById("pass").value == document.getElementById("pass_r").value){
            console.log("oK");
            document.getElementById("form").submit();
        }
    }
</script>
