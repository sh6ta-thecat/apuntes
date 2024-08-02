<?php
$title = 'Apt';
$css = 'apt';
include_once($_SERVER['DOCUMENT_ROOT'] . '/conecter/app/Views/static/head.php');



?>
<div class="content" style="width: 1000px; padding:10px; padding-top: 20px;">
    <div class="head-t" style="font-size:30px; font-weight:bold;">Apuntes</div>
    <div class="subtit">Busca los apuntes que quieras</div>
    <div class="box">
        <div class="buttons">
            <a href="/conecter/apt/upload">
                <button class="button">Crear</button>
            </a>
        </div>
    </div>
    <div class="apuntes">
        <?php foreach ($apuntes as $apunte) : ?>
            <div class="apuntes-card">
                <div class="datas">
                    <div class="title"><span><?php echo $apunte['nombre'] ?></span></div>
                    <div class="descripcion"><span><?php echo $apunte['descripcion'] ?></span></div>
                    <div class="fecha"><em><?php echo $apunte['tags'] ?></em></div>
                    <div class="ops">
                        <a href="/conecter/apt/view/<?php echo $apunte['id']; ?>"><button type="submit">Ver</button></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>