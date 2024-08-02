<?php
$title = 'Bienvenido';
$css = 'perfil';
include 'static/head.php';
?>

<div class="content" style="width:1000px;">
    <div class="dashboard" style="padding:10px; padding-top:40px;">
        <div style="font-weight:bold; font-size: 40px; text-align:center;">Bienvenido</div>
        <div class="contenido" style="border:1px solid #505051; border-radius: 10px; background: #323133; padding: 10px; ">
            <div class="saludo">
                <h2>Bienvenido a coneCter <br>¿Que quiere hacer hoy?</h2> <br>

            </div>
            <div class="actions">
                <ul>
                    <li style="display:inline-flex; margin-bottom: 1.5em;">¿Buscar otros Usarios? -&nbsp;
                        <form method="GET" action="/conecter/search">
                            <input type="text" name="query" placeholder="Search by username" required>
                            <button type="submit">Search</button>
                        </form>
                    </li><br>
                    <li style="display:inline-flex; margin-bottom: 1.5em;">¿Buscar Archivos? -&nbsp;
                        <form method="GET" action="/conecter/search">
                            <input type="text" name="query" placeholder="Search by username" required>
                            <button type="submit">Search</button>
                        </form>
                    </li>
                    <li>Ver tus archivos</li>
                </ul>
            </div>
        </div>
    </div>
</div>