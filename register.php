<?php

?>

<form action="" method="post" id="form">
    <input type="text" name="nombre">
    <input type="password" name="pass" id="pass">
    <input type="password" name="pass_r" id="pass_r">
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