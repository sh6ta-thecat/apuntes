<?php
$title = 'Bienvenido';
$css = 'welcome';
include 'static/head.php'; ?>

<div class="signup-aria">
    <div class="container">
        <div class="left-aria">
            <div class="left-aria-content">
                <div class="left-text">Conectate a otros estudiante mediante la red. <p></p>
                    <br>
                </div>
            </div>
        </div>
        <div class="right-aria">
            <div class="title-aria">
                <h1>Iniciar Sesión</h1>

            </div>
            <div class="registration_container">
                <form action="/conecter/login" method="POST">
                    <input type="email" name="email" id="email" placeholder="Correo Institucional" required>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <div class="submit-button-log">
                        <input type="submit" name="submit" id="submit" value="Iniciar Sesion">
                    </div>
                </form>


                <div style="color: white;">o</div>
                <div class="submit-button-reg">
                    <button class="createAc" id="myBtn">Registrarme</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal" style="display:none;">
    <div class="modal-content">
        <div class="head">
            <div class="text">
                <h1>Registrarme</h1>
                <p></p>
                <p></p>
            </div>
            <button id="close">x</button>
        </div>
        <div class="line"></div>
        <form action="/conecter/register" method="post">
            <div class="row">
                <input type="text" placeholder="Nombre" id="first_name" name="first_name" required>
                <input type="text" placeholder="Apellidos" id="last_name" name="last_name" required>
            </div>
            <div class="row">
                <input type="email" placeholder="Correo Institucional" id="email" name="email" required><div class="tipo" style="color:#565056;">@iestpchincha.edu.pe</div><br>
            </div>
            <div class="row">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <label for="semester" class="title"> Semestre</label>
            <div class="row">
                <select id="semester" name="semester">
                    <option value="I" title="Primer">I</option>
                    <option value="III" title="Tercero">III</option>
                    <option value="V" title="Quinto">V</option>
                </select>
            </div>
            <label class="title" for="career_id">Genero</label>
            <div class="row">
            <select id="career_id" name="career_id">
                    <option value="1" title="Arquitectura de Plataformas">Arquitectura de Plataformas</option>
                    
                </select>
            </div>
            <div class="row" style="margin: 5px 0;">
                <p>Al dar click usted acepta los terminos y condiciones de la red denominada como: "[conecter]".</p>
            </div>
            <div class="row">
                <input type="submit" class="createAc" value="Registrar">
            </div>
        </form>
    </div>
</div>
<footer>
    <div>
        <a href="about.html">acerca de</a>
        <a href="">Contacto</a>
        <a href="">Terminos y condiciones</a>
        <a href="">FAQ</a>
        <a href="">Privacidad</a>
    </div>
    <div>
        Una produccion de Carlos de la cruz <br>
        coneCter
    </div>

</footer>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");

    var btn_close = document.getElementById("close");

    btn.onclick = function() {
        modal.style.display = "block";
        document.body.style.overflow = "hidden"
    }

    btn_close.onclick = function() {
        modal.style.display = "none";
        document.body.style.overflow = "auto"
    }
</script>

<!-- 
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form action="/conecter/login" method="post">
        <label for="email">Correo institucional:</label>
        <input type="text" id="email" name="email" required>@iestpchincha.edu.pe<br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>

-->