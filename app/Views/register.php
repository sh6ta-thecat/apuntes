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
                <input type="email" placeholder="Correo Institucional" id="email" name="email" required>
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