<div class="apuntes">
        <?php
         foreach ($apuntes as $apunte) : ?>
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