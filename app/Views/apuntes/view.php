<?php
$title = 'Apt';
$css = 'aptview';
include_once($_SERVER['DOCUMENT_ROOT'] . '/conecter/app/Views/static/head.php');



?>
    <div class="content">
        <!-- 
    <h1><?php echo htmlspecialchars($apunte['nombre']); ?></h1>
    <p><?php echo htmlspecialchars($apunte['descripcion']); ?></p> -->
        <div class="mdia">
            <?php
            $filePath = $apunte['archivo'];
            $fileType = $apunte['tipo'];

            switch ($fileType) {
                case 'text/html':
                    echo file_get_contents($filePath);
                    break;
                case 'image/jpeg':
                case 'image/png':
                case 'image/ico':
                case 'image/webp':
                    $type = "image";
                    include "medias/medias.php";
                    break;
                case 'video/mp4':
                    $type = "video";
                    include "medias/medias.php";
                    break;
                default:
                    echo "<a href='/$filePath' download>Descargar archivo</a>";
                    break;
            }
            ?>
            <a href="/conecter/apt/list">Volver a sla lista de apuntes</a>
            <div class="info">
                <a href='<?php echo $filePath ?>' download="<?php echo $filePath ?>"><button class="button">Descargar</button></a>
            </div>
            
            <div>Views: <?php echo $apunte['views']; ?></div>

        </div>
        
    </div>

    <script src="public/js/like.js"></script>