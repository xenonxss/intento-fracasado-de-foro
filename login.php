<?php

?>


<head>
    <title>Bienvenido a foroxss</title>
    <link rel="stylesheet" href="./registerstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-holder">
        <form class="formulario <?php if ($c == false) {
                                    echo 'error';
                                } ?>" method="post" id="form">
            <div id="form-items">
                <input class="<?php if($correoerror == false){echo 'correoerror';} ?>" type="text" name="correo" placeholder="Nombre usuario" required><br><br>
                <input type="password" name="pass" placeholder="Contraseña" id="pass" required><br><br>
            </div>
            <div id="register-boton">
                <button type="action" onclick="submit()">Acceder</button>
            </div>
        </form>
    </div>
</body>
<script>
    function submit() {
            document.getElementById("form").submit();
    }
</script>